@extends('front.layout.template')

@section('title', $progress->title)

@section('content')
<div class="container mt-5">
    <h1 class="fw-bold mb-4">{{ $progress->title }}</h1>
    <p class="text-muted mb-3">Minggu ke-{{ $progress->week ?? '-' }}</p>

    {{-- Video --}}
    @if($progress->video_path && file_exists(storage_path('app/public/videos/' . $progress->video_path)))
        <video class="w-100 mb-4" controls>
            <source src="{{ asset('storage/videos/' . $progress->video_path) }}" type="video/mp4">
            Browser Anda tidak mendukung video.
        </video>
    @else
        <p class="text-danger">Tidak ada video untuk progress ini.</p>
    @endif

    <p>{{ $progress->description }}</p>

    {{-- Link ke project terkait --}}
    @if($progress->project)
        <hr>
        <p>Project terkait: 
            <a href="{{ route('public.projects.show', $progress->project->slug) }}">
                {{ $progress->project->title }}
            </a>
        </p>
    @endif
</div>
@endsection
