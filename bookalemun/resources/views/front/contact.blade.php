@extends('layouts.front')

@section('css')
    <style>
        #contact {
            margin-top: 4rem;
            margin-bottom: 10rem;
        }

        #contact h2 {
            font-size: 2.5rem;
            color: brown;
            text-align: center;
        }

        #contact-form {
            width: 70%;
            margin: 0 auto;
            text-align: left;
        }

        .contact-container {
            width: 100%;
            margin: auto;
            padding-left: 2rem;
            padding-right: 2.5rem;
        }

        .form-group {
            width: 50%;
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 1rem;
            margin-bottom: 3rem;
            margin-left: 25%;
            background-color: floralwhite;
        }

        .form-group input,
        .form-group textarea {
            border: none;
            width: 100%;
            display: block;
            font-size: 1.2rem;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: 0;
        }

        .form-group textarea {
            resize: none;
        }

        .contact-send-button {
            margin-left: 40%;
            border: 1px solid #2D3D4F;
            background-color:floralwhite ;
            color: #2D3D4F;
            font-weight: 600;
            font-family: Montserrat;
            float: left;
            text-align: center;
            padding: 1.5rem 5rem;
            border-radius: 10px;
            transition: all .5s;
            cursor: pointer;
        }

        .contact-send-button:hover {
            background-color: #2D3D4F;
            color: floralwhite;
            transition: 0.75s;
        }

        .star-dark {
            border: none;
            color: brown;
            border-top: 0.4rem solid brown;
            max-width: 28rem;
            border-radius: 10px;
            margin: 2.5rem auto;
            overflow: visible;
            height: 0%;
        }

        .star-dark::after {
            color: brown;
            background-color: #fff;
            content: "\2605";
            font-weight: 900;
            font-size: 3.2rem;
            position: relative;
            top: -40px;
            left: 43%;
            padding: 0 8px;
        }

        @media screen and (max-width: 840px){
            .contact-send-button {
                padding: 1.5rem 3rem;
            }
        }
    </style>
@endsection

@section('icerik')
    <hr>

    <section id="contact">

        <div class="contact-container">

            <h2 class="text-uppercase">
                Contact Us
            </h2>

            <hr class="star-dark">

            <form class="w-75 mx-auto" action="contact-form">

                <div class="form-group">
                    <input type="text" id="name" placeholder="İsim">
                </div>

                <div class="form-group">
                    <input type="text" id="email" placeholder="Email">
                </div>

                <div class="form-group">
                    <input type="text" id="phone" placeholder="Telefon">
                </div>

                <div class="form-group">
                    <textarea id="message" rows="5" placeholder="Mesajınız ya da yorum ve önerileriniz..."></textarea>
                </div>

                <button class="contact-send-button">
                    Send
                </button>

            </form>

        </div>

    </section>
@endsection

@section('js')
@endsection
