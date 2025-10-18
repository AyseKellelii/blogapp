<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Stocker - Stock Market Website Template</title>
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
                <a href="{{route('user.index')}}" class="nav-item nav-link active">Ana Sayfa</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                        Bloglar
                    </a>
                    <div class="dropdown-menu m-0">
                        <a href="{{route('user.post')}}" class="dropdown-item"> Tüm Bloglar</a>
                        @foreach($categories as $category)
                            <a href="#" class="dropdown-item">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{route('user.about')}}" class="nav-item nav-link">Hakkımızda</a>
                <a href="{{route('user.contact')}}" class="nav-item nav-link">İletişim</a>
            </div>
            @auth
                <a href="{{route('user.profile')}}" class="btn btn-primary rounded-pill py-2 px-4 my-3 my-lg-0 flex-shrink-0">Profilim</a>
            @endauth

        </div>
    </nav>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Profilim</h4>
            <ol class="breadcrumb d-flex justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                <li class="breadcrumb-item"><a href="{{route('user.index')}}">Ana Sayfa</a></li>
                <li class="breadcrumb-item active text-primary">Profilim</li>
            </ol>
        </div>
    </div>
    <!-- Header End -->
</div>
<!-- Navbar & Hero End -->

<!-- Contact Start -->
<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-xl-6">
                <div class="wow fadeInUp" data-wow-delay="0.2s">

                    <div class="bg-light p-5 rounded h-100 wow fadeInUp" data-wow-delay="0.2s">
                        <h4 class="text-primary mb-4">Profil Bilgilerim</h4>
                        <div class="text-center mb-4">
                            @php
                                $user = Auth::user();
                                $profilePhoto = $user->getFirstMediaUrl('profile_photo') ?: asset('user/img/default.png');
                            @endphp

                            <img
                                src="{{ $profilePhoto }}"
                                class="img-circle"
                                style="width:175px; height:175px; object-fit:cover;"
                                alt="Profil Fotoğrafı">

                            @if($user->getFirstMediaUrl('profile_photo'))
                                <form action="{{ route('user.profile.removePhoto') }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Fotoğrafı Kaldır</button>
                                </form>
                            @endif
                        </div>




                    @if(session('success'))
                            <div class="alert alert-success mt-3">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Ad</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="surname" class="form-label">Soyad</label>
                                <input type="text" class="form-control" name="surname" id="surname" value="{{ old('surname', $user->surname) }}">
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Kullanıcı Adı</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ old('username', $user->username) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">E-posta</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control" name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="profile_photo" class="form-label">Profil Fotoğrafı</label>
                                <input type="file" class="form-control" name="profile_photo" id="profile_photo" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Yeni Şifre (İsteğe Bağlı)</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">Güncelle</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

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
