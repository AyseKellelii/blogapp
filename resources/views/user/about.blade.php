<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Hakkımızda - BlogUniverse</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('user/img/blogging.png') }}">



    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
</head>

<body>

<!-- Spinner Start -->
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-flex flex-wrap">
                <a href="#" class="text-muted small me-4"><i class="fas fa-map-marker-alt text-primary me-2"></i>Mersin, Türkiye</a>
                <a href="tel:+01234567890" class="text-muted small me-4"><i class="fas fa-phone-alt text-primary me-2"></i>+90 543 585 33 33</a>
                <a href="mailto:example@gmail.com" class="text-muted small me-0"><i class="fas fa-envelope text-primary me-2"></i>blog@gmail.com</a>
            </div>
        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">
                @guest
                    <a href="{{ route('auth.register') }}"><small class="me-3 text-dark"><i class="fa fa-user text-primary me-2"></i>Kayıt Ol</small></a>
                    <a href="{{ route('login') }}"><small class="me-3 text-dark"><i class="fa fa-sign-in-alt text-primary me-2"></i>Giriş Yap</small></a>
                @endguest

                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark p-0 m-0"><i class="fa fa-sign-out-alt text-primary me-2"></i>Çıkış Yap</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar & Hero Start -->
<div class="container-fluid position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="" class="navbar-brand p-0">
            <h1 class="text-primary"><i class="fas fa-pen me-3"></i>BlogUniverse</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->routeIs('user.index') ? 'active' : '' }}">
                    Ana Sayfa
                </a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Bloglar
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{ route('user.post') }}" class="dropdown-item {{ request()->routeIs('user.post') ? 'active' : '' }}">
                            Tüm Bloglar
                        </a>

                        @foreach($categories as $cat)
                            <a href="{{ route('user.category_post', $cat->slug) }}"
                               class="dropdown-item {{ request()->is('category/'.$cat->slug) ? 'active' : '' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach

                    </div>
                </div>

                <a href="{{ route('user.about') }}" class="nav-item nav-link {{ request()->routeIs('user.about') ? 'active' : '' }}">
                    Hakkımızda
                </a>
                <a href="{{ route('user.contact') }}" class="nav-item nav-link {{ request()->routeIs('user.contact') ? 'active' : '' }}">
                    İletişim
                </a>
            </div>
            @auth
                <a href="{{route('user.profile')}}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Profilim</a>
            @endauth

        </div>
    </nav>

</div>
<!-- Navbar & Hero End -->
<!-- Header Start -->
<div class="container-fluid bg-breadcrumb">
    <div class="container text-center py-5" style="max-width: 900px;">
        <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Hakkımızda</h4>
        <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
            <li class="breadcrumb-item"><a href="{{route('user.index')}}">Ana Sayfa</a></li>
            <li class="breadcrumb-item active text-primary">Hakkımızda</li>
        </ol>
    </div>
</div>
<!-- Header End -->

<!-- About Start -->
<div class="container-fluid about py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                <div>
                    <h4 class="text-primary">Hakkımızda</h4>
                    <h1 class="display-5 mb-4">BlogUniverse ile bilgiye bir adım daha yakınsınız</h1>
                    <p class="mb-4">
                        BlogUniverse, farklı ilgi alanlarına hitap eden yazılar sunan dinamik bir içerik platformudur.
                        Amacımız, kullanıcılarımızın güncel bilgilere kolayca ulaşmasını ve kendi fikirlerini paylaşabilmesini sağlamaktır.
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="fas fa-pen-nib fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Kaliteli İçerikler</h4>
                                    <p>Alanında uzman yazarlarımızdan düzenli olarak güncel yazılar.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="d-flex">
                                <div><i class="bi bi-people-fill fa-3x text-primary"></i></div>
                                <div class="ms-4">
                                    <h4>Güçlü Okuyucu Topluluğu</h4>
                                    <p>Binlerce aktif okuyucu ve yorumcu ile etkileşim kurun.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('user.post') }}" class="btn btn-primary rounded-pill py-3 px-5 flex-shrink-0">Okumaya Başlayın</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="d-flex">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4>Bize Ulaşın</h4>
                                    <p class="mb-0 fs-5" style="letter-spacing: 1px;">info@bloguniverse.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-primary rounded position-relative overflow-hidden">
                    <img src="{{ asset('user/img/blog3.webp') }}" class="img-fluid rounded w-100" alt="BlogUniverse">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Özellikler Start -->
