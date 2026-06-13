<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;

class LogicController extends Controller
{
    public function addagent(Request $request)
    {
        $request->validate([
            'user' => ['required', 'exists:users,id'],
            'referred_users' => ['nullable', 'integer', 'min:0'],
        ]);

        Agent::updateOrCreate(
            ['agent' => $request->user],
            ['total_refered' => $request->input('referred_users', 0)]
        );

        return redirect()->back()->with('success', 'Agent saved successfully.');
    }

    public function viewagent($agent)
    {
        return view('admin.viewagent', [
            'title' => 'Agent record',
            'agent' => User::where('id', $agent)->first(),
            'ag_r' => User::where('ref_by', $agent)->get(),
        ]);
    }

    public function delagent($id)
    {
        Agent::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Agent removed successfully.');
    }
}
