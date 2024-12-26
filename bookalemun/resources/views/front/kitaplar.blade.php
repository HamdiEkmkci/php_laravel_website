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
            margin: 4rem;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-left: -1rem;
        }

        .btn {
            font-size: 10px;
        }

        .card {
            float: left;
            width: 100%;
            height: 28rem;
            overflow: hidden;
        }

        .card-img {
            width: 100%;
            height: 15em;
        }

        .no-image-placeholder {
            width: 15em;
            height: 15em;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #999;
        }

        .btn-card {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
        }



        .modal-title {
            margin-left: 175px;
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
                bottom: 20px;
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
                bottom: 20px;
            }

            .btn-card:hover {
                opacity: 1;
            }

            .row {
                margin-bottom: 1.5rem;
            }


        }
    </style>
@endsection

@section('icerik')
    <hr>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div class="sidenav">

            <div class="profile">
                <img src="{{ asset( Auth::user()->profile_image) ?? asset('assets/images/bookalemun_logo.png') }}" alt="profile image"
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

        <div class="main">
            @if ($kitaplar->isEmpty())
                <div class="text-center my-5">
                    <h4>Kitap bulunamadı.</h4>
                </div>
            @else
                <div class="row">
                    @foreach ($kitaplar as $book)
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="card">
                                @if (!isset($book->book_image) || empty($book->book_image))
                                    <div class="no-image-placeholder">
                                        No Image
                                    </div>
                                @else
                                    <img src="{{ asset($book->book_image) }}" alt="Book Cover" class="card-img">
                                @endif

                                <div class="card-body text-center">
                                    <h6 class="card-title">{{ $book->book_name }}</h6>
                                    <p class="card-text">{{ $book->author }}</p>
                                    <a href="" class="btn btn-primary btn-card" data-title="{{ $book->book_name }}"
                                        data-author="{{ $book->author }}" data-image="{{ asset($book->book_image) }}"
                                        data-bs-toggle="modal" data-bs-target="#book-modal">
                                        Görüntüle
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif




            <div class="modal fade" id="book-modal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookModalLabel">Kitap Detayları</h5>
                            <button type="button" class="close btn-x" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (!isset($book->book_image))
                                <div class="no-image-placeholder mb-3 mx-auto">
                                    No Image
                                </div>
                            @else
                                <div style="width: 18em;height:auto;" class="mb-3 mx-auto">
                                    <img src="{{ asset($book->book_image) }}" alt="Book Cover"
                                        class="img-fluid w-100 text-center">
                                </div>
                            @endif
                            <h6 id="modal-book-title"></h6>
                            <p id="modal-book-author"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="add-book-modal" tabindex="-1" role="dialog" aria-labelledby="addBookModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addBookModalLabel">Kitap Ekle</h5>
                            <button type="button" class="close btn-x" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-auto">
                            <div class="card mb-2 mt-2">
                                <div style="width: 10em;height:10em;">
                                    <img id="modal-book-image" src="" alt="Book Cover" class="img-fluid mb-3">
                                </div>
                                <div class="card-body text-center overflow-auto">
                                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="book-image">Kitap Resmi</label>
                                            <input type="file" class="form-control" id="book-image" name="book_image"
                                                onchange="previewImage(event)">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="book-name">Kitap Adı</label>
                                            <input type="text" class="form-control" id="book-name" name="book_name"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="author">Yazar</label>
                                            <input type="text" class="form-control" id="author" name="author"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="page-count">Sayfa Sayısı</label>
                                            <input type="number" class="form-control" id="page-count" name="page_count"
                                                required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="category">Kategori</label>
                                            <select class="form-control" id="category" name="category_id" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Kitap Ekle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div style="margin-right:10rem;" class="text-end mb-5">
        <a href="#" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#add-book-modal">Kitap
            Ekle</a>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#book-image').on('change', function(event) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#modal-book-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });

            $('.btn-card').on('click', function() {
                var bookTitle = $(this).data('title');
                var bookAuthor = $(this).data('author');
                var bookImage = $(this).data('image');

                $('#modal-book-title').text(bookTitle);
                $('#modal-book-author').text(bookAuthor);
                $('#modal-book-image').attr('src', bookImage);

                $('#book-modal').modal('show');
            });

            $('a[data-bs-target="#add-book-modal"]').on('click', function() {
                $('#modal-book-image').attr('src', 'default-image.jpg');
                $('#book-name').val('');
                $('#author').val('');
                $('#page-count').val('');
                $('#category').val('');
            });

            $('.close').on('click', function() {
                $('#book-modal').modal('hide');
            });
        });
    </script>
@endsection
