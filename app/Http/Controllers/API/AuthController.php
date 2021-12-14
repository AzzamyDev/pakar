<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'no_telpon' => 'required|unique:users',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'no_telpon' => $validatedData['no_telpon'],
            'created_at' => now(),
        ]);
        //memberikan role sebagai user
        $user->assignRole('user');

        return response()->json([
            'status' => true,
            'message' => 'Yeay... ' . $user->name . ' kamu telah berhasil mendaftar'
        ], 200);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => false,
                'message' => 'Email / Password Salah.'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $request->user(),
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $tokenId = $request->user()->currentAccessToken()->id;
        $token = $user->tokens()->where('id', $tokenId);
        if ($token == null) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Token ID',
            ]);
        }

        $token->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout Succesfully',
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if ($request->name != null) {
            $user->name = $request->name;
        }
        if ($request->email != null) {
            $user->email = $request->email;
        }
        if ($request->no_telpon != null) {
            $user->no_telpon = $request->no_telpon;
        }
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profile Edited'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json(['data' => $request->user()]);
    }

    public function sendPasswordResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => __($status)], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => __($status)
            ]);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => __($status)], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => __($status)
            ]);
        }
    }
}
