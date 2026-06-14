<?php

namespace App\Http\Controllers;

use App\Mail\CreateShipmentNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Mail\DeliveryConfirmation;
use App\Mail\NewNotification;
use Illuminate\Validation\Rule;

use App\Mail\ShipmentStatusUpdate;
use Illuminate\Support\Facades\Storage;

class ShipmentController extends Controller
{
    /**
     * Store a newly created shipment in the database.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeShipment(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'sname' => 'required|string|max:255',                     // Sender Name
            'saddress' => 'required|string|max:255',                  // Sender Address
            'semail' => 'required|string|max:255',                  // Sender Email
            'take_off_point' => 'required|string|max:255',            // Origin Office
            'name' => 'required|string|max:255',                      // Receiver Name
            'email' => 'required|email|max:255',                      // Receiver Email
            'phone' => 'required|string|max:20',                      // Receiver Phone
            'address' => 'required|string|max:255',                   // Receiver Address
            'final_destination' => 'required|string|max:255',         // Destination Office
            'qty' => 'required|numeric|min:1',                        // Quantity
            'description' => 'required|string',                       // Parcel Description
            'cost' => 'required|numeric|min:0',                       // Shipping Cost
            'clearance_cost' => 'required|numeric|min:0',
            'date_shipped' => 'required',
            'weight' => 'required',
            'cstatus' => 'required',
            'freight_type' => 'required',
            'expected_delivery' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Shipment Photo
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the shipment record using the User model
        // Note: We're using the User model as it appears to store shipment data
        $shipment = new User();
        $shipment->sname = $request->sname;
        $shipment->saddress = $request->saddress;
        $shipment->semail = $request->semail;
        $shipment->take_off_point = $request->take_off_point;
        $shipment->name = $request->name;
        $shipment->email = $request->email;
        $shipment->phone = $request->phone;
        $shipment->address = $request->address;
        $shipment->final_destination = $request->final_destination;
        $shipment->qty = $request->qty;
        $shipment->description = $request->description;
        $shipment->cost = $request->cost;
        $shipment->weight = $request->weight;
        $shipment->cstatus = $request->cstatus;
        $shipment->status = $request->status;
        $shipment->clearance_cost = $request->clearance_cost;
        $shipment->date_shipped = $request->date_shipped;
        $shipment->expected_delivery = $request->expected_delivery;
        $shipment->freight_type = $request->freight_type;



        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $shipment->photo = $this->storeShipmentPhoto($request->file('photo'));
        }

        // Generate unique tracking number
        $trackingNumber = $this->generateTrackingNumber();
        $shipment->trackingnumber = $trackingNumber;


        // Save the shipment
        $shipment->save();

        // Create the initial tracking record
        $this->createTrackingRecord($shipment->id, $request->take_off_point, "Order Confirmed", "Your shipment has been confirmed and is being processed.");

        // Send email notification to the receiver
        $this->sendReceiverNotification($shipment);

        // Redirect with success message and shipment details
        return redirect()->route('admin.shipments.view', $shipment->id)
            ->with('success', 'Shipment created successfully. Tracking Number: ' . $trackingNumber);
    }

    /**
     * Generate a unique tracking number
     * 
     * @return string
     */
    private function generateTrackingNumber()
    {
        // Get settings
        $settings = Settings::where('id', '1')->first();

        // Extract first two letters of site name and convert to uppercase
        $sitePrefix = strtoupper(substr($settings->site_name, 0, 2));

        // Format: SITEINITIALS-RANDOMNUMBER-RANDOMSTRING
        $prefix = $sitePrefix;
        $year = rand(1000, 9999); // Generate a random 4-digit number instead of year
        $randomString = strtoupper(Str::random(8));

        $trackingNumber = "{$prefix}-{$year}-{$randomString}";

        // Check if tracking number already exists
        while (User::where('trackingnumber', $trackingNumber)->exists()) {
            $randomString = strtoupper(Str::random(8));
            $trackingNumber = "{$prefix}-{$year}-{$randomString}";
        }

        return $trackingNumber;
    }

    /**
     * Create a tracking record for the shipment
     * 
     * @param int $userId
     * @param string $location
     * @param string $status
     * @param string $comment
     * @return void
     */
    private function createTrackingRecord($userId, $location, $status, $comment)
    {
        Tp_Transaction::create([
            'user' => $userId,
            'address' => $location,
            'city' => '',  // Can be populated if needed
            'country' => '',  // Can be populated if needed
            'status' => $status,
            'comment' => $comment
        ]);
    }

