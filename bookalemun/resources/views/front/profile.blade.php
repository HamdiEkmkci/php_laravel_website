@extends('layouts.front')

@section('css')
    <style>
        .sidenav {
            background-color: #fff;
            color: #333;
            border-bottom-right-radius: 25px;
            border-top-right-radius: 25px;
            height: 80%;
            left: 16px;
            overflow: hidden;
            padding-top: 25px;
            position: absolute;
            top: calc(26rem);
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
            font-size: 20px;
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

        .profile {
            position: relative;
            margin-bottom: 20px;
            margin-top: -12px;
            text-align: center;
        }

        .profile img {
            width: 7em;
            height: 7em;
            border-radius: 50%;
            box-shadow: 0px 0px 5px 1px grey;
            transition: filter 0.3s ease;
        }

        .add-icon {
            display: none;
            position: absolute;
            top: 35%;
            left: 35%;
            color: white;
            border-radius: 40%;
            padding: 5px;
            transition: background-color 0.3s ease;
        }

        .profile:hover img {
            filter: brightness(70%);
            cursor: pointer;
        }

        .profile:hover .add-icon {
            display: block;
            transform: translate(40%, -60%);
            font-size: 5em;
        }

        .name {
            font-size: 1.3em;
            font-weight: bold;
            padding-top: 20px;
        }

        .main {
            margin-top: 2%;
            margin-left: 29%;
            font-size: 28px;
            padding: 0 10px;
            width: 58%;
        }

        .main h2 {
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 24px;
            margin-bottom: 10px;
            text-align: center;
        }

        .main .card {
            background-color: #fff;
            border-radius: 18px;
            box-shadow: 1px 1px 8px 0 grey;
            height: auto;
            margin-bottom: 20px;
            padding: 20px 0 20px 50px;
        }

        .main .card table {
            border: none;
            font-size: 16px;
            height: 270px;
            width: 80%;
            table-layout: auto;
        }

        .main .card table tr {
            overflow: hidden;
        }

        .edit {
            position: absolute;
            color: #e7e7e8;
            right: 14%;
        }

        .fa-pen:hover {
            color: greenyellow;
        }

        .close-modal1,
        .close-modal2 {
            position: absolute;
            right: 0;
            top: 20px;
            border: none;
            border-radius: 30%;
        }

        .close-modal1:hover,
        .close-modal2:hover {
            background-color: red;
        }

        @media screen and (max-width: 864px) {
            .profile:hover .add-icon {
                transform: translate(0, -60%);
            }
        }

        @media screen and (max-width: 500px) {
            .profile:hover .add-icon {
                transform: translate(-10%, -70%);
            }
        }
    </style>
@endsection

@section('icerik')
    <hr>

    <!-- Sidenav -->
    <div class="sidenav">

        <div class="profile">
            <img src="{{ Auth::user()->profile_image ?? asset('assets/images/bookalemun_logo.png') }}" alt="profile image"
                width="100" height="100" id="profileImage" style="cursor: pointer;">

            <form action="{{ route('user.update.image', ['id' => Auth::id()]) }}" method="POST" enctype="multipart/form-data"
                id="imageForm">
                @csrf
                @method('PUT')
                <input type="file" name="profile_image" id="profile_image" style="display: none;">
            </form>

            <div class="name">
                {{ Auth::user()->user_fname }} {{ Auth::user()->user_lname }}
            </div>
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
    <!-- Sidenav End -->

    <!-- Main -->
    <div class="main">
        <h2 class="mb-3 mt-5">Kişisel Bilgiler</h2>
        <div class="card">
            <div class="card-body">
                <a href="" data-bs-toggle="modal" data-bs-target="#editUserModal">
                    <i class="fa fa-pen fa-xs edit"></i>
                </a>
                <table>
                    <tbody>
                        <tr>
                            <td>Ad</td>
                            <td>:</td>
                            <td id="user-firstname">{{ Auth::user()->user_fname ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Soyad</td>
                            <td>:</td>
                            <td id="user-lastname">{{ Auth::user()->user_lname ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{ Auth::user()->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2 class="mb-3 mt-2">Extra Bilgiler</h2>
        <div class="card">
            <div class="card-body">
                <a href="" data-bs-toggle="modal" data-bs-target="#editExtraModal">
                    <i class="fa fa-pen fa-xs edit extra"></i>
                </a>
                <table>
                    <tbody>
                        <tr>
                            <td>Favori Yazar</td>
                            <td>:</td>
                            <td id="user-favorite-author">{{ Auth::user()->favourite_aut }}</td>
                        </tr>
                        <tr>
                            <td>Favori Kitap</td>
                            <td>:</td>
                            <td id="user-favourite-book">{{ Auth::user()->favourite_book }}</td>
                        </tr>
                        <tr>
                            <td>Sayfa Sayısı</td>
                            <td>:</td>
                            <td id="user-fb-page-count">{{ Auth::user()->fb_page_count }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Kişisel Bilgileri Düzenle</h5>
                    <button type="button" class="close-modal1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="{{ route('user.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="first-name">Ad</label>
                            <input type="text" class="form-control" id="first-name" name="user_fname" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Soyad</label>
                            <input type="text" class="form-control" id="last-name" name="user_lname" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateUserBtn">Güncelle</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Extra Modal -->
    <div class="modal fade" id="editExtraModal" tabindex="-1" role="dialog" aria-labelledby="editExtraModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editExtraModalLabel">Extra Bilgileri Düzenle</h5>
                    <button type="button" class="close-modal2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editExtraForm" action="{{ route('user.extra.update', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="favorite-author">Favori Yazar</label>
                            <input type="text" class="form-control" id="favorite-author" name="favourite_aut"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="favorite-book">Favori Kitap</label>
                            <input type="text" class="form-control" id="favorite-book" name="favourite_book"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="fb-page-count">Sayfa Sayısı</label>
                            <input type="number" class="form-control" id="fb-page-count" name="fb_page_count" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="updateExtraBtn">Güncelle</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Main End -->
@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('.edit-button').on('click', function() {
                $('#first-name').val($('#user-firstname').text());
                $('#last-name').val($('#user-lastname').text());
            });


            $('.edit-extra-button').on('click', function() {
                $('#favorite-author').val($('#user-favorite-author').text());
                $('#favorite-book').val($('#user-favorite-book').text());
                $('#fb-page-count').val($('#user-fb-page-count').text());
            });


            $('#updateUserBtn').on('click', function() {
                $('#editUserForm').submit();
            });

            $('#updateExtraBtn').on('click', function() {
                $('#editExtraForm').submit();
            });

            $('.close-modal1, .close-modal2').on('click', function() {
                $(this).closest('.modal').modal('hide');
            });

            $('#profileImage').on('click', function() {
                $('#profile_image').click();
            });

            $('#profile_image').on('change', function() {
                $('#imageForm').submit();
            });
        });
    </script>
@endsection
