@extends('layouts.front')

@section('css')
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .sidenav {
            color: #333;
            border-bottom-right-radius: 25px;
            border-top-right-radius: 25px;
            padding-top: 2.5rem;
            width: 25%;
        }

        .url,
        hr {
            text-align: center;
        }

        .url hr {
            margin-left: 22%;
            width: 60%;
        }

        .url a {
            color: #818181;
            display: block;
            font-size: 1.2em;
            margin: 10px 0;
            padding: 6px 8px;
            text-decoration: none;
        }

        .url a:hover,
        .url .active {
            background-color: #e8f5ff;
            border-radius: 28px;
            color: #000;
            margin-left: 10%;
            width: 88%;
        }

        .profile img {
            width: 5em;
            height: 5em;
            border-radius: 50%;
            box-shadow: 0px 0px 5px 1px grey;
        }

        .profile {
            margin-bottom: 20px;
            margin-top: -12px;
            text-align: center;
        }

        .name {
            font-size: 1.2em;
            font-weight: bold;
            padding-top: 20px;
        }

        .container {
            display: flex;
            width: 100%;
            margin-top: 2rem;
            margin-bottom: 5rem;
        }

        .chat {
            width: 60%;
            margin-left: 8%;
            height: 70vh;
            display: flex;
            flex-direction: column;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            align-self: center;
        }

        .top {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            background-color: floralwhite;
            justify-content: space-between;
        }

        .top img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .top div {
            margin-left: 15px;
        }

        .top p {
            margin-bottom: 0;
            font-weight: bold;
        }

        .messages {
            flex-grow: 1;
            padding: 15px;
            overflow-y: scroll;
        }

        .message {
            font-weight: var(--bs-body-font-weight);
            line-height: var(--bs-body-line-height);
            text-align: var(--bs-body-text-align);
            -webkit-text-size-adjust: 100%;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
            font-family: "Nunito", sans-serif;
            font-size: 1rem;
            color: #161c2d;
            word-wrap: break-word;
            box-sizing: border-box;
            list-style: none;
            margin-bottom: 0 !important;
            padding: 1rem !important;
        }

        .message {
            margin-bottom: 1rem;

            p {
                display: inline-flex;
                font-weight: var(--bs-body-font-weight);
                line-height: var(--bs-body-line-height);
                text-align: var(--bs-body-text-align);
                font-family: "Nunito", sans-serif;
                word-wrap: break-word;
                list-style: none;
                box-sizing: border-box;
                font-size: 0.875em;
                margin: 0.25rem;
                padding: 0.5rem 1rem !important;
                color: #6c757d !important;
                background-color: rgba(var(--bs-light-rgb), 1) !important;
                border-radius: var(--bs-border-radius) !important;
            }
        }

        .left {
            text-align: left;
        }

        .right {
            text-align: right;
        }

        .bottom {
            display: flex;
            width: 100%;
            background-color: floralwhite;
            align-items: center;
            padding: 10px 15px;
            border-top: 1px solid #eee;
        }

        form {
            width: 100%;
        }

        .bottom input {
            flex-grow: 1;
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc
        }

        .send-button {
            background-color: brown;
            width: 6em;
            height: 3.5em;
            border: none;
            color: white;
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 8px 8px;
            cursor: pointer;
            border-radius: 5px;
        }

        .send-button:hover {
            background-color: #4CAF50;
        }

        @media (max-width: 768px) {
            .bottom input {
                width: 70%;
            }
        }

        @media (max-width: 480px) {
            .bottom input {
                width: 60%;
            }
        }
    </style>
@endsection

