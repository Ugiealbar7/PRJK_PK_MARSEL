@extends('back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'Progress Proyek')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Progress Proyek: {{ $project->title }}</h1>
            <div>
                <a href="{{ route('projects.show', $project->id) }}" class="btn btn-secondary me-2">← Back to Project</a>
                <a href="{{ route('progress.create', $project->id) }}" class="btn btn-success">+ Add Progress</a>
            </div>
        </div>

        <div class="swal" data-swal="{{ session('success') }}"></div>

        <table class="table mt-4 table-bordered" id="progressTable">
            <thead class="table-light">
                <tr>
                    <th>Judul</th>
                    <th>Minggu</th>
                    <th>Deskripsi</th>
                    <th>Video</th>
                    <th>Dibuat</th>
                    <th style="width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($project->progresses as $progress)
                    <tr>
                        <td>{{ $progress->title }}</td>
                        <td>{{ $progress->week }}</td>
                        <td>{{ $progress->description }}</td>
                        <td>
                            @if ($progress->video_path)
                                <video width="200" controls>
                                    <source src="{{ asset('storage/videos/' . $progress->video_path) }}" type="video/mp4">
                                </video>
                            @else
                                <em>Tidak ada video</em>
                            @endif
                        </td>
                        <td>{{ $progress->created_at->format('d M Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('progress.show', $progress->id) }}" class="btn btn-secondary">Detail</a>
                            <a href="{{ route('progress.edit', $progress->id) }}" class="btn btn-primary">Edit</a>
                            <button onclick="deleteProgress({{ $progress->id }})" class="btn btn-danger">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    <script>
        const swalMessage = $('.swal').data('swal');

        if (swalMessage) {
            Swal.fire({
                title: 'Success!',
                text: swalMessage,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
            });
        }

        function deleteProgress(id) {
            Swal.fire({
                title: 'Hapus',
                text: 'Yakin ingin menghapus progress ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/progress/' + id,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus.', 'error');
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#progressTable').DataTable();
        });
    </script>
@endpush
