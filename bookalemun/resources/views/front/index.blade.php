@extends('layouts.front')

@section('css')
    <style>
        .book-container {
            width: 70%;
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .book-slider {
            width: 100%;
            display: flex;
            padding: 0 0;
            overflow-x: hidden;
            justify-content: center;
            align-items: center;
            text-align: center;

        }

        .book-slide {
            margin: 1rem 2rem;
            display: inline-block;
            flex: 0 0 15rem;
            transition: transform 0.6s ease;
        }

        .book-slide .card {
            border-top-left-radius: 80%;
            border-top-right-radius: 80%;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }

        .book-slide img {
            width: 100%;
            height: 18rem;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            margin-bottom: 1rem;
        }


        .prev-arrow,
        .next-arrow {
            font-size: 2.4rem;
            cursor: pointer;
            width: 1rem;
            padding: 10rem 0;
            opacity: 0.5;

        }

        textarea {
            resize: none;
        }


        @media screen and (max-width: 1200px) {


            .book-slider {
                overflow-x: visible;
            }

            .book-slide {
                width: 10rem;
                flex: 0 0 10rem;
                margin: 10px;
            }

            .book-slide .card {
                height: 20rem;
            }

            .book-slide img {
                height: 10rem;
            }

            .book-slide .card-body {
                position: relative;
                display: flex;
                flex-direction: column;
                align-items: space-around;
                margin: 0;
                padding: 0;

            }

            .book-slide a {
                align-self: center;
                font-size: 14px;
                padding: 0 10px;
                margin-bottom: 5px;
                position: absolute;
                bottom: 10px;
            }

            .book-slide h6 {
                font-size: 16px;
            }

            .book-slide .card-text {
                font-size: 14px;
            }

            .prev-arrow,
            .next-arrow {
                font-size: 1rem;
            }


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

        .user-image {
            position: relative;
            margin: auto;
            width: 3em;
            height: auto;
            border-radius: 50%;

        }

        .user-image img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .user-name {
            font-weight: .5em;
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

        @media screen and (max-width: 764px) {

            .book-slider {
                overflow-x: visible;
            }

            .book-slide .card {
                height: 14rem
            }

            .book-slide {
                width: 5rem;
                flex: 0 0 5rem;
                margin: 10px;
            }

            .book-slide img {
                height: 6rem;
            }

            .book-slide a {
                font-size: 10px;
                padding: 0 5px;
                margin-bottom: 5px;
            }

            .book-slide .card-body {
                margin: 0;
                padding: 0;
            }

            .book-slide h6 {
                font-size: 12px;
            }

            .book-slide .card-text {
                font-size: 10px;
            }

            .prev-arrow,
            .next-arrow {
                font-size: 1rem;
            }

        }



        h2 {
            text-align: center;
            padding: 1.5rem 0;
            color: green;
        }
    </style>
@endsection

@section('icerik')
    <hr>




    <div class="book-container">
        <h2>Most Viewed</h2>
        @if (isset($mostViewedBooks))
            <div class="book-slider">
                <span class="prev-arrow">&#10094;</span>

                @foreach ($mostViewedBooks as $book)
                    <div class="book-slide">
                        <div class="card mb-2 mt-2">
                            <img src="{{ asset($book->book_image) }}" alt="Book Cover" class="img-fluid">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $book->book_name }}</h6>
                                <p class="card-text">{{ $book->author }}</p>
                                <a href="" class="btn btn-primary btn-card" data-id="{{ $book->id }}"
                                    data-title="{{ $book->book_name }}" data-author="{{ $book->author }}"
                                    data-user-image="{{ $book->user->profile_image }}"
                                    data-image="{{ $book->book_image ?? '' }}" data-bs-toggle="modal"
                                    data-bs-target="#book-modal">
                                    Görüntüle
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <span class="next-arrow">&#10095;</span>
            </div>
        @else
            <p>Görüntülenen kitap yok.</p>
        @endif
    </div>

    <div class="book-container">
        <h2>Most Swapped</h2>
        @if (isset($mostSwappedBooks))
            <div class="book-slider">
                <span class="prev-arrow">&#10094;</span>

                @foreach ($mostSwappedBooks as $book)
                    <div class="book-slide">
                        <div class="card mb-2 mt-2 text-center">
                            <img src="{{ asset($book->book_image) ?? asset('assets/images/bookalemun_logo.png') }}" alt="Book Cover" class="img-fluid">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $book->book_name }}</h6>
                                <p class="card-text">{{ $book->author }}</p>
                                <a href="" class="btn btn-primary btn-card" data-id="{{ $book->id }}"
                                    data-title="{{ $book->book_name }}" data-author="{{ $book->author }}"
                                    data-image="{{ $book->book_image ?? '' }}" data-bs-toggle="modal"
                                    data-bs-target="#book-modal">
                                    Görüntüle
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <span class="next-arrow">&#10095;</span>
            </div>
        @else
            <p>Kitap Değişimi henüz yapılmadı.</p>
        @endif
    </div>

    <x-istek-modal />



    <table class="table table-bordered w-75 mx-auto">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Kullanıcı Adı</th>
                <th scope="col">Kitap İsmi</th>
                <th scope="col">Yazar</th>
                <th scope="col">Sayfa Sayısı</th>
                <th scope="col">Yorum</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($comments))
                @foreach ($comments as $comment)
                    <tr>
                        <td>{{ $comment->user->user_name ?? 'Anonim' }}</td> <!-- Kullanıcı bilgisi için -->
                        <td>{{ $comment->book->book_name }}</td>
                        <td>{{ $comment->book->author }}</td>
                        <td>{{ $comment->book->page_count }}</td>
                        <td>{{ $comment->comment }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Henüz Yorum yapılmadı.</td>
                </tr>
            @endif
        </tbody>
    </table>

    <form action="{{ route('comments.store') }}" method="POST" class="container mt-5 mb-5 w-50">
        @csrf

        <div class="mb-3">
            <label for="book-title" class="form-label">Kitap Adı:</label>
            <input type="text" class="form-control" id="book-title" name="book_title" placeholder="Kitap Adı" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Yazar:</label>
            <input type="text" class="form-control" id="author" name="author" placeholder="Yazar" required>
        </div>

        <div class="mb-3">
            <label for="page-count" class="form-label">Sayfa Sayısı:</label>
            <input type="number" class="form-control" id="page-count" name="page_count" placeholder="Sayfa Sayısı"
                required>
        </div>

        <div class="mb-3">
            <label for="comment" class="form-label">Yorum:</label>
            <textarea class="form-control" id="comment" name="comment" placeholder="Yorum" maxlength="255" rows="4" required
                style="resize: none;"></textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">Yorum Gönder</button>
        </div>
    </form>


@endsection

@section('js')
    <script>
        $(document).ready(function() {

            // S1
            let slider1 = $('.book-slider:eq(0)');
            let slides1 = slider1.find('.book-slide');
            let slideWidth1 = slides1.width();
            let slideCount1 = slides1.length;
            let currentPosition1 = 0;
            let visibleSlides1 = 3;

            $('.prev-arrow:eq(0)').on('click', function() {
                currentPosition1 -= 1;
                if (currentPosition1 < 0) {
                    currentPosition1 = slideCount1 - visibleSlides1;
                }
                updateSlider1();
            });

            $('.next-arrow:eq(0)').on('click', function() {
                currentPosition1 += 1;
                if (currentPosition1 >= slideCount1 - visibleSlides1 + 1) {
                    currentPosition1 = 0;
                }
                updateSlider1();
            });

            function updateSlider1() {
                slides1.hide();

                for (let i = 0; i < visibleSlides1; i++) {
                    let index = (currentPosition1 + i) % slideCount1;
                    slides1.eq(index).show();
                }

                slider1.animate({
                    scrollLeft: currentPosition1 * slideWidth1
                }, 600);
            }

            updateSlider1();


            // S2

            let slider2 = $('.book-slider:eq(1)');
            let slides2 = slider2.find('.book-slide');
            let slideWidth2 = slides2.width();
            let slideCount2 = slides2.length;
            let currentPosition2 = 0;
            let visibleSlides2 = 3;

            $('.prev-arrow:eq(1)').on('click', function() {
                currentPosition2 -= 1;
                if (currentPosition2 < 0) {
                    currentPosition2 = slideCount2 - visibleSlides2;
                }
                updateSlider2();
            });

            $('.next-arrow:eq(1)').on('click', function() {
                currentPosition2 += 1;
                if (currentPosition2 >= slideCount2 - visibleSlides2 + 1) {
                    currentPosition2 = 0;
                }
                updateSlider2();
            });

            function updateSlider2() {
                slides2.hide();

                for (let i = 0; i < visibleSlides2; i++) {
                    let index = (currentPosition2 + i) % slideCount2;
                    slides2.eq(index).show();
                }

                slider2.animate({
                    scrollLeft: currentPosition2 * slideWidth2
                }, 600);
            }


            updateSlider2();
        });

        $('.btn-card').click(function(e) {
            $('#book-modal').modal('show');

            e.preventDefault();

            var bookId = $(this).data('id');
            var title = $(this).data('title');
            var author = $(this).data('author');
            var image = $(this).data('image');
            var u_image = $(this).data('user-image')



            $('#book-modal #modal-book-title').text(title);
            $('#book-modal #modal-book-author').text(author);
            $('#book-modal #modal-book-image').attr('src', image);
            
            if(u_image){
                $('#modal-user-image').attr('src', u_image);
            }
            else{
                $('#modal-user-image').attr('src', asset('assets/images/bookalemun_logo.png'));
            }

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

        $('.close').on('click', function() {
            $('#book-modal').modal('hide');
        });
    </script>
@endsection
