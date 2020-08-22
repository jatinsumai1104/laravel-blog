@extends('layouts.blog')

@section('content')
    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">
            <small class="align-right">Showing {{ $blogs->total()}} blogs </small>
        </h1>

    @foreach ($blogs as $blog)
        <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top" src="{{$blog->image}}" alt="{{ $blog->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $blog->title }}</h2>
                    <p class="card-text">{!!$blog->short_description !!}</p>
                    <a href="/blog/{{ $blog->id }}" class="btn btn-outline-primary">Read More &rarr;</a>
                    @foreach ($blog->tags as $tag)
                        <a href="/blog/tag/{{ $tag->name }}"
                           class="btn btn-outline-dark float-right mr-2">{{$tag->name}}</a>
                    @endforeach

                </div>
                <div class="card-footer text-muted d-flex">
                    Posted on {{ $blog->created_at->format('F j, Y') }} at {{ $blog->created_at->format('g:i A') }} by
                    <a href="/blog/user/{{ $blog->user->id }}">{{ $blog->user->name }}</a>
                    @can('update', $blog)
                        <a href="/blog/{{$blog->id}}/edit" class="btn btn-outline-dark ml-auto">Edit This Post</a>
                    @endcan
                </div>
            </div>
    @endforeach


    <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            @if($blogs->onFirstPage())
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}">&larr; Previous</a>
                </li>
            @else
                <li class="page-item ">
                    <a class="page-link" href="{{ $blogs->previousPageUrl() }}">&larr; Previous</a>
                </li>
            @endif
            @if($blogs->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next &rarr;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $blogs->nextPageUrl() }}">Next &rarr;</a>
                </li>
            @endif
        </ul>

    </div>
@endsection
