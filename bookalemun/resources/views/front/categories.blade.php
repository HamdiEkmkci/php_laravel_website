@extends('layouts.front')

@section('css')
    <style>
        .btn-close:hover {
            border: none;
            background-color: red;
            color: floralwhite;
        }

        .card {
            width: 12em;
        }

        .card-img {
            width: 100%;
            height: 12em;
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

        .btn-cat {
            font-size: .8em;
            padding: 5px 20px;
        }

        .user-image {
            position: relative;
            margin: auto;
            width: 4em;
            height: 4em;
            border-radius: 50%;
        }

        .user-image img {
            width: 100%;
            height: auto;
        }

        .user-name {
            font-weight: .5em;
        }
    </style>
@endsection

@section('icerik')

    <hr>

    <div class="mb-3 mt-3">
        <h1 style="color: brown" class="text-center">{{ $category->category_name }} Kategorisi</h1>

    </div>
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif


        @if (!$books->isEmpty())
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-5 mt-3">
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
                                <div class="user-image rounded-circle">
                                    <img src="{{ asset($book->user->profile_image) ?? asset('assets/images/bookalemun_logo.png') }}"
                                        alt="User Image" class="user-img rounded-circle">
                                </div>
                                <p class="user-name">{{ $book->user->user_name }}</p>
                                <a href="" class="btn btn-primary btn-card btn-cat" data-id="{{ $book->id }}"
                                    data-title="{{ $book->book_name }}" data-author="{{ $book->author }}"
                                    data-image="{{ asset($book->book_image) ?? '' }}"
                                    data-user-image="{{ asset($book->user->profile_image) ?? '' }}"
                                    data-user-name="{{ $book->user->user_name }}" data-bs-toggle="modal"
                                    data-bs-target="#book-modal">
                                    Görüntüle
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <hr style="color: brown;" class="w-50 mx-auto">
            <div class="mb-5 mt-5 text-center">Bu kategoride henüz kitap bulunmamaktadır.</div>
        @endif


    </div>

    <x-istek-modal />

@endsection

@section('js')
    <script>
        $(document).on('click', '.btn-cat', function(e) {
            e.preventDefault();

            let bookId = $(this).data('id');

            $.ajax({
                url: '/books/increase-view',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    book_id: bookId
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.message); 
                    }
                },
                error: function(xhr) {
                    console.error("Bir hata oluştu.");
                }
            });
        });


        $(document).ready(function() {
            const modal = $('#book-modal');

            modal.on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const title = button.data('title');
                const author = button.data('author');
                const image = button.data('image');

                const modalTitle = $('#modal-book-title');
                const modalAuthor = $('#modal-book-author');
                const modalImage = $('#modal-book-image');

                modalTitle.text(title);
                modalAuthor.text(author);
                modalImage.attr('src', image);
            });

            $('.btn-card').on('click', function() {
                var bookId = $(this).data('id');
                var bookTitle = $(this).data('title');
                var bookAuthor = $(this).data('author');
                var bookImage = $(this).data('image');
                var userImage = $(this).data('user-image');
                var userName = $(this).data('user-name');

                $('#modal-book-id').val(bookId);
                $('#modal-book-title').text(bookTitle);
                $('#modal-book-author').text(bookAuthor);
                $('#modal-book-image').attr('src', bookImage);
                $('#modal-user-image').attr('src', userImage);
                $('#modal-user-name').text(userName);

                $('#book-modal').modal('show');
            });
        });
    </script>
@endsection
