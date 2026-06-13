<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\GuestUser;
use App\Models\Settings;
use App\Models\Deposit;
use App\Models\User_plans;
use App\Models\Tp_Transaction;
use App\Mail\DepositStatus;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ManageDepositController extends Controller
{
    use PingServer;

    //Delete deposit
    public function deldeposit($id)
    {
        $deposit = Deposit::where('id', $id)->first();
        if (! $deposit) {
            return redirect()->back()->with('error', 'Deposit not found');
        }

        if ($deposit->proof && Storage::disk('public')->exists($deposit->proof)) {
            Storage::disk('public')->delete($deposit->proof);
        }
        Deposit::where('id', $id)->delete();
        return redirect()->back()->with('success', 'Deposit history has been deleted!');
    }

    //process deposits
    public function pdeposit($id)
    {
        //confirm the users plan
        $deposit = Deposit::where('id', $id)->first();
        if (! $deposit) {
            return redirect()->back()->with('error', 'Deposit not found');
        }

        $settings = Settings::where('id', '=', '1')->first();
        $user = $deposit->user ? User::where('id', $deposit->user)->first() : null;
        $isGuest = ! $user;

        if (! $isGuest) {
            User::where('id', $user->id)
                ->update([
                    'account_bal' => $user->account_bal + $deposit->amount,
                    'cstatus' => 'Customer',
                ]);

            $earnings = $settings->referral_commission * $deposit->amount / 100;

            if (!empty($user->ref_by)) {
                $agent = User::where('id', $user->ref_by)->first();

                if ($agent) {
                    User::where('id', $user->ref_by)
                        ->update([
                            'account_bal' => $agent->account_bal + $earnings,
                            'ref_bonus' => $agent->ref_bonus + $earnings,
                        ]);

                    Tp_Transaction::create([
                        'user' => $user->ref_by,
                        'plan' => 'Credit',
                        'amount' => $earnings,
                        'type' => 'Ref_bonus',
                    ]);

                    $deposit_amount = $deposit->amount;
                    $array = User::all();
                    $parent = $user->id;
                    $this->getAncestors($array, $deposit_amount, $parent);
                }
            }

            if ($deposit->planid) {
                User_plans::where('id', $deposit->planid)->update(['active' => 'yes']);
                User::where('id', $user->id)->update(['upgrade' => 0]);
            }
        }

        Deposit::where('id', $id)->update(['status' => 'Processed']);

        $recipient = $isGuest
            ? new GuestUser($deposit->guest_name ?? 'Customer', $deposit->guest_email ?? '', $settings->currency ?? '$')
            : $user;

        if ($recipient->email) {
            try {
                Mail::to($recipient->email)->send(new DepositStatus($deposit, $recipient, 'Your Deposit has been Confirmed', false));
            } catch (\Throwable $e) {
                report($e);
            }
        }

        return redirect()->back()->with('success', 'Action Successful!');
    }


    public function viewdepositimage($id)
    {
        $deposit = Deposit::where('id', $id)->first();

        return view('admin.Deposits.depositimg', [
            'deposit' => $deposit,
            'title' => 'View Deposit Screenshot',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }


    //Get uplines
    function getAncestors($array, $deposit_amount, $parent = 0, $level = 0)
    {
        $referedMembers = '';
        $parent = User::where('id', $parent)->first();

        foreach ($array as $entry) {
            if ($entry->id == $parent->ref_by) {
                //get settings 
                $settings = Settings::where('id', '=', '1')->first();

                if ($level == 1) {
                    $earnings = $settings->referral_commission1 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 2) {
                    $earnings = $settings->referral_commission2 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 3) {
                    $earnings = $settings->referral_commission3 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 4) {
                    $earnings = $settings->referral_commission4 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 5) {
                    $earnings = $settings->referral_commission5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                }

                if ($level == 6) {
                    break;
                }

                //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
                $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level + 1);
            }
        }
        return $referedMembers;
    }

    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }
}
