@extends('panel.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y"> {{-- container-xxl -> container-fluid --}}
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">Profil</span> Bilgilerimi Güncelle
            </h4>

            <div class="row">
                <div class="col-xl-12"> {{-- col-xl-8 -> col-xl-12 yapıldı --}}
                    <div class="card mb-4 w-100"> {{-- kart tam genişlikte --}}
                        <div class="card-header">
                            <h5 class="mb-0">Kişisel Bilgiler</h5>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <div class="card-body">
                            <form id="profileForm" enctype="multipart/form-data" method="POST" action="{{ route('panel.profile.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="text-center mb-4">
                                    <img id="profilePhoto"
                                         src="{{ auth()->user()->profile_photo_url ?? asset('user/img/default.png') }}"
                                         alt="Profil Fotoğrafı"
                                         class="rounded-circle mb-3"
                                         width="120" height="120"
                                         style="object-fit: cover;">

                                    <div>
                                        {{-- Sadece profil fotoğrafı varsa butonu göster --}}
                                        @if(auth()->user()->hasMedia('profile_photo'))
                                            <button type="button" id="deletePhotoBtn" class="btn btn-outline-danger btn-sm">
                                                <i class="bx bx-trash"></i> Fotoğrafı Kaldır
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Ad</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Soyad</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user-circle"></i></span>
                                        <input type="text" name="surname" class="form-control" value="{{ old('surname', auth()->user()->surname) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kullanıcı Adı</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-id-card"></i></span>
                                        <input type="text" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">E-Posta</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Hakkımda (Bio)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-comment-detail"></i></span>
                                        <textarea name="bio" class="form-control" rows="4" placeholder="Kendiniz hakkında kısa bir bilgi yazın...">{{ old('bio', auth()->user()->bio) }}</textarea>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Profil Fotoğrafı</label>
                                    <div class="input-group input-group-merge">
                                        <input type="file" name="profile_photo" class="form-control mt-2" accept="image/*">
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Kaydet</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const deleteBtn = document.getElementById('deletePhotoBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: 'Profil fotoğrafınız kalıcı olarak silinecek.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, sil!',
                    cancelButtonText: 'Vazgeç'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('{{ route('panel.profile.photo.delete') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    document.getElementById('profilePhoto').src = data.default_url;
                                    deleteBtn.style.display = 'none';
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Silindi!',
                                        text: 'Profil fotoğrafınız başarıyla kaldırıldı.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Hata!',
                                        text: 'Bir hata oluştu, lütfen tekrar deneyin.'
                                    });
                                }
                            })
                            .catch(() => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Hata!',
                                    text: 'Sunucuya bağlanırken bir sorun oluştu.'
                                });
                            });
                    }
                });
            });
        }
    </script>
@endsection
