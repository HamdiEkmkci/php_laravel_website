<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        $token = Str::random(60);

        $user->update([
            'password_reset_token' => $token,
        ]);


        $resetLink = route('password.custom.reset.form', ['token' => $token, 'email' => $user->email]);

        Mail::send('password-reset.reset-link', ['resetLink' => $resetLink], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Şifre Sıfırlama Bağlantınız:');
        });

        return redirect()->back()->with('success', 'Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
            ->where('password_reset_token', $request->token)
            ->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Geçersiz veya süresi dolmuş sıfırlama bağlantısı.']);
        }


        $user->update([
            'password' => Hash::make($request->password),
            'password_reset_token' => null,
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Şifreniz başarıyla güncellendi.');
    }

    public function updateImage(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($user->profile_image) {
            Storage::delete($user->profile_image);
        }

        $path = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = 'storage/' . $path;

        $user->save();

        return redirect()->back()->with('success', 'Profil resmi başarıyla güncellendi.');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_fname' => 'nullable|string|max:255',
            'user_lname' => 'nullable|string|max:255',
        ]);

        $user->user_fname = $request->input('user_fname');
        $user->user_lname = $request->input('user_lname');

        $user->save();

        return redirect()->back()->with('success', 'Kişisel bilgiler başarıyla güncellendi.');
    }


    public function updateExtra(Request $request, $id)
    {
        $request->validate([
            'favourite_aut' => 'nullable|string|max:255',
            'favourite_book' => 'nullable|string|max:255',
            'fb_page_count' => 'nullable|integer|min:0',
        ]);

        $user = User::findOrFail($id);

        $user->favourite_aut = $request->input('favourite_aut');
        $user->favourite_book = $request->input('favourite_book');
        $user->fb_page_count = $request->input('fb_page_count');

        $user->save();

        return redirect()->back()->with('success', 'Ekstra bilgiler başarıyla güncellendi.');
    }
}
