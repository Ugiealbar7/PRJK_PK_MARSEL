@extends('front.layouts.app')

@section('title', $project->title)

@section('content')
    <h2 class="mb-4">{{ $project->title }}</h2>
    <img src="{{ asset('storage/back/' . $project->img) }}" class="img-fluid mb-3" alt="{{ $project->title }}">

    <p><strong>Kategori:</strong> {{ $project->category->name }}</p>
    <p><strong>Deskripsi:</strong> {{ $project->desc }}</p>
    <p><strong>Tanggal Publikasi:</strong> {{ $project->publish_date }}</p>

    <hr>
    <h4>Progress Mingguan</h4>
    @if ($project->progresses->count())
        <div class="accordion" id="progressAccordion">
            @foreach ($project->progresses as $progress)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $loop->index }}">
                        <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $loop->index }}">
                            {{ $progress->week }} - {{ $progress->title }}
                        </button>
                    </h2>
                    <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#progressAccordion">
                        <div class="accordion-body">
                            <p>{{ $progress->description }}</p>
                            @if ($progress->video_path)
                                <video width="100%" controls>
                                    <source src="{{ asset('storage/videos/' . $progress->video_path) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Belum ada progress mingguan yang ditambahkan.</p>
    @endif
@endsection
