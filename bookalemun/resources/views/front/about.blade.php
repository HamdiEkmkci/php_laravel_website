@extends('layouts.front')

@section('css')
@endsection

@section('icerik')
    <hr>

    <div class="about-main mb-2">
        <div class="align-items-center d-inline-flex mb-5">
            <div class="h-auto w-50 p-3 lh-lg">
                <p class="font-family-base">
                <h5>Hoş geldiniz!</h5>
                <br>
                    Bizler kitap tutkunları olarak, kitap okumanın büyüsünü ve faydalarını daha geniş
                kitlelere yaymak amacıyla bu platformu kurduk. Kitap takası yapabileceğiniz bu platform sayesinde,
                elinizdeki kitapları başkalarıyla paylaşabilir, yeni kitaplara kolayca ulaşabilirsiniz. Amacımız, kitap
                okuma alışkanlığını artırmak ve herkesin kitaplara daha erişilebilir bir şekilde ulaşmasını sağlamak.
                Okuma kültürünü yaygınlaştırarak, bilgi ve hikayelerle dolu bir topluluk oluşturmak istiyoruz.
                </p>
            </div>

            <div class="h-auto w-50 p-3">
                <img style="max-width: 100%;max-height:auto;" class="rounded" src="{{ asset('assets/images/library.jpg') }}"
                    alt="library">
            </div>
        </div>

        <div class="align-items-center d-inline-flex mb-5">
            <div class="w-50  p-3">
                <img style="max-width: 100%;max-height:auto;" class="rounded" src="{{ asset('assets/images/about_2.jpeg') }}"
                    alt="library">
            </div>
            <div class="h-auto w-50 p-3 lh-lg">
                <p>
                    Kullanıcılarımızın geri bildirimleri ile sürekli olarak geliştirilen sitemiz, kitap severlerin buluşma
                    noktası olmayı hedefliyor. Kitap takası yaparak hem yeni kitaplara erişebilir, hem de elinizdeki
                    kitapları değerlendirebilirsiniz. Bu topluluğa katılarak, siz de okuma sevgisini paylaşabilir ve
                    başkalarının okuma alışkanlıklarına katkıda bulunabilirsiniz.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
