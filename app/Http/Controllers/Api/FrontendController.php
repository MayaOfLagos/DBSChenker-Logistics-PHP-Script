<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ComplaintFormMail;
use App\Mail\ContactFormMail;
use App\Mail\DepositNotification;
use App\Models\Deposit;
use App\Models\GuestUser;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\User;
use App\Models\Wdmethod;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function settings()
    {
        return response()->json($this->settingsPayload());
    }

    public function paymentMethods()
    {
        $methods = Wdmethod::query()
            ->where('status', 'enabled')
            ->where(function ($query) {
                $query->where('type', 'deposit')->orWhere('type', 'both');
            })
            ->orderBy('name')
            ->get()
            ->map(function (Wdmethod $method) {
                return [
                    'id' => $method->id,
                    'name' => $method->name,
                    'type' => $method->type,
                    'status' => $method->status,
                    'minimum' => $method->minimum,
                    'maximum' => $method->maximum,
                    'charges_fixed' => $method->charges_fixed,
                    'charges_percentage' => $method->charges_percentage,
                    'duration' => $method->duration,
                ];
            })
            ->values();

        return response()->json($methods);
    }

    public function track(Request $request)
    {
        $data = $request->validate([
            'trackingnumber' => ['required', 'string', 'max:255'],
        ]);

        $trackingNumber = trim($data['trackingnumber']);
        $courier = User::where('trackingnumber', $trackingNumber)->first();

        if (!$courier) {
            return response()->json([
                'message' => 'Tracking number does not exist.',
            ], 404);
        }

        return response()->json($this->shipmentPayload($courier));
    }

    public function createDeposit(Request $request)
    {
        $data = $request->validate([
            'payment_method' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'tracking' => ['nullable', 'string', 'max:255'],
            'asset' => ['nullable', 'string', 'max:255'],
            'courier_id' => ['nullable', 'integer'],
        ]);

        $method = Wdmethod::where('name', $data['payment_method'])->first();

        if (!$method) {
            return response()->json([
                'message' => 'Selected payment method is not available.',
            ], 422);
        }

        return response()->json([
            'amount' => (float) $data['amount'],
            'tracking' => $data['tracking'] ?? null,
            'asset' => $data['asset'] ?? null,
            'courier_id' => $data['courier_id'] ?? null,
            'name' => $data['name'],
            'email' => $data['email'],
            'payment_method' => [
                'id' => $method->id,
                'name' => $method->name,
                'type' => $method->type,
                'minimum' => $method->minimum,
                'maximum' => $method->maximum,
                'duration' => $method->duration,
            ],
        ]);
    }

    public function submitPaymentProof(Request $request)
    {
        $data = $request->validate([
            'proof' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'amount' => ['required', 'numeric', 'min:1'],
            'method' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'tracking' => ['nullable', 'string', 'max:255'],
            'courier_id' => ['nullable', 'integer'],
        ]);

        $method = Wdmethod::where('name', $data['method'])->first();
        $path = $request->file('proof')->store('payment_proofs', 'public');

        $deposit = new Deposit();
        $deposit->amount = $data['amount'];
        $deposit->payment_mode = $method?->name ?? $data['method'];
        $deposit->status = 'Pending';
        $deposit->proof = $path;
        $deposit->track_id = $data['tracking'] ?? null;
        $deposit->courier_id = $data['courier_id'] ?? null;

        if (Auth::check()) {
            $deposit->user = Auth::id();
            $user = User::find(Auth::id());
        } else {
            $deposit->user = 0;
            $deposit->guest_email = $data['email'];
            $deposit->guest_name = $data['name'];
            $user = new GuestUser($data['name'], $data['email'], $this->settingsPayload()['currency'] ?? '$');
        }

        $deposit->save();

        $settings = Settings::find(1);
        if ($settings && $settings->contact_email) {
            try {
                Mail::to($settings->contact_email)->send(new DepositNotification($deposit, $user, true));
                Mail::to($data['email'])->send(new DepositNotification($deposit, $user, false));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        $receipt = $this->receiptPayload($deposit->id);
        $receipt['message'] = 'Payment proof submitted successfully.';

        return response()->json($receipt, 201);
    }

    public function receipt(int $id)
    {
        return response()->json($this->receiptPayload($id));
    }

    public function invoice(int $id)
    {
        $courier = User::findOrFail($id);

        return response()->json($this->shipmentPayload($courier));
    }

    public function printInvoice(int $id)
    {
        return response()->json($this->invoice($id)->getData(true));
    }

    public function contactForm(Request $request)
    {
        $data = $request->validate([
            'firstname' => ['required', 'string', 'max:100'],
            'lastname'  => ['required', 'string', 'max:100'],
            'email'     => ['required', 'email', 'max:255'],
            'phone'     => ['required', 'string', 'max:30'],
            'subject'   => ['required', 'string', 'max:255'],
            'company'   => ['nullable', 'string', 'max:255'],
            'message'   => ['required', 'string', 'max:5000'],
        ]);

        $settings    = Settings::find(1);
        $adminEmail  = $settings?->contact_email;
        $systemEmail = config('mail.from.address');

        try {
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ContactFormMail($data, true));
            }

            if ($systemEmail && $systemEmail !== $adminEmail) {
                Mail::to($systemEmail)->send(new ContactFormMail($data, true));
            }

            Mail::to($data['email'])->send(new ContactFormMail($data, false));
        } catch (\Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => 'Thank you! Your message has been received. A member of our team will respond within one business day.',
        ]);
    }

    public function complaintForm(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:150'],
            'email'    => ['required', 'email', 'max:255'],
            'phone'    => ['nullable', 'string', 'max:30'],
            'type'     => ['required', 'string', 'max:100'],
            'tracking' => ['nullable', 'string', 'max:100'],
            'message'  => ['required', 'string', 'max:5000'],
        ]);

        $settings    = Settings::find(1);
        $adminEmail  = $settings?->contact_email;
        $systemEmail = config('mail.from.address');

        try {
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new ComplaintFormMail($data, true));
            }

            if ($systemEmail && $systemEmail !== $adminEmail) {
                Mail::to($systemEmail)->send(new ComplaintFormMail($data, true));
            }

            Mail::to($data['email'])->send(new ComplaintFormMail($data, false));
        } catch (\Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => 'Your complaint has been received and logged. Our compliance team will review it within 2 business days.',
        ]);
    }

    protected function settingsPayload(): array
    {
        $settings = Settings::find(1);

        return [
            'id'           => $settings?->id,
            'site_name'    => $settings?->site_name,
            'site_title'   => $settings?->site_title,
            'site_address' => $settings?->site_address,
            'contact_email'=> $settings?->contact_email,
            'currency'     => $settings?->currency ?? '$',
            's_currency'   => $settings?->s_currency ?? $settings?->currency ?? '$',
            'description'  => $settings?->description,
            'logo'         => $settings?->logo,
            'logo_url'     => $settings?->logo ? Storage::url($settings->logo) : null,
            'favicon'      => $settings?->favicon,
            'favicon_url'  => $settings?->favicon ? Storage::url($settings->favicon) : null,
            'whatsapp'          => $settings?->whatsapp,
            'phone'             => $settings?->phone,
            'locations'         => $settings?->locations,
            'tido'              => $settings?->tido,
            'year_started'      => $settings?->twak,
            'google_translate'  => $settings?->google_translate ?? 'off',
            'shipment_statuses' => $settings?->getShipmentStatusesWithDefault() ?? [],
            'freight_types'     => $settings?->getFreightTypesWithDefault() ?? [],
        ];
    }

    protected function shipmentPayload(User $courier): array
    {
        $tracks = Tp_Transaction::where('user', $courier->id)
            ->orderByDesc('id')
            ->get();

        $settings = Settings::find(1);
        $shippingCost = (float) ($courier->cost ?? 0);
        $clearanceCost = (float) ($courier->clearance_cost ?? 0);

        return [
            'courier' => $courier,
            'tracks' => $tracks,
            'latesttrack' => $tracks->first(),
            'settings' => $this->settingsPayload(),
            'summary' => [
                'shipping_cost' => $shippingCost,
                'clearance_cost' => $clearanceCost,
                'total_due' => $shippingCost + $clearanceCost,
                'currency' => $settings?->scurrency ?? $settings?->currency ?? '$',
            ],
        ];
    }

    protected function receiptPayload(int $id): array
    {
        $deposit = Deposit::query()->findOrFail($id);
        $settings = Settings::find(1);
        $methodName = $this->resolvePaymentMethodName($deposit->payment_mode);

        return [
            'deposit' => [
                'id' => $deposit->id,
                'amount' => $deposit->amount,
                'payment_mode' => $deposit->payment_mode,
                'payment_method_name' => $methodName,
                'status' => $deposit->status,
                'proof' => $deposit->proof,
                'proof_url' => $deposit->proof ? Storage::url($deposit->proof) : null,
                'track_id' => $deposit->track_id,
                'courier_id' => $deposit->courier_id,
                'guest_email' => $deposit->guest_email,
                'guest_name' => $deposit->guest_name,
                'user' => $deposit->user,
                'created_at' => Carbon::parse($deposit->created_at)->toIso8601String(),
            ],
            'settings' => $this->settingsPayload(),
            'payment_method_name' => $methodName,
            'tracking_number' => $deposit->track_id,
            'currency' => $settings?->currency ?? '$',
        ];
    }

    protected function resolvePaymentMethodName(?string $value): string
    {
        if (!$value) {
            return 'Bank Transfer';
        }

        if (is_numeric($value)) {
            $method = Wdmethod::find((int) $value);
            return $method?->name ?? 'Bank Transfer';
        }

        $method = Wdmethod::where('name', $value)->first();

        return $method?->name ?? Str::title($value);
    }
}
