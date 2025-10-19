<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>UniverseBlog</title>
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
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('user/img/blogging.png') }}">


    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="{{asset('user/lib/animate/animate.min.css')}}"/>
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
                        @foreach($categories as $cat)
                            <a href="{{ route('user.category_post', $cat->slug) }}" class="dropdown-item">
                                {{ $cat->name }}
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

    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item">
            <img src="{{asset('user/img/blog.jpg')}}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-12 animated fadeInUp">
                            <div class="text-center">
                                <h2 class="text-primary text-uppercase fw-bold mb-4">BlogUniverse' ye Hoşgeldin</h2>
                                <p class="mb-5 fs-5">
                                    En güncel yazılar, ipuçları ve içeriklerle bilgi dünyanı genişlet. Hemen keşfetmeye başla ve favori konularını takip et!
                                </p>
                                <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                    <a class="btn btn-light rounded-pill py-3 px-4 px-md-5 me-2" href="{{route('user.post')}}"><i class="fas fa-book me-2"></i>Hemen Okumaya Başlayın</a>
                                    <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="{{route('user.contact')}}">İletişim</a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <h2 class="text-white me-2">Takip Edin:</h2>
                                    <div class="d-flex justify-content-end ms-2">
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                                        <a class="btn btn-md-square btn-light rounded-circle ms-2" href=""><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->
</div>
<!-- Navbar & Hero End -->
<br><br>
<!-- Features Start -->
<div class="container-fluid feature pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">BlogUniverse Özellikleri</h4>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="feature-item p-4 text-center">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-book-reader fa-4x text-primary"></i>
                    </div>
                    <h4>Kolay Okuma</h4>
                    <p class="mb-4">Yazılarımız temiz ve anlaşılır bir tasarımla sunulur, kolayca okuyabilirsiniz.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="feature-item p-4 text-center">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-shield-alt fa-4x text-primary"></i>
                    </div>
                    <h4>Güvenilir İçerik</h4>
                    <p class="mb-4">Tüm içerikler doğrulanmış ve güvenilir kaynaklardan alınmıştır.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="feature-item p-4 text-center">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-lightbulb fa-4x text-primary"></i>
                    </div>
                    <h4>İlham Verici Yazılar</h4>
                    <p class="mb-4">Kendi düşüncelerinizi geliştirebileceğiniz ilham verici içerikler sunuyoruz.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="feature-item p-4 text-center">
                    <div class="feature-icon p-4 mb-4">
                        <i class="fas fa-globe fa-4x text-primary"></i>
                    </div>
                    <h4>Her Yerden Erişim</h4>
                    <p class="mb-4">BlogUniverse’i dilediğiniz cihazdan ve her yerden kolayca takip edebilirsiniz.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Features End -->

<!-- Services Start -->
<div class="container-fluid service pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">En Popüler Yazılar</h4>
            <p class="mb-0">Sizin İçin Derlenmiş Bazı Blog Yazıları</p>
        </div>

        <div class="row g-4">
            @forelse($randomPosts as $index => $post)
                <div class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp" data-wow-delay="{{ 0.2 + ($index * 0.1) }}s">
                    <div class="service-item d-flex flex-column h-100 shadow-sm rounded bg-white">
                        <div class="service-img">
                            <img src="{{ $post->image_url }}"
                                 class="img-fluid rounded-top w-100"
                                 alt="{{ $post->title }}"
                                 style="height: 180px; object-fit: cover;">
                        </div>

                        <div class="rounded-bottom p-4 flex-grow-1 d-flex flex-column">
                            <a href="{{ route('post.show', $post->slug) }}" class="h5 d-inline-block mb-2">
                                Başlık: {{ $post->title }}
                            </a>

                            <p class="text-muted mb-3 flex-grow-1">
                                İçerik: {{ \Illuminate\Support\Str::limit($post->content, 100) }}
                            </p>

                            <p class="mb-2">
                                <small class="text-primary fw-semibold">
                                    Kategori: {{ $post->categories->pluck('name')->join(', ') ?: 'Kategori Yok' }}
                                </small>
                            </p>

                            <div class="mt-auto">
                                <a class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1"
                                   href="{{ route('post.show', $post->slug) }}">
                                    Devamını Oku
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <p>Henüz popüler yazı bulunmuyor.</p>
            @endforelse
        </div>

        <!-- Tüm Blog Yazılarını Gör Butonu -->
        <div class="text-center mt-5">
            <a href="{{ route('user.post') }}" class="btn btn-primary rounded-pill py-2 px-5">
                Tüm Blog Yazılarını Gör
            </a>
        </div>
    </div>
</div>
<!-- Services End -->

