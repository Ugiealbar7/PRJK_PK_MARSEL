@extends('back.layout.template')



@section('title', 'List Manajemen Proyek')


@section('content')
    {{-- content --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <div class="mt-3">

            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Detail Proyek</h1>
                <div>
                    <a href="{{ url('projects') }}" class="btn btn-secondary me-2">← Back</a>
                    <a href="{{ route('progress.index', $project->id) }}" class="btn btn-outline-primary">📋 Lihat Progress</a>
                </div>
            </div>



            <table class="table table-striped table-bordered" id="dataTable">
                <tr>
                    <th width="250px">Title</th>
                    <td>{{ $project->title }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $project->Category->name }}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{ $project->desc }}</td>
                </tr>
                <tr>
                    <th>Image</th>
                    <td>
                        <a href="{{ asset('storage/back/' . $project->img) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('storage/back/' . $project->img) }}" alt="" width="50%">
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Views</th>
                    <td>{{ $project->views }}</td>
                </tr>
                <tr>
                    <th>Status</th>

                    @if ($project->status == 1)
                        <td>: <span class="badge bg-danger">Private</span></td>
                    @else
                        <td>: <span class="badge bg-success">Published</span></td>
                    @endif
                </tr>
                <tr>
                    <th>Publish Date</th>
                    <td>{{ $project->publish_date }}</td>
                </tr>
            </table>



        </div>


        <!-- JS Toggle -->
        <script>
            document.getElementById('toggleProgressForm').addEventListener('click', function() {
                const form = document.getElementById('progressForm');
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            });
        </script>


    </main>



@endsection

<script>
    // Tutup alert success dalam 3 detik
    setTimeout(() => {
        const successAlert = document.getElementById('alert-success');
        if (successAlert) {
            successAlert.style.display = 'none';
        }
    }, 3000); // 3000 ms = 3 detik

    // Tutup alert error dalam 5 detik
    setTimeout(() => {
        const errorAlert = document.getElementById('alert-danger');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 5000); // 5000 ms = 5 detik
</script>
