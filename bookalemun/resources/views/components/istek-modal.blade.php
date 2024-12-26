<div class="modal fade" id="book-modal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('swap.request') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 style="margin-left: 38%;" class="modal-title" id="bookModalLabel">Kitap Bilgileri</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div style="width: 18em;height:auto;" class="mb-3 mx-auto">
                        <img id="modal-book-image" src="" alt="Book Cover" class="img-fluid mx-auto w-100">
                    </div>
                    <h6 id="modal-book-title"></h6>
                    <p id="modal-book-author"></p>
                    <div class="user-image">
                        <img src="" alt="User Image" class="user-img rounded-circle" id="modal-user-image">
                    </div>
                    <p class="user-name" id="modal-user-name"></p>

                    <input type="hidden" name="target_book_id" id="modal-book-id">
                    <input type="hidden" name="requester_id" value="{{ auth()->id() }}">


                    <div class="mb-3">
                        <label for="target-book" class="form-label">Takas Etmek İstediğiniz Kitap:</label>
                        <select class="form-select" name="book_id" id="target-book" required>
                            <option value="" disabled selected>Takas etmek istediğiniz kitabı seçin</option>
                            @php
                                $user = auth()->user();
                            @endphp

                            @if ($user)
                                @foreach ($user->books as $myBook)
                                    <option value="{{ $myBook->id }}">{{ $myBook->book_name }}</option>
                                @endforeach
                            @else
                                <option value="">Kullanıcı oturumu açık değil.</option>
                            @endif

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-rotate"></i> Takas
                        isteği Gönder</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kapat</button>
                </div>
            </form>
        </div>
    </div>
</div>
