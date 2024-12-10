<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function signIn(UserRequest $request)
    {
        if (!$request->name && !$request->email && !$request->password) {
            return response()->json([
                'message' => "please enter all the details to sign in",
                'status' => 0
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
        }

        return response()->json([
            'message' => 'user created successfully',
            'response' => 200
        ]);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $userPw = $user->where('email', $user->email)->pluck('password');

        if (!$request->email) {
            return response()->json([
                'message' => 'Please enter email',
                'status' => 0
            ]);
        } elseif ($request->password != Hash::check($request->password, $userPw[0])) {
            return response()->json([
                'message' => 'Wrong Password',
                'status' => 0
            ]);
        } else {
            $user->save();
            return response()->json([
                'data' => $user,
                'token' => $user->createToken('Api Token')->plainTextToken,
                'message' => 'user logged in',
                'status' => '1'
            ]);
        }
    }

    public function logout(User $user)
    {
        $user->tokens()->delete();
        return response()->json([
            'message' => 'User logged out',
            'status' => 1
        ]);
    }

    public function forgot_password(Request $request)
    {
        if (!$request->email) {
            return response()->json([
                'message' => 'Please enter mail'
            ]);
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'message' => 'no such mail exist'
                ]);
            } else {
                $newPW = str()->random(10);

                $user->password = Hash::make($newPW);
                $user->save();
                Mail::to($request->email)->send(new ForgotPasswordMail($newPW));

                return response()->json([
                    'message' => 'New password for your account has been sent to your mail',
                    'status' => 1
                ]);
            }
        }
    }

    public function change_password(User $user, Request $request)
    {
        if (Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'Old password incorrect'
            ]);
        } elseif ($request->new_password != $request->confirm_new_password) {
            return response()->json([
                'message' => 'Confirm password wrong'
            ]);
        } else {
            if (!$request->new_password || !$request->confirm_new_password) {
                return response()->json([
                    'message' => 'Enter new password to change the existing password'
                ]);
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();
                return response()->json([
                    'message' => 'The password has been changed',
                    'status' => 1
                ]);
            }

        }
    }
}
