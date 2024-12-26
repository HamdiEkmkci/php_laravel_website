@extends('layouts.front')

@section('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .login {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .wrapper {
            background-color: floralwhite;
            width: 26rem;
            padding: 4rem 5rem;
            border-radius: 30px;
        }

        .wrapper h1 {
            font-family: "Permanent Marker", cursive;
            font-weight: 400;
            font-style: normal;
            text-align: center;
            letter-spacing: 5px;
        }

        .wrapper .input-box {
            position: relative;
            width: 100%;
            height: 50px;
            margin: 30px 0;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            border: 2px solid rgb(165, 42, 42, .2);
            border-radius: 40px;
            padding: 20px 45px 20px 20px;
        }

        .input-box input::placeholder {
            color: brown;
        }

        .input-box i {
            position: absolute;
            right: 20px;
            top: 30%;
            transform: translate(-50%);
            font-size: 20px;
        }

        .wrapper .remember-forgot {
            display: flex;
            justify-content: space-around;
            font-size: 14px;
            margin: -15px 0 15px;
        }

        .remember-forgot label input {
            margin-right: 5px;
        }

        .remember-forgot a {
            color: brown;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .wrapper .btn {
            width: 100%;
            height: 45px;
            border: none;
            outline: none;
            border-radius: 40px;
            box-shadow: 0 0 10px rgb(0, 0, 0, .1);
            cursor: pointer;
            color: brown;
            font-weight: 600;
            margin-bottom: 2rem;
        }

        .wrapper .register-link {
            font-size: 14.5px;
            text-align: center;
        }

        .register-link p a {
            color: brown;
            text-decoration: none;
            font-weight: 600;
            margin-left: 5px;
        }

        .register-link p a:hover {
            text-decoration: underline;
        }
    </style>
@endsection


@section('icerik')
    <div class="login">
        <div class="wrapper">

            @if ($errors->has('email'))
                <div class="alert alert-danger">
                    {{ $errors->first('email') }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <h1 class="text-uppercase">Giriş</h1>

                <div class="input-box">
                    <input id="email" type="text" name="email" placeholder="E-posta"
                        value="{{ old('email') }}" required>
                    <i class="fa-solid fa-user"></i>
                    @error('username')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <input id="password" type="password" name="password" placeholder="Şifre" required>
                    <i class="fa-solid fa-lock"></i>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember">Beni Hatırla</label>
                    <a href="{{ route('forgotpassword') }}">Şifremi Unuttum</a>
                </div>


                <button type="submit" class="btn">Giriş</button>

                <div class="register-link">
                    <p>Henüz bir hesabınız yok mu?<a href="{{ route('signin') }}">Kayıt ol</a></p>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('js')
@endsection