<div class="container-fluid feature pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Özelliklerimiz</h4>
            <h1 class="display-5 mb-4">BlogUniverse ile bilgiye, deneyime ve topluluğa bir arada ulaşın</h1>
            <p class="mb-0">
                BlogUniverse; kullanıcılarına güvenilir, erişilebilir ve etkileşimli bir içerik platformu sunar.
                Okuyucular ve yazarlar arasında köprü kurarak ilgi alanlarınıza hitap eden içerikleri bir araya getirir.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-pen-nib fa-4x text-primary"></i>
                    </div>
                    <h4>Kaliteli Yazılar</h4>
                    <p class="mb-4">
                        Alanında uzman yazarlar tarafından hazırlanan özgün ve güncel içeriklerle bilgiye hızlıca ulaşın.
                    </p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('user.post') }}">Keşfet</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-users fa-4x text-primary"></i>
                    </div>
                    <h4>Etkileşimli Topluluk</h4>
                    <p class="mb-4">
                        Yorum yapın, fikirlerinizi paylaşın ve sizin gibi düşünen insanlarla bağlantı kurun.
                    </p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{ route('user.about') }}">Daha Fazla</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-bolt fa-4x text-primary"></i>
                    </div>
                    <h4>Hızlı ve Kolay Kullanım</h4>
                    <p class="mb-4">
                        Modern tasarımı sayesinde aradığınız içeriğe saniyeler içinde ulaşın.
                    </p>
                    <a class="btn btn-primary rounded-pill py-2 px-4" href="{{route('user.contact')}}">İletişim</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="feature-item p-4">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-shield-alt fa-4x text-primary"></i>
                    </div>
                    <h4>Güvenli Platform</h4>
                    <p class="mb-4">
                        Verileriniz güvende! BlogUniverse kullanıcı gizliliğini her zaman ön planda tutar.
                    </p>
                    <button class="btn btn-primary rounded-pill py-2 px-4" href="#">Güvenlik</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Özellikler End -->


<!-- Team Start -->
<div class="container-fluid team pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Ekibimiz</h4>
            <h1 class="display-5 mb-4">Çalışanlarımızla Tanışın</h1>
            <p class="mb-0">Ekibimiz; yenilikçi fikirleri, güçlü iletişimi ve ortak hedefleriyle markamızı bir adım öteye taşımak için çalışıyor.
                Her biri alanında uzman olan çalışanlarımızla, sizlere en iyi hizmeti sunmayı hedefliyoruz.
            </p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('user/img/team-1.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Emre Yılmaz</h4>
                        <p class="mb-0">Baş Editör</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('user/img/team-2.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Can Demir</h4>
                        <p class="mb-0">Yazı İşleri Müdürü</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('user/img/team-3.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Burak Kaya</h4>
                        <p class="mb-0">Teknik Editör</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="team-item">
                    <div class="team-img">
                        <img src="{{asset('user/img/team-4.jpg')}}" class="img-fluid" alt="">
                    </div>
                    <div class="team-title">
                        <h4 class="mb-0">Zeynep Arslan</h4>
                        <p class="mb-0">İçerik Editörü</p>
                    </div>
                    <div class="team-icon">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href=""><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-0" href=""><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Team End -->

<!-- Footer Start -->
<div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
    <div class="container py-5 border-start-0 border-end-0"
         style="border: 1px solid rgba(255, 255, 255, 0.08);">
        <div class="row g-5">

            <!-- Blog Info -->
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="footer-item">
                    <a href="{{ route('user.index') }}" class="p-0 text-decoration-none">
                        <h4 class="text-white mb-3">
                            <i class="fas fa-pen me-2 text-primary"></i> BlogUniverse
                        </h4>
                    </a>
                    <p class="text-white-50 mb-4">
                        BlogUniverse, herkesin özgürce yazı yazabildiği ve fikirlerini paylaşabildiği bir platformdur.
                    </p>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-md-6 col-lg-6 col-xl-2">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Hızlı Erişim</h4>
                    <a href="{{route('user.about')}}" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Hakkımızda
                    </a>
                    <a href="{{route('user.profile')}}" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Profilim
                    </a>
                    <a href="{{route('user.post')}}" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Blog
                    </a>
                    <a href="{{route('user.contact')}}" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> İletişim
                    </a>
                </div>
            </div>

            <!-- Support -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">Destek</h4>
                    <a href="#" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Gizlilik Politikası
                    </a>
                    <a href="#" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Kullanım Şartları
                    </a>
                    <a href="#" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> SSS
                    </a>
                    <a href="#" class="d-block text-white-50 mb-2">
                        <i class="fas fa-angle-right me-2 text-primary"></i> Destek Merkezi
                    </a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="footer-item">
                    <h4 class="text-white mb-4">İletişim Bilgileri</h4>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-map-marker-alt text-primary me-3"></i>
                        <p class="text-white mb-0">Mersin, Türkiye</p>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="fas fa-envelope text-primary me-3"></i>
                        <p class="text-white mb-0">blog@gmail.com</p>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fa fa-phone-alt text-primary me-3"></i>
                        <p class="text-white mb-0">+90 543 385 33 33</p>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-twitter text-white"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle me-3" href="#"><i class="fab fa-instagram text-white"></i></a>
                        <a class="btn btn-primary btn-sm-square rounded-circle" href="#"><i class="fab fa-linkedin-in text-white"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('user/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('user/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('user/lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('user/lib/lightbox/js/lightbox.min.js')}}"></script>
<script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>


<!-- Template Javascript -->
<script src="{{asset('user/js/main.js')}}"></script>
</body>

</html>
