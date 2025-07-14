@extends('back.layout.template')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'List Manajemen Proyek')


@section('content')
    {{-- content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manajemen Proyek</h1>
        </div>

        <div class="mt-3">
            <a href="{{ url('projects/create') }}" class="btn btn-success mb-2">Create</a>


            @if ($errors->any())
                <div class="my-3" id="alert-danger">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="swal" data-swal="{{ session('success') }}"></div>

            <table class="table table-striped table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Publis Date</th>
                        <th>Funcition</th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>

    </main>



@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- alert success --}}

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

        function deleteProject(e) {
            let id = e.getAttribute('data-id');

            Swal.fire({
                title: 'Hapus',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) =>{
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'DELETE',
                        url: '/projects/' + id,
                        success: function(response) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                            }).then((result) => {
                                window.location.href = '/projects';
                            })
                        },
                        error: function(xhr, status, error) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                        }

                    })
                }
            })
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url()->current() }}',
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'views',
                        name: 'views'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'publish_date',
                        name: 'publish_date'
                    },
                    {
                        data: 'button',
                        name: 'button'
                    }
                ]
            });
        });
    </script>
@endpush
