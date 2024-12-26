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

        .col-form-label {
            resize: none;
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

    <h3 class="text-center mt-3 mb-3 text-danger">Arama Sonuçları: "{{ $query }}"</h3>

    <h4 class="text-center mt-3 mb-3 text-info">Kitaplar</h4>

    <div class="container d-flex">

        @if ($books->isEmpty())
            <div class="w-100 mb-5 mt-5">
                <p class="text-center">Aradığınız kitap bulunamadı.</p>
            </div>
        @else
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
                                @if (isset($book->user->profile_image) && !empty($book->user->profile_image))
                                    <img src="{{ asset($book->user->profile_image) }}" alt="User Image"
                                        class="user-img rounded-circle">
                                @else
                                    <img src="{{ asset('assets/images/bookalemun_logo.png') }}" alt="Default User Image"
                                        class="user-img rounded-circle">
                                @endif
                            </div>
                            <p class="user-name">{{ $book->user->user_name }}</p>

                            <a href="" class="btn btn-primary btn-card btn-cat" data-id="{{ $book->id }}"
                                data-title="{{ $book->book_name }}" data-author="{{ $book->author }}"
                                data-image="{{ asset($book->book_image) ?? asset('assets/images/bookalemun_logo.png') }}"
                                data-user-image="{{ asset($book->user->profile_image) ?? asset('assets/images/bookalemun_logo.png') }}"
                                data-user-name="{{ $book->user->user_name }}" data-bs-toggle="modal"
                                data-bs-target="#book-modal">
                                Görüntüle
                            </a>

                            <x-istek-modal />


                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection


@section('js')
    <script>
        $(document).ready(function() {

            $('#book-modal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const title = button.data('title');
                const author = button.data('author');
                const image = button.data('image');
                const userImage = button.data('user-image');
                const userName = button.data('user-name');

                const modal = $(this);
                modal.find('#modal-book-title').text(title);
                modal.find('#modal-book-author').text(author);
                modal.find('#modal-book-image').attr('src', image);
                modal.find('#modal-user-image').attr('src', userImage);
                modal.find('#modal-user-name').text(userName);
            });
        });

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
    </script>
@endsection
