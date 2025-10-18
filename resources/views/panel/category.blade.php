@extends('panel.app')

@section('content')
    <div class="container-xxl py-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Kategoriler</h5>
                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Yeni Kategori</button>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="categoryTable" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ad</th>
                        <th>Slug</th>
                        <th>Oluşturulma</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Ekle Modal -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Yeni Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kategori Adı</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Güncelle Modal -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_id">
                    <div class="modal-header">
                        <h5 class="modal-title">Kategori Güncelle</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kategori Adı</label>
                            <input type="text" name="name" id="edit_name" class="form-control" required>
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
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            let table = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.fetch') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'slug', name: 'slug' },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data) {
                            return new Date(data).toLocaleString('tr-TR');
                        }
                    },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/tr.json'
                }
            });

            // 🔹 Kategori Ekle
            $('#addForm').on('submit', function(e) {
                e.preventDefault();
                $.post("{{ route('categories.store') }}", $(this).serialize(), function(data) {
                    $('#addModal').modal('hide');
                    $('#addForm')[0].reset();
                    table.ajax.reload();
                    Swal.fire('Başarılı!', data.success, 'success');
                }).fail(function(xhr) {
                    Swal.fire('Hata!', xhr.responseJSON.message, 'error');
                });
            });

            // 🔹 Düzenleme Modalı Aç
            $(document).on('click', '.editBtn', function() {
                let id = $(this).data('id');
                $.get(`/panel/categories/edit/${id}`, function(data) {
                    $('#edit_id').val(data.category.id);
                    $('#edit_name').val(data.category.name);
                    $('#editModal').modal('show');
                });
            });

            // 🔹 Güncelle
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                $.ajax({
                    url: `/panel/categories/update/${id}`,
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(data) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        Swal.fire('Başarılı!', data.success, 'success');
                    },
                    error: function(xhr) {
                        Swal.fire('Hata!', xhr.responseJSON.message, 'error');
                    }
                });
            });

            // 🔹 Sil
            $(document).on('click', '.deleteBtn', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu kategoriyi silmek üzeresiniz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Evet, sil',
                    cancelButtonText: 'İptal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/panel/categories/delete/${id}`,
                            method: 'DELETE',
                            data: { _token: '{{ csrf_token() }}' },
                            success: function(data) {
                                table.ajax.reload();
                                Swal.fire('Silindi!', data.success, 'success');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
