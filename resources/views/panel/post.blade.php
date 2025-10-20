@extends('panel.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

@section('content')
    <div class="container py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Yazılar</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Yeni Yazı</button>
            </div>
            <div class="card-body">
                <table id="postTable" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Görsel</th>
                        <th>Başlık</th>
                        <th>Kategoriler</th>
                        <th>Durum</th>
                        <th>Oluşturulma</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!--  EKLE MODAL -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Yeni Yazı</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Başlık</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>İçerik</label>
                            <textarea name="body" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Kategoriler</label>
                            <select name="categories[]" class="form-select" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Görsel</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_published" class="form-check-input" id="add_is_published" value="1">
                            <label class="form-check-label" for="add_is_published">Yayınla</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  GÜNCELLE MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Yazı Güncelle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Başlık</label>
                            <input type="text" name="title" id="edit_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>İçerik</label>
                            <textarea name="body" id="edit_body" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Kategoriler</label>
                            <select name="categories[]" id="edit_categories" class="form-select" multiple required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Yeni Görsel (isteğe bağlı)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="is_published" class="form-check-input" id="edit_is_published" value="1">
                            <label class="form-check-label" for="edit_is_published">Yayınla</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Güncelle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {
            const table = $('#postTable').DataTable({
                ajax: '{{ route("panel.posts.fetch") }}',
                columns: [
                    {data: 'id'},
                    {
                        data: 'image',
                        render: data => data ? `<img src="${data}" width="60" height="60" class="rounded">` : ''
                    },
                    {data: 'title'},
                    {data: 'categories'},
                    {
                        data: 'is_published',
                        render: data => data == 1
                            ? '<span class="badge bg-success">Yayında</span>'
                            : '<span class="badge bg-secondary">Taslak</span>'
                    },
                    {data: 'created_at', render: d => new Date(d).toLocaleString('tr-TR')},
                    {data: 'actions'}
                ]
            });

            // EKLE
            $('#addForm').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: '{{ route("panel.posts.store") }}',
                    method: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: res => {
                        $('#addModal').modal('hide');
                        this.reset();
                        table.ajax.reload();
                        Swal.fire('Başarılı', res.success, 'success');
                    },
                    error: xhr => {
                        let msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                        Swal.fire('Hata', msg, 'error');
                    }
                });
            });

            // DÜZENLE
            $(document).on('click', '.editBtn', function() {
                const id = $(this).data('id');
                $.get(`{{ url('panel/posts') }}/${id}/edit`, res => {
                    $('#edit_id').val(res.post.id);
                    $('#edit_title').val(res.post.title);
                    $('#edit_body').val(res.post.content);
                    $('#edit_categories').val(res.post.categories.map(c => c.id)).trigger('change');
                    $('#edit_is_published').prop('checked', res.post.is_published == 1);
                    $('#editModal').modal('show');
                });
            });

            // GÜNCELLE
            $('#editForm').submit(function(e){
                e.preventDefault();
                const id = $('#edit_id').val();
                const formData = new FormData(this);
                formData.append('_method', 'PUT');
                $.ajax({
                    url: `{{ url('panel/posts') }}/${id}`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: res => {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Başarılı', res.success, 'success');
                    },
                    error: xhr => {
                        let msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                        Swal.fire('Hata', msg, 'error');
                    }
                });
            });

            // SİL
            $(document).on('click', '.deleteBtn', function(){
                const id = $(this).data('id');
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: 'Bu yazı silinecek!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet',
                    cancelButtonText: 'İptal'
                }).then(result => {
                    if(result.isConfirmed){
                        $.ajax({
                            url: `{{ url('panel/posts') }}/${id}`,
                            method: 'DELETE',
                            data: {_token: '{{ csrf_token() }}'},
                            success: res => {
                                table.ajax.reload();
                                Swal.fire('Silindi', res.success, 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
