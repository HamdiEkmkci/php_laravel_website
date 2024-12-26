<div class="card mb-2 mt-2">
    <img src="{{ $book_image }}" alt="Book Cover" class="img-fluid">
    <div class="card-body text-center">
        <h6 class="card-title">{{ $kitapIsmi }}</h6>
        <p class="card-text">{{ $kitapYazari }}</p>
        <p class="card-text">{{ $sayfaSayisi }} sayfa</p>
        <a href="#" 
           class="btn btn-primary btn-card" 
           data-id="{{ $id }}"
           data-title="{{ $kitapIsmi }}" 
           data-author="{{ $kitapYazari }}" 
           data-image="{{ $book_image ?? 'default-image.jpg' }}" 
           data-bs-toggle="modal" 
           data-bs-target="#add-book-modal">
           Kitap Ekle
        </a>
    </div>
</div>
