@extends('back.layout.template')

@section('title', 'Detail Progress')

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Progress - {{ $progress->project->title }}</h1>
        <a href="{{ url('projects/' . $progress->project_id . '/progress') }}" class="btn btn-secondary">← Kembali</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h4>{{ $progress->title }}</h4>
            <p><strong>Minggu:</strong> {{ $progress->week }}</p>
            <p><strong>Deskripsi:</strong></p>
            <p>{{ $progress->description }}</p>
            <p><strong>Tanggal dibuat:</strong> {{ $progress->created_at->format('d M Y') }}</p>

            @if ($progress->video_path)
                <div class="mt-3">
                    <video width="400" controls>
                        <source src="{{ asset('storage/videos/' . $progress->video_path) }}" type="video/mp4">
                        Browser Anda tidak mendukung video.
                    </video>
                </div>
            @endif
        </div>
    </div>
</main>
@endsection
