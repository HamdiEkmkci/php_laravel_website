@extends('layouts.app')

@section('icerik')
    <div class="reset-pass">
        <div class="wrapper">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">
                <div class="input-box">
                    <input type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Yeni Şifre" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" placeholder="Yeni Şifre (Tekrar)" required>
                </div>
                <button type="submit" class="btn">Şifreyi Sıfırla</button>
            </form>
        </div>
    </div>
@endsection
