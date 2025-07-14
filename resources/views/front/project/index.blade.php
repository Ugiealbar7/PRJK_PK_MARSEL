@extends('front.layouts.app')

@section('title', 'Semua Proyek')

@section('content')
    <h2 class="mb-4">Semua Proyek</h2>
    <div class="row">
        @forelse ($projects as $project)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/back/' . $project->img) }}" class="card-img-top" alt="{{ $project->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ Str::limit($project->desc, 100) }}</p>
                        <a href="{{ route('public.projects.show', $project->slug) }}">
                            {{ $project->title }}
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>Tidak ada proyek tersedia saat ini.</p>
                </div>
        @endforelse
    </div>
@endsection
