@extends('back.layout.template')

@section('title', 'Edit Progress')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Progress - {{ $progress->project->title }}</h1>
    </div>

    <div class="alert alert-danger d-none" id="alert-danger">
        <ul id="error-list" class="mb-0"></ul>
    </div>

    <form id="progressEditForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title">Judul Pekerjaan</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $progress->title }}" required>
        </div>

        <div class="mb-3">
            <label for="week">Minggu ke-</label>
            <input type="text" name="week" id="week" class="form-control" value="{{ $progress->week }}">
        </div>

        <div class="mb-3">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ $progress->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="video">Ganti Video (opsional)</label>
            <input type="file" name="video" id="video" class="form-control" accept="video/*">
            @if ($progress->video_path)
                <div class="mt-2">
                    <video width="200" controls>
                        <source src="{{ asset('storage/videos/' . $progress->video_path) }}" type="video/mp4">
                    </video>
                </div>
            @endif
        </div>

        <!-- Progress Bar -->
        <div class="progress mb-3" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                style="width: 0%">0%</div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('projects/' . $progress->project_id . '/progress') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-success" id="submitBtn">Update Progress</button>
        </div>
    </form>
</main>
@endsection

@push('js')
<script>
    const form = document.getElementById('progressEditForm');
    const progressBar = document.querySelector('.progress');
    const bar = document.querySelector('.progress-bar');
    const submitBtn = document.getElementById('submitBtn');
    const errorBox = document.getElementById('alert-danger');
    const errorList = document.getElementById('error-list');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        const url = "{{ route('progress.update', $progress->id) }}";

        progressBar.style.display = 'block';
        submitBtn.disabled = true;
        bar.style.width = '0%';
        bar.innerText = '0%';

        errorBox.classList.add('d-none');
        errorList.innerHTML = '';

        const xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhr.upload.onprogress = function (e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                bar.style.width = percent + '%';
                bar.innerText = percent + '%';
            }
        };

        xhr.onload = function () {
            if (xhr.status === 200) {
                window.location.href = "{{ url('projects/' . $progress->project_id . '/progress') }}";
            } else if (xhr.status === 422) {
                const response = JSON.parse(xhr.responseText);
                const errors = response.errors;

                for (let key in errors) {
                    if (errors.hasOwnProperty(key)) {
                        errorList.innerHTML += `<li>${errors[key][0]}</li>`;
                    }
                }

                errorBox.classList.remove('d-none');
                submitBtn.disabled = false;
                progressBar.style.display = 'none';
            } else {
                alert('Update gagal. Coba lagi.');
                submitBtn.disabled = false;
            }
        };

        xhr.send(formData);
    });
</script>
@endpush
