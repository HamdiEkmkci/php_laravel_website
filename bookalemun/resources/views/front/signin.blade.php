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
            font-size: 36px;
            text-align: center;
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
    </style>
@endsection


@section('icerik')
    <div class="login">
        <div class="wrapper">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <h1>Kayıt Ol</h1>

                <div class="input-box">
                    <input id="user_name" type="text" name="user_name" placeholder="Kullanıcı Adı"
                        value="{{ old('user_name') }}" required>
                </div>

                <div class="input-box">
                    <input id="email" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}"
                        required>
                </div>

                <div class="input-box">
                    <input id="password" type="password" name="password" placeholder="Şifre" required>
                </div>

                <button type="submit" class="btn">Kayıt Ol</button>
            </form>

        </div>
    </div>
@endsection

@section('js')
@endsection