<!-- Team Start -->
<div class="container-fluid team pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Yazarlarımız</h4>
            <h1 class="display-5 mb-4">Yazarlarımızı Tanıyın</h1>
        </div>
        <div class="row g-4">
            @foreach($authors as $index => $author)
                <div class="col-md-6 col-lg-6 col-xl-3 wow fadeInUp" data-wow-delay="{{ 0.2 + ($index * 0.2) }}s">
                    <div class="team-item text-center shadow-sm rounded-3 overflow-hidden">
                        <div class="team-img" style="height: 250px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                            <img src="{{ $author->profile_photo_url ?: asset('user/img/default.png') }}"
                                 class="img-fluid rounded-circle"
                                 alt="{{ $author->name }}"
                                 style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="team-title mt-3">
                            <h4 class="mb-1">{{ $author->name }} {{ $author->surname }}</h4>
                            <h5 class="mb-2">{{ $author->email }}</h5>
                            <p class="mb-2 text-muted">Yazar</p>
                        </div>
                        <div class="team-icon mb-3">
                            <a class="btn btn-primary btn-sm-square rounded-circle me-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-primary btn-sm-square rounded-circle" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
<!-- Team End -->

<!-- FAQs Start -->
<div class="container-fluid faq-section pb-5">
    <div class="container pb-5 overflow-hidden">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Sıkça Sorulan Sorular</h4>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="accordion accordion-flush bg-light rounded p-5" id="accordionFlushSection">
                    <div class="accordion-item rounded-top">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed rounded-top" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Blog'a Nasıl Kayıt Olabilirim?
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                BlogUniverse'e kayıt olmak için sağ üstten "Kayıt Ol" butonuna tıklayarak hızlıca formu doldurabilirsiniz.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Nasıl Yazı Yayınlayabilirim?
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Kayıt olmadıysanız kaydolurken yazar olmak istiyorum tuşunu işaretleyebilirsiniz. Kaydolduysanız profilim sayfasında bulunan hemen yazar ol butonuna tıklayarak kolayca yazar olabilirsiniz.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Bloga Nasıl Yazı Ekleyebilirim?
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Blog yazarları yönetici panelinden yeni yazı ekleyebilir. Yazı eklerken başlık, içerik ve kategoriyi doldurmanız yeterlidir.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Yazılarımı Kimler Görebilir?
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Tüm yayınladığınız yazılar herkese açıktır. Ancak taslak olarak kaydettiğiniz yazılar sadece sizin tarafınızdan görüntülenebilir.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                Yorumlar Nasıl Yönetiliyor?
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Yorumlar, yönetici panelinden onaylanmadan yayınlanmaz. Böylece spam ve uygunsuz içeriklerin önüne geçilmiş olur.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item rounded-bottom">
                        <h2 class="accordion-header" id="flush-headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                BlogUniverse Ücretsiz mi?
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushSection">
                            <div class="accordion-body">
                                Evet! BlogUniverse tamamen ücretsizdir. Tek ihtiyacınız olan bir hesap oluşturmak ve giriş yapmaktır.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.2s">
                <div class="bg-primary rounded">
                    <img src="{{asset('user/img/1809216.png')}}" class="img-fluid w-80" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FAQs End -->

<!-- Testimonial Start -->
<div class="container-fluid testimonial pb-5">
    <div class="container pb-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Kullanıcı Yorumları</h4>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.2s">
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                </div>
                <div class="testimonial-img">
                    <img src="{{asset('user/img/testimonial-1.jpg')}}" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">
                        BlogUniverse sayesinde gündelik ilgi alanlarım hakkında bilgi edinebiliyorum. Çok kullanışlı bir platform!
                    </p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Ahmet Yılmaz</h4>
                        <p class="mb-0">Okuyucu</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                </div>
                <div class="testimonial-img">
                    <img src="{{asset('user/img/testimonial-2.jpg')}}" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">
                        BlogUniverse’de farklı konularda yazılar okuyabiliyorum. Tasarım sade ve çok hoşuma gitti.
                    </p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Elif Demir</h4>
                        <p class="mb-0">Okuyucu</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                </div>
            </div>
            <div class="testimonial-item">
                <div class="testimonial-quote-left">
                </div>
                <div class="testimonial-img">
                    <img src="{{asset('user/img/testimonial-3.jpg')}}" class="img-fluid" alt="Image">
                </div>
                <div class="testimonial-text">
                    <p class="mb-0">
                        BlogUniverse’i takip etmeye başladığımdan beri güncel içeriklerden geri kalmıyorum. Çok memnunum!
                    </p>
                </div>
                <div class="testimonial-title">
                    <div>
                        <h4 class="mb-0">Merve Kaya</h4>
                        <p class="mb-0">Okuyucu</p>
                    </div>
                    <div class="d-flex text-primary">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="testimonial-quote-right">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

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
<a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top">
    <i class="fa fa-arrow-up"></i>
</a>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('user/lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('user/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('user/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('user/lib/lightbox/js/lightbox.min.js') }}"></script>
<script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('user/js/main.js') }}"></script>
</body>
</html>

