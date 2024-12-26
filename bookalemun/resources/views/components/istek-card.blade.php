<div class="card mb-2 mt-2">
    <img src="{{ $source }}" alt="Book Cover" class="img-fluid">
    <div class="card-body text-center">
        <h6 class="card-title">{{ $kitapIsmi }}</h6>
        <p class="card-text">{{ $kitapYazari }}</p>
        <a href="" class="btn btn-primary btn-card" data-id="{{ $kitap->id }}"
            data-title="{{ $kitap->book_name }}" data-author="{{ $kitap->author }}"
            data-image="{{ $kitap->book_image ?? '' }}" data-bs-toggle="modal" data-bs-target="#book-modal">
            Görüntüle
        </a>
    </div>
</div>