    /**
     * Send email notification to the receiver
     * 
     * @param User $shipment
     * @return void
     */
    private function sendReceiverNotification($shipment)
    {
        $settings = Settings::where('id', '1')->first();

        Mail::to($shipment->email)->send(
            new CreateShipmentNotification($shipment, $settings)
        );

        // Generate email content (raw HTML)
        // $emailContent = $this->generateEmailContent($shipment, $settings);
        // $subject = "Package Received - Tracking #" . $shipment->trackingnumber;

        // // Send email to receiver
        // Mail::to($shipment->email)->send(new NewNotification(
        //     $emailContent,
        //     $subject,
        //     $shipment->name,
        //     null,    // $url (optional)
        //     null,    // $attachment (optional)
        //     null     // $salutaion (optional)
        // ));
    }

    private function generateEmailContent($shipment, $settings)
    {
        // Keep your variables as-is
        $message = "
    <div class='container'>
        <div class='header'>
            <h2>{$settings->site_name} Logistics</h2>
        </div>
        <div class='content'>
            <p>Dear {$shipment->name},</p>
            <p>We are pleased to inform you that a package has been received and is ready for delivery to you.</p>
            
            <div class='tracking-info'>
                <h3>Tracking Information</h3>
                <p><strong>Tracking Number:</strong> {$shipment->trackingnumber}</p>
                <p><strong>Status:</strong> {$shipment->status}</p>
            </div>
            
            <div class='details'>
                <h3>Shipment Details</h3>
                <table>
                    <tr><th>Sender</th><td>{$shipment->sname}</td></tr>
                    <tr><th>Origin</th><td>{$shipment->take_off_point}</td></tr>
                    <tr><th>Destination</th><td>{$shipment->final_destination}</td></tr>
                    <tr><th>Description</th><td>{$shipment->description}</td></tr>
                    <tr><th>Shipping Cost</th><td>{$settings->s_currency} {$shipment->cost}</td></tr>
                </table>
            </div>
            
            <p>You can track your shipment anytime by clicking the button below:</p>
            <p style='text-align: center;'>
                <a href='{$settings->site_address}/track?tracking={$shipment->trackingnumber}' class='button'>Track Your Package</a>
            </p>
            
            <p>Thank you for choosing {$settings->site_name} for your shipping needs.</p>
        </div>
        <div class='footer'>
            <p>&copy; " . date('Y') . " {$settings->site_name}. All rights reserved.</p>
            <p>{$settings->site_address} | {$settings->contact_email}</p>
        </div>
    </div>
    ";

        return $message;
    }


    /**
     * Update shipment status and create a tracking record
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateShipmentStatus(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'shipment_id' => 'required|exists:users,id',
            'status' => 'required|string|in:Order Confirmed,Picked by Courier,On The Way,Custom Hold,Delivered',
            'comment' => 'required|string',
            'location' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update the shipment status
        $shipment = User::findOrFail($request->shipment_id);
        $shipment->status = $request->status;
        $shipment->save();

        // Create a new tracking record
        $this->createTrackingRecord(
            $shipment->id,
            $request->location,
            $request->status,
            $request->comment
        );


        User::where('id', $request->shipment_id)
            ->update([

                'location' => $request->location,
                'percentage_complete' => $request['percentage_complete'],

            ]);


        // If status is "Delivered", send a delivery confirmation email
        if ($request->status === 'Delivered') {
            $this->sendDeliveryConfirmation($shipment);
        } else {
            // Send status update notification
            $this->sendStatusUpdateNotification($shipment, $request->status, $request->comment);
        }

        return redirect()->back()->with('success', 'Shipment status updated successfully');
    }

    /**
     * Send delivery confirmation email
     * 
     * @param User $shipment
     * @return void
     */
    private function sendDeliveryConfirmation($shipment)
    {
        $settings = Settings::where('id', 1)->first();

        Mail::to($shipment->email)->send(
            new DeliveryConfirmation($shipment, $settings)
        );
    }

    /**
     * Send status update notification
     * 
     * @param User $shipment
     * @param string $status
     * @param string $comment
     * @return void
     */


    private function sendStatusUpdateNotification($shipment, $status, $comment)
    {
        $settings = Settings::where('id', 1)->first();

        Mail::to($shipment->email)->send(
            new ShipmentStatusUpdate($shipment, $status, $comment, $settings)
        );
    }

