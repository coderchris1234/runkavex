<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login', [
            'pageTitle' => 'Login account | Runkavex Capital',
            'metaDesc' => 'Login account',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $field = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$field => $credentials['email'], 'password' => $credentials['password']], $request->boolean('remember'))) {
            if (! Auth::user()->is_active) {
                Auth::logout();

                return back()->withErrors(['email' => 'Your account has been deactivated. Please contact support.'])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()
            ->withErrors(['email' => 'These credentials do not match our records.'])
            ->onlyInput('email');
    }

    public function showRegister()
    {
        return view('register', [
            'pageTitle' => 'Sign up | Runkavex Capital',
            'metaDesc' => 'Sign up',
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50', 'unique:users,username', 'regex:/^[a-zA-Z0-9_.-]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'max:20'],
            'country' => ['nullable', 'string', 'max:100'],
            'currency_code' => ['nullable', 'string', 'max:10'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $referrer = null;
        if ($request->filled('referral_code')) {
            $referrer = User::where('referral_code', $request->referral_code)->first();
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'gender' => $data['gender'] ?? null,
            'country' => $data['country'] ?? null,
            'currency_code' => $data['currency_code'] ?? 'USD',
            'password' => Hash::make($data['password']),
            'referral_code' => Str::upper(Str::random(8)),
            'referrer_id' => $referrer?->id,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('dashboard.index')->with('success', 'Welcome! Your account has been created.');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->with('status', 'If that email address exists in our records, a password reset link has been prepared.')->onlyInput('email');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        return back()->with('status', 'Your password reset link has been generated.')->with('reset_link', url('/reset-password/' . $token));
    }

    public function showResetForm(string $token)
    {
        $record = DB::table('password_resets')->get()->first(function ($r) use ($token) {
            return Hash::check($token, $r->token);
        });

        if (!$record) {
            return redirect()->route('login')->withErrors(['email' => 'This password reset link is invalid or has already been used.']);
        }

        if ($record->created_at && now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_resets')->where('email', $record->email)->delete();

            return redirect()->route('login')->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        return view('reset-password', [
            'pageTitle' => 'Reset password | Runkavex Capital',
            'metaDesc' => 'Reset your password',
            'token' => $token,
            'email' => $record->email,
        ]);
    }

    public function resetPassword(Request $request, string $token)
    {
        $data = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $record = DB::table('password_resets')->where('email', $data['email'])->first();

        if (!$record || !Hash::check($token, $record->token)) {
            return back()->withErrors(['email' => 'This password reset link is invalid or has already been used.']);
        }

        if ($record->created_at && now()->diffInMinutes($record->created_at) > 60) {
            DB::table('password_resets')->where('email', $data['email'])->delete();

            return back()->withErrors(['email' => 'This password reset link has expired. Please request a new one.']);
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account was found with that email address.']);
        }

        $user->update(['password' => Hash::make($data['password'])]);

        DB::table('password_resets')->where('email', $data['email'])->delete();

        return redirect()->route('login')->with('success', 'Your password has been reset. Please sign in with your new password.');
    }
}