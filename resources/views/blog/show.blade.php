@extends('layouts.blog')

@section('content')

    <!-- Post Content Column -->
    <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4">{{ $blog->title}}</h1>

        <!-- Author -->
        <p class="lead d-flex flex-wrap">
            By
            <a class="mr-auto pl-1" href="/blog/?user={{ $blog->user->id }}"> {{ $blog->user->name }}</a>
            @foreach ($blog->tags as $tag)
                <a href="/blog/tag/{{ $tag->name }}" class="btn btn-outline-dark ml-2">{{$tag->name}}</a>
            @endforeach
        </p>

        <hr>

        <!-- Date/Time -->
        {{-- <p>Posted on January 1, 2018 at 12:00 PM</p> --}}
        <p class="d-flex justify-content-between">
            Posted on {{ $blog->created_at->format('F j, Y') }} at {{ $blog->created_at->format('g:i A') }}
            @can('update', $blog)
                <a href="/blog/{{$blog->id}}/edit" class="btn btn-outline-dark ml-auto">Edit This Post</a>
            @endcan
        </p>

        <hr>

        <p><b>Short Description: </b>{{ $blog->short_description }}</p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="{{$blog->image}}" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">{!!$blog->content !!}</p>

        <hr>

    </div>
@endsection