    /**
     * Update an existing shipment in the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateShipment(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:users,id',
            'trackingnumber' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'trackingnumber')->ignore($request->id)
            ],
            'sname'             => 'required|string|max:255',
            'semail'            => 'nullable|email|max:255',
            'saddress'          => 'required|string|max:255',
            'take_off_point'    => 'required|string|max:255',
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'required|string|max:20',
            'address'           => 'required|string|max:255',
            'final_destination' => 'required|string|max:255',
            'qty'               => 'required|numeric|min:1',
            'description'       => 'required|string',
            'weight'            => 'nullable|numeric|min:0',
            'dimensions'        => 'nullable|string|max:100',
            'freight_type'      => 'required|string',
            'cost'              => 'required|numeric|min:0',
            'clearance_cost'    => 'required|numeric|min:0',
            'cstatus'           => 'required|string|in:Paid,Unpaid',
            'date_shipped'      => 'required',
            'expected_delivery' => 'required',
            'percentage_complete' => 'nullable|numeric|min:0|max:100',
            'status'            => 'required|string|in:Order Confirmed,Picked by Courier,On The Way,Custom Hold,Delivered,Approved,Available,Pending',
            'photo'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find and update the shipment
        $shipment = User::findOrFail($request->id);

        // Check if status changed
        $statusChanged = $shipment->status !== $request->status;
        $oldStatus = $shipment->status;

        // Check if tracking number changed
        $trackingChanged = $shipment->trackingnumber !== $request->trackingnumber;
        $oldTracking = $shipment->trackingnumber;

        // If tracking number is changed, check if it already exists in another record
        if ($trackingChanged) {
            $existingShipment = User::where('trackingnumber', $request->trackingnumber)
                ->where('id', '!=', $shipment->id)
                ->first();

            if ($existingShipment) {
                return redirect()->back()->withErrors([
                    'trackingnumber' => 'The tracking number already exists. Please use a different tracking number.'
                ])->withInput();
            }
        }

        // Update shipment data
        $shipment->trackingnumber     = $request->trackingnumber;
        $shipment->sname              = $request->sname;
        $shipment->semail             = $request->semail;
        $shipment->saddress           = $request->saddress;
        $shipment->take_off_point     = $request->take_off_point;
        $shipment->name               = $request->name;
        $shipment->email              = $request->email;
        $shipment->phone              = $request->phone;
        $shipment->address            = $request->address;
        $shipment->final_destination  = $request->final_destination;
        $shipment->qty                = $request->qty;
        $shipment->description        = $request->description;
        $shipment->weight             = $request->weight;
        $shipment->dimensions         = $request->dimensions;
        $shipment->freight_type       = $request->freight_type;
        $shipment->cost               = $request->cost;
        $shipment->clearance_cost     = $request->clearance_cost;
        $shipment->cstatus            = $request->cstatus;
        $shipment->date_shipped       = $request->date_shipped;
        $shipment->expected_delivery  = $request->expected_delivery;
        $shipment->percentage_complete = $request->percentage_complete;
        $shipment->status             = $request->status;

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $this->deleteStoredShipmentPhoto($shipment->photo);
            $shipment->photo = $this->storeShipmentPhoto($request->file('photo'));
        }

        // Save the shipment
        $shipment->save();

        // If status was changed, create a tracking record
        if ($statusChanged) {
            $this->createTrackingRecord(
                $shipment->id,
                $shipment->final_destination,
                $request->status,
                "Status updated from {$oldStatus} to {$request->status} by admin."
            );
        }

        // If tracking number was changed, log it in tracking history
        if ($trackingChanged) {
            $this->createTrackingRecord(
                $shipment->id,
                $shipment->final_destination,
                $shipment->status,
                "Tracking number updated from {$oldTracking} to {$request->trackingnumber} by admin."
            );
        }

        // Redirect with success message
        return redirect()->route('admin.shipments.view', $shipment->id)
            ->with('success', 'Shipment updated successfully.');
    }

    /**
     * Show the shipment status update form
     * 
     * @param int $id Shipment ID
     * @return \Illuminate\Http\Response
     */
    public function showUpdateStatusForm($id)
    {
        // Find the shipment
        $shipment = User::findOrFail($id);

        // Get shipment tracking history
        $tracks = Tp_Transaction::where('user', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get settings
        $settings = Settings::where('id', '1')->first();

        return view('admin.update-shipment-status', [
            'shipment' => $shipment,
            'tracks' => $tracks,
            'settings' => $settings,
            'title' => 'Update Shipment Status'
        ]);
    }

    /**
     * List all shipments for admin
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function listShipments(Request $request)
    {
        // Get search parameters
        $search = $request->input('search');
        $status = $request->input('status');

        // Query builder for shipments
        $query = User::whereNotNull('trackingnumber');

        // Apply search filter if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('trackingnumber', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('sname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }

        // Get paginated results
        $shipments = $query->orderBy('created_at', 'desc')
            ->paginate(15);

        // Get settings
        $settings = Settings::where('id', '1')->first();

        return view('admin.shipments', [
            'shipments' => $shipments,
            'settings' => $settings,
            'search' => $search,
            'status' => $status,
            'title' => 'Manage Shipments'
        ]);
    }

    /**
     * Show shipment details
     * 
     * @param int $id Shipment ID
     * @return \Illuminate\Http\Response
     */
    public function viewShipment($id)
    {
        // Find the shipment
        $shipment = User::findOrFail($id);

        // Get shipment tracking history
        $tracks = Tp_Transaction::where('user', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Get settings
        $settings = Settings::where('id', '1')->first();

        return view('admin.view-shipment', [
            'shipment' => $shipment,
            'tracks' => $tracks,
            'settings' => $settings,
            'title' => 'Shipment Details'
        ]);
    }

    /**
     * Show shipment deposits for admin
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function shipmentDeposits(Request $request)
    {
        // Get search parameters
        $search = $request->input('search');
        $status = $request->input('status');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Get deposits from the database
        $query = DB::table('deposits')
            ->leftJoin('users', 'deposits.user', '=', 'users.id')
            ->select('deposits.*', 'users.name', 'users.email', 'users.trackingnumber');

        // Apply filters if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('users.trackingnumber', 'like', "%{$search}%")
                    ->orWhere('users.name', 'like', "%{$search}%")
                    ->orWhere('users.email', 'like', "%{$search}%")
                    ->orWhere('deposits.payment_mode', 'like', "%{$search}%");
            });
        }

        if ($status) {
            $query->where('deposits.status', $status);
        }

        if ($dateFrom && $dateTo) {
            $query->whereBetween('deposits.created_at', [$dateFrom . ' 00:00:00', $dateTo . ' 23:59:59']);
        } elseif ($dateFrom) {
            $query->where('deposits.created_at', '>=', $dateFrom . ' 00:00:00');
        } elseif ($dateTo) {
            $query->where('deposits.created_at', '<=', $dateTo . ' 23:59:59');
        }

        // Get paginated results
        $deposits = $query->orderBy('deposits.created_at', 'desc')
            ->paginate(15);

        // Get statistics for the dashboard
        $totalDeposits = DB::table('deposits')->count();
        $pendingDeposits = DB::table('deposits')->where('status', 'pending')->count();
        $approvedDeposits = DB::table('deposits')->where('status', 'approved')->count();
        $rejectedDeposits = DB::table('deposits')->where('status', 'rejected')->count();

        // Calculate totals
        $totalAmount = DB::table('deposits')->where('status', 'approved')->sum('amount');

        // Get settings
        $settings = Settings::where('id', '1')->first();

        return view('admin.shipment-deposits', [
            'deposits' => $deposits,
            'settings' => $settings,
            'search' => $search,
            'status' => $status,
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'totalDeposits' => $totalDeposits,
            'pendingDeposits' => $pendingDeposits,
            'approvedDeposits' => $approvedDeposits,
            'rejectedDeposits' => $rejectedDeposits,
            'totalAmount' => $totalAmount,
            'title' => 'Shipment Deposits'
        ]);
    }

    /**
     * Process a deposit
     * 
     * @param int $id Deposit ID
     * @return \Illuminate\Http\Response
     */
    public function processDeposit($id)
    {
        try {
            // Update deposit status
            DB::table('deposits')->where('id', $id)->update([
                'status' => 'Processed',
                'updated_at' => now()
            ]);

            // Get deposit details
            $deposit = DB::table('deposits')->where('id', $id)->first();

            // Notify user if needed
            // Implementation depends on your system's notification mechanism

            return redirect()->route('admin.shipment.deposits')
                ->with('success', 'Deposit processed successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.shipment.deposits')
                ->with('error', 'Error processing deposit: ' . $e->getMessage());
        }
    }

    /**
     * View deposit details
     * 
     * @param int $id Deposit ID
     * @return \Illuminate\Http\Response
     */
    public function viewDeposit($id)
    {
        try {
            // Get deposit details
            $deposit = DB::table('deposits')
                ->join('users', 'deposits.user', '=', 'users.id')
                ->select('deposits.*', 'users.name', 'users.email', 'users.trackingnumber')
                ->where('deposits.id', $id)
                ->first();

            if (!$deposit) {
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'Deposit not found');
            }

            // Get settings
            $settings = Settings::where('id', '1')->first();

            return view('admin.view-deposit', [
                'deposit' => $deposit,
                'settings' => $settings,
                'title' => 'View Deposit Details'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.shipment.deposits')
                ->with('error', 'Error viewing deposit: ' . $e->getMessage());
        }
    }

    /**
     * View deposit payment proof image
     * 
     * @param int $id Deposit ID
     * @return \Illuminate\Http\Response
     */
    public function viewDepositImage($id)
    {
        try {
            // Get deposit details
            $deposit = DB::table('deposits')->where('id', $id)->first();

            if (!$deposit || !$deposit->proof) {
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'Deposit proof not found');
            }

            // Get settings
            $settings = Settings::where('id', '1')->first();

            return view('admin.view-deposit-image', [
                'deposit' => $deposit,
                'settings' => $settings,
                'title' => 'View Payment Proof'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.shipment.deposits')
                ->with('error', 'Error viewing deposit image: ' . $e->getMessage());
        }
    }

    /**
     * Delete a deposit
     * 
     * @param int $id Deposit ID
     * @return \Illuminate\Http\Response
     */
    public function deleteDeposit($id)
    {
        try {
            // Get deposit details
            $deposit = DB::table('deposits')->where('id', $id)->first();

            if (!$deposit) {
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'Deposit not found');
            }

            // Delete deposit proof if exists
            if ($deposit->proof) {
                if (Storage::disk('public')->exists($deposit->proof)) {
                    Storage::disk('public')->delete($deposit->proof);
                } elseif (file_exists(public_path($deposit->proof))) {
                    @unlink(public_path($deposit->proof));
                }
            }

            // Delete deposit record
            DB::table('deposits')->where('id', $id)->delete();

            return redirect()->route('admin.shipment.deposits')
                ->with('success', 'Deposit deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.shipment.deposits')
                ->with('error', 'Error deleting deposit: ' . $e->getMessage());
        }
    }

    public function deleteShipment($id)
    {
        try {

            // Find the shipment
            $shipment = User::findOrFail($id);

            $this->deleteStoredShipmentPhoto($shipment->photo);


            // Delete shipment tracking history
            Tp_Transaction::where('user', $id)->delete();

            // Finally, delete the shipment itself
            $shipment->delete();


            return redirect()->route('admin.shipments')
                ->with('success', 'Shipment deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.shipments')
                ->with('error', 'Error deleting shipment: ' . $e->getMessage());
        }
    }

    private function storeShipmentPhoto(\Illuminate\Http\UploadedFile $photo): string
    {
        $fileName = time() . '_' . Str::random(8) . '.' . $photo->getClientOriginalExtension();

        return $photo->storeAs('photos', $fileName, 'public');
    }

    private function deleteStoredShipmentPhoto(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return;
        }

        if (file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    /**
     * Export deposits data
     * 
     * @param string $format Export format (csv, excel, pdf)
     * @return \Illuminate\Http\Response
     */
    public function exportDeposits($format)
    {
        try {
            // Get all deposits
            $deposits = DB::table('deposits')
                ->join('users', 'deposits.user', '=', 'users.id')
                ->select('deposits.*', 'users.name', 'users.email', 'users.trackingnumber')
                ->orderBy('deposits.created_at', 'desc')
                ->get();

            // Format data for export
            $exportData = [];
            foreach ($deposits as $deposit) {
                $exportData[] = [
                    'ID' => $deposit->id,
                    'Tracking Number' => $deposit->trackingnumber,
                    'User' => $deposit->name,
                    'Email' => $deposit->email,
                    'Amount' => $deposit->amount,
                    'Payment Method' => $deposit->payment_mode,
                    'Status' => $deposit->status,
                    'Date' => date('Y-m-d H:i:s', strtotime($deposit->created_at))
                ];
            }

            // Export based on format
            if ($format == 'csv') {
                // CSV export logic
                return response()->streamDownload(function () use ($exportData) {
                    $handle = fopen('php://output', 'w');

                    // Add headers
                    fputcsv($handle, array_keys($exportData[0]));

                    // Add data rows
                    foreach ($exportData as $row) {
                        fputcsv($handle, $row);
                    }

                    fclose($handle);
                }, 'shipment_deposits.csv');
            } elseif ($format == 'excel') {
                // Excel export logic - would typically use Maatwebsite/Laravel-Excel package
                // This is a placeholder for the actual implementation
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'Excel export not implemented yet');
            } elseif ($format == 'pdf') {
                // PDF export logic - would typically use domPDF or similar package
                // This is a placeholder for the actual implementation
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'PDF export not implemented yet');
            } else {
                return redirect()->route('admin.shipment.deposits')
                    ->with('error', 'Invalid export format');
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.shipment.deposits')
                ->with('error', 'Error exporting deposits: ' . $e->getMessage());
        }
    }
}
