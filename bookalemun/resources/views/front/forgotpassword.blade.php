@extends('layouts.front')

@section('css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .forgot-pass {
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
            font-family: "Permanent Marker", cursive, sans-serif;
            font-weight: 500;
            font-style: normal;
            text-align: center;
            font-size: 1.5em;
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

        .responce-box {
            display: none;
            width: 100%;
            height: 50px;
            font-size: 1em;
            padding-left: 10px;
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

        .wrapper .btn:hover {
            color: floralwhite;
            background-color: brown;
            transition: all .6s;
        }

    </style>
@endsection


@section('icerik')
    <div class="forgot-pass">
        <div class="wrapper">
            <form action="">
                @csrf
                <h1>Şifremi Sıfırla</h1>
                <div class="input-box">
                    <input id="email" type="email" placeholder="E-mail" required>
                </div>

                <div class="responce-box">
                    <p>Şifreniz başarıyla değiştirildi.</p>
                </div>

                <button type="submit" class="btn">Gönder</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
