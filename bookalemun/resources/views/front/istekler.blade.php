@extends('layouts.front')

@section('css')
    <style>
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
            margin-left: 20%;
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
            margin-left: 14%;
            width: 65%;
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

        .main {
            width: 85%;
        }

        .btn {
            font-size: 10px;
        }

        .card {
            float: left;
            width: 15em;
            height: 25em;
            margin: 10px;
        }

        .card>img {
            width: 100%;
            height: 40%;
        }

        .card>.card-body {
            text-align: center;
        }

        .card>.card-body>p {
            margin-top: 10px;
        }

        .btn-card {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .modal-title {
            margin-left: 175px;
        }

        .sent-modal-image {
            width: 3em;
            height: 3em;
            margin: auto;
            border-radius: 50%;
        }

        .sent-modal-image>img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        #modal-book-image {
            margin-left: 130px;
            width: 50%;
            height: auto;
        }

        #modal-book-title {
            text-align: center;
        }

        #modal-book-author {
            text-align: center;
        }

        .btn-x {
            position: absolute;
            top: 5;
            right: 0;
            border: none;
            border-radius: 20%;
        }

        .close:hover {
            background-color: red;
        }


        @media only screen and (max-width: 768px) {

            .btn {
                padding: 0.2rem 2rem;
                font-size: .8rem;
            }

            .card-body {
                padding: 8px;
            }

            .btn-card {
                position: absolute;
                bottom: 10px;
                left: 50%;
            }

            .btn-card:hover {
                opacity: 1;
            }
        }

        @media only screen and (max-width: 480px) {


            .card-body {
                padding: 5px;
            }

            .btn-card {
                position: absolute;
                bottom: 10px;
                left: 50%;
            }

            .btn-card:hover {
                opacity: 1;
            }

        }
    </style>
@endsection

@section('icerik')
    <hr>
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- Main -->

    <div class="container">
        <div class="sidenav">

            <div class="profile">
                <img src="{{ asset(Auth::user()->profile_image) ?? asset('assets/images/bookalemun_logo.png') }}"
                    alt="profile image" width="100" height="100">
                <div class="name">{{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}</div>
            </div>


            <!-- Sidenav Start -->
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
        <!-- Sidenav End -->

        <div class="main">

            <h3 class="text-center mb-3 mt-3">Gönderdiğiniz İstekler</h3>
            @if ($sentRequests->isEmpty())
                <p class="text-center mb-3 mt-3">Henüz gönderdiğiniz takas isteği yok.</p>
            @else
                <div class="row">
                    @foreach ($sentRequests as $request)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <img src="{{ asset($request->book->book_image) }}" alt="Book Cover" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $request->book->book_name }}</h5>
                                    <p class="card-text">Yazar: {{ $request->book->author }}</p>
                                    <p class="card-text">Durum: {{ $request->status }}</p>
                                    <button class="btn btn-info btn-card btn-sent-detay" data-id="{{ $request->id }}"
                                        data-title="{{ $request->targetBook->book_name }}"
                                        data-author="{{ $request->targetBook->author }}"
                                        data-image="{{ asset($request->targetBook->book_image) }}">Detaylar</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="book-modal" tabindex="-1" role="dialog"
                            aria-labelledby="bookModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">İstenilen Kitap</h5>
                                        <button type="button" class="close btn-x" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="modal-book-image" src="" alt="Book Cover" class="img-fluid mb-3">
                                        <h6 id="modal-book-title"></h6>
                                        <p id="modal-book-author"></p>
                                        <div class="sent-modal-image mb-3">
                                            <img src="{{$request->targetBook->user->profile_image ? asset($request->targetBook->user->profile_image) : asset('assets/images/bookalemun_logo.png')  }}"
                                                alt="user_image">
                                        </div>
                                        <p style="text-align:center;">{{ $request->targetBook->user->user_name }}</p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-delete-request"
                                            data-id="{{ $request->id }}">İsteği
                                            İptal Et</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <h3 class="text-center mb-3 mt-5">Aldığınız İstekler</h3>
            @if ($receivedRequests->isEmpty())
                <p class="text-center mb-3 mt-3">Henüz aldığınız takas isteği yok.</p>
            @else
                <div class="row">
                    @foreach ($receivedRequests as $request)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card">
                                <img src="{{ asset($request->book->book_image) }}" alt="Book Cover" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $request->book->book_name }}</h5>
                                    <p class="card-text">Yazar: {{ $request->book->author }}</p>
                                    <p class="card-text">Durum: {{ $request->status }}</p>
                                    <p class="card-text">İstek Gönderen: {{ $request->book->user->user_name }}</p>
                                    <button class="btn btn-info btn-card btn-detay" data-id="{{ $request->id }}"
                                        data-title="{{ $request->targetBook->book_name }}"
                                        data-author="{{ $request->targetBook->author }}"
                                        data-image="{{ asset($request->targetBook->book_image) }}">Detaylar</button>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="book-modal" tabindex="-1" role="dialog"
                            aria-labelledby="bookModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="bookModalLabel">İstenilen Kitap</h5>
                                        <button type="button" class="close btn-x" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <img id="modal-book-image" src="" alt="Book Cover"
                                            class="img-fluid mb-3">
                                        <h6 id="modal-book-title"></h6>
                                        <p id="modal-book-author"></p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-danger btn-reject-request"
                                            data-id="{{ $request->id }}">İsteği Reddet</button>
                                        <button type="button" class="btn btn-success btn-accept-request"
                                            data-id="{{ $request->id }}">İsteği Kabul
                                            Et</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
    <!-- Main End -->
