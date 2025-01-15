<?php

namespace App\Http\Controllers\Auth;

use App\Interfaces\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PasswordChangeRequest;

class UpdatePasswordController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    public function edit() {
        return view('auth.passwords.edit');
    }

    public function update(PasswordChangeRequest $request) {
        $request = $request->validated();
        if (Hash::check($request['old_password'], Auth::user()->password)) {
            // The passwords match...
            try{
                $this->userRepository->changePassword($request['new_password']);

                return back()->with('status', 'Changing password was successful!');
            } catch (\Exception $e) {
                return back()->withError($e->getMessage());
            }
        } else {
            return back()->withError('Password mismatched!');
        }
    }
}
