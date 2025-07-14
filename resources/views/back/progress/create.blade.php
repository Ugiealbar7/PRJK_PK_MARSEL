@extends('back.layout.template')

@section('title', 'Tambah Progress Proyek')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Progress - {{ $project->title }}</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger" id="alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="progressForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title">Judul Pekerjaan</label>
                <input type="text" name="title" id="title" class="form-control"
                    placeholder="Contoh: Pemasangan Pondasi" required>
            </div>

            <div class="mb-3">
                <label for="week">Minggu ke-</label>
                <input type="text" name="week" id="week" class="form-control" placeholder="Contoh: Minggu ke-3">
            </div>

            <div class="mb-3">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label for="video">Upload Video</label>
                <input type="file" name="video" id="video" class="form-control" accept="video/*">
            </div>

            <!-- Progress Bar -->
            <div class="progress mb-3" style="height: 25px; display: none;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                    style="width: 0%">0%</div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('projects/' . $project->id . '/progress') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-success" id="submitBtn">Simpan Progress</button>
            </div>
        </form>

    </main>
@endsection

@push('js')
    <script>
        const form = document.getElementById('progressForm');
        const progressBar = document.querySelector('.progress');
        const bar = document.querySelector('.progress-bar');
        const submitBtn = document.getElementById('submitBtn');

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const url = "{{ route('progress.store', $project->id) }}";

            progressBar.style.display = 'block';
            submitBtn.disabled = true;
            bar.style.width = '0%';
            bar.innerText = '0%';

            const xhr = new XMLHttpRequest();
            xhr.open("POST", url, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percent = Math.round((e.loaded / e.total) * 100);
                    bar.style.width = percent + '%';
                    bar.innerText = percent + '%';
                }
            };

            xhr.onload = function() {
                if (xhr.status === 200 || xhr.status === 201) {
                    window.location.href = "{{ url('projects/' . $project->id . '/progress') }}";
                } else {
                    alert('Upload gagal. Coba lagi.');
                    submitBtn.disabled = false;
                }
            };

            xhr.send(formData);
        });
    </script>
@endpush


<script>
    setTimeout(() => {
        const errorAlert = document.getElementById('alert-danger');
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
    }, 5000);
</script>
