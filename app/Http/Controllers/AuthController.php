<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            [
                'email' => $googleUser->email,
            ],
            [
                'name'      => $googleUser->name,
                'google_id' => $googleUser->id,
                'avatar'    => $googleUser->avatar,
                'password'  => bcrypt('google_login'),
            ]
        );

        Auth::login($user);

        if (session()->has('employee_data')) {
            $data = session('employee_data');

            \App\Models\Employee::create([
                'employee_name' => $data['employee_name'],
                'mobile' => $data['mobile'],
            ]);

            session()->forget('employee_data');
        }

        return redirect('/');
    }
}