@endsection

@section('js')
    <script>
        var requestId;

        $('.btn-card').click(function() {
            $('#book-modal').modal('show');
        });

        $('.btn-delete-request').click(function(e) {
            e.preventDefault();

            const requestId = $(this).data('id');
            const confirmed = confirm("Bu isteği iptal etmek istediğinize emin misiniz?");

            if (confirmed) {
                $.ajax({
                    url: '/delete-request/' + requestId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        reqId: requestId
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        alert("Bir hata oluştu. Lütfen tekrar deneyin.");
                    }
                });
            }
        });

        $(document).ready(function() {
            $('.btn-card').on('click', function() {
                var bookTitle = $(this).data('title');
                var bookAuthor = $(this).data('author');
                var bookImage = $(this).data('image');

                $('#modal-book-title').text(bookTitle);
                $('#modal-book-author').text(bookAuthor);
                $('#modal-book-image').attr('src', bookImage);

                $('.btn-accept-request').attr('data-id', requestId);
                $('.btn-reject-request').attr('data-id', requestId);

                $('#book-modal').modal('show');
            });

            $('.btn-detay').on('click', function() {
                var targetBookTitle = $(this).data('target-title');
                var targetBookAuthor = $(this).data('target-author');
                var targetBookImage = $(this).data('target-image');
                requestId = $(this).data('id');

                $('#modal-target-book-title').text(targetBookTitle);
                $('#modal-target-book-author').text(targetBookAuthor);
                $('#modal-target-book-image').attr('src', targetBookImage);

                $('#target-book-modal').modal('show');
            });

            $('.btn-accept-request').on('click', function() {

                $.post(`/requests/accept/${requestId}`, {
                    _token: '{{ csrf_token() }}',
                    id: requestId
                }).done(function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                });
            });

            $('.btn-reject-request').on('click', function() {

                $.post(`/requests/reject/${requestId}`, {
                    _token: '{{ csrf_token() }}',
                    id: requestId
                }).done(function(response) {
                    if (response.success) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                });
            });
        });

        $('.close').on('click', function() {
            $('#book-modal').modal('hide');
        });

        $('.close').on('click', function() {
            $('#book-modal').modal('hide');
        });
    </script>
@endsection
