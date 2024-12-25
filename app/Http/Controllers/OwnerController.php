<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Owner;
use Illuminate\Support\Facades\Auth;

class OwnerController extends BaseController
{
    public function __construct()
    {
        $this->middleware(['auth', 'check.role:owner']);
    }

    public function index()
    {
        $owners = Owner::all();
        return view('owner.index', compact('owners'));
    }

    public function create()
    {
        return view('owner.create');
    }

    public function store(Request $request)
    {
        $owner = new Owner();
        $owner->name = $request->input('name');
        $owner->email = $request->input('email');
        $owner->save();
        return redirect()->route('owner.index');
    }

    public function show($id)
    {
        $owner = Owner::find($id);
        return view('owner.show', compact('owner'));
    }

    public function edit($id)
    {
        $owner = Owner::find($id);
        return view('owner.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);
        $owner->name = $request->input('name');
        $owner->email = $request->input('email');
        $owner->save();
        return redirect()->route('owner.index');
    }

    public function destroy($id)
    {
        $owner = Owner::find($id);
        $owner->delete();
        return redirect()->route('owner.index');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function seePayment()
    {
        return view('owner.payment-details');
    }

    public function dashboard()
    {
        return view('owner.dashboard');
    }

    public function changePassword()
    {
        return view('owner.change-password');
    }

    public function notices()
    {
        return view('owner.notices');
    }

    public function payments()
    {
        return view('owner.payments');
    }

    public function studentList()
    {
        return view('owner.student-list');
    }

    public function teacherList()
    {
        return view('owner.teacher-list');
    }
}
