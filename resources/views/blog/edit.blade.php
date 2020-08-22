@extends('layouts.blog')

@section('content')

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="my-4">
            <small class="align-right"> Generate New Post </small>
        </h1>
        @error('short_description')
        <p class="form-text text-danger">Total {{$errors->count()}} Errors</p>
        @enderror
        <form action="/blog/{{$blog->id}}/edit" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                       placeholder="Enter Title for your blog" value="{{$blog->title}}">
                @error('title')
                <p class="form-text text-danger">{{implode(" ", $errors->get('title'))}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Short Description</label>
                <textarea class="form-control rounded" id="" rows="3" name="short_description"
                          placeholder="Max 255 characers allowed">{{$blog->short_description}}</textarea>
                @error('short_description')
                <p class="form-text text-danger">{{implode(" ", $errors->get('short_description'))}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="selectpicker form-control " id="tags" multiple data-style="btn-outline-primary"
                        name="tags[]" data-actions-box="true" data-live-search="true">
                    @foreach ($tags as $tag)
                        <option
                            value="{{$tag->id}}" {{ (collect($blog->tags->pluck('id'))->contains($tag->id) ? "selected":"") }}>{{$tag->name}}</option>
                    @endforeach
                </select>
                @error('tags')
                <p class="form-text text-danger">{{implode(" ", $errors->get('tags'))}}</p>
                @enderror


            </div>

            <div class="form-group">
                <label for="">Image</label>
                <img class="card-img-top" src="{{$blog->image}}" alt="{{ $blog->title }}" id="preview">
                <div class="input-group mb-3 mt-1 border border-dark rounded">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                @error('image')
                <p class="form-text text-danger">{{implode(" ", $errors->get('image'))}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Content</label>
                <textarea class="form-control rounded html-content" id="" name="content">{{$blog->content}}</textarea>
                @error('content')
                <p class="form-text text-danger">{{implode(" ", $errors->get('content'))}}</p>
                @enderror
            </div>

            <button type="submit" name="" id="" class="btn btn-outline-primary btn-lg btn-block">Publish</button>
        </form>
    </div>
@endsection