@section('icerik')
    <hr>

    <div class="container">
        <div class="sidenav">
            <div class="profile">
                <img src="{{ Auth::user()->profile_image ?? asset('assets/images/bookalemun_logo.png') }}" alt="profile image"
                    width="100" height="100">
                <div class="name">{{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}</div>
            </div>

            <div class="sidenav-url">
                <div class="url">
                    <a href="{{ route('profile') }}"
                        class="{{ Route::currentRouteName() == 'profile' ? 'active' : '' }}">Profile</a>
                    <hr align="center">
                </div>
                <div class="url">
                    <a href="{{ route('kitaplar') }}"
                        class="{{ Route::currentRouteName() == 'kitaplar' ? 'active' : '' }}">Kitaplar</a>
                    <hr align="center">
                </div>
                <div class="url">
                    <a href="{{ route('mesajlar') }}"
                        class="{{ Route::currentRouteName() == 'mesajlar' ? 'active' : '' }}">Mesajlar</a>
                    <hr align="center">
                </div>
                <div class="url">
                    <a href="{{ route('istekler') }}"
                        class="{{ Route::currentRouteName() == 'istekler' ? 'active' : '' }}">İstekler</a>
                    <hr align="center">
                </div>
            </div>
        </div>

        <div class="chat">

            <!-- Header -->
            <div class="top">
                <img id="receiverImage" src="" alt="Avatar">
                <div>
                    <p id="receiverName"></p>
                </div>
                <div>
                    <select class="rounded" name="user_select" id="userSelect">
                        <option value="" disabled selected>Kullanıcı Değiştir</option>
                        @php
                            $users = App\Models\User::where('id', '!=', Auth::id())->get();
                        @endphp

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" data-name="{{ $user->user_name }}"
                                data-image="{{ $user->profile_image ?? asset('assets/images/bookalemun_logo.png') }}">
                                {{ $user->user_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- End Header -->

            <div class="messages">
                {{-- Mesajlar --}}
            </div>
            <!-- End Chat -->

            <!-- Footer -->
            <div class="bottom">
                <form id="messageForm">
                    @csrf
                    <input type="text" id="message" name="message" placeholder="Mesaj giriniz..." autocomplete="off">
                    <button class="send-button" type="submit">Gönder</button>
                </form>
            </div>
            <!-- End Footer -->

        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            let firstUserOption = $('#userSelect option').eq(1);
            let firstUserId = firstUserOption.val();
            let firstUserName = firstUserOption.data('name');
            let firstUserImage = firstUserOption.data('image');

            $('#receiverName').text(firstUserName);
            $('#receiverImage').attr('src', firstUserImage);

            loadMessages(firstUserId);

            $('#userSelect').on('change', function() {
                let selectedUserId = $(this).val();
                let selectedUserName = $(this).find('option:selected').data('name');
                let selectedUserImage = $(this).find('option:selected').data('image');

                localStorage.setItem('selectedUserId', selectedUserId);
                localStorage.setItem('selectedUserName', selectedUserName);
                localStorage.setItem('selectedUserImage', selectedUserImage);


                loadMessages(selectedUserId);
            });


            $('#messageForm').submit(function(event) {
                event.preventDefault();

                let receiverId = $('#userSelect').val();
                let messageContent = $('#message').val();

                if (receiverId) {
                    $.ajax({
                        url: "/send-message",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            message: messageContent,
                            receiver_id: receiverId
                        }
                    }).done(function(res) {
                        let messageHtml = `<div class="message right">${res.message.message}</div>`;
                        $('.messages').append(messageHtml);

                        $('#message').val('');
                        $('.messages').scrollTop($('.messages')[0].scrollHeight);

                        loadMessages(receiverId);
                    });
                }
            });

            const savedUserId = localStorage.getItem('selectedUserId');
            if (savedUserId) {
                $('#userSelect').val(savedUserId);
                loadMessages(savedUserId);
            }
        });

        function loadMessages(receiverId) {
            $.ajax({
                url: `/fetch-message/${receiverId}`,
                method: 'GET',
                success: function(messages) {
                    $('.messages').empty();

                    let selectedUserName = $('#userSelect').find('option:selected').data('name');
                    let selectedUserImage = $('#userSelect').find('option:selected').data('image');

                    $('#receiverName').text(selectedUserName);
                    $('#receiverImage').attr('src', selectedUserImage);

                    messages.forEach(message => {
                        let messageHtml;

                        if (message.sender_id == {{ Auth::id() }}) {
                            messageHtml = `<div class="message right">${message.message}</div>`;
                        } else {
                            messageHtml = `<div class="message left">${message.message}</div>`;
                        }

                        $('.messages').append(messageHtml);
                    });

                    $('.messages').scrollTop($('.messages')[0].scrollHeight);
                }
            });
        }
    </script>
@endsection
