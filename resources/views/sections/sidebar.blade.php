<div class="col-md-4">

    <!-- Search Widget -->
    <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                                        <button class="btn btn-secondary" type="button">Go!</button>
                                    </span>
            </div>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled mb-0">
                        <li class="text-center">
                            <a href="/blog">ALL</a>
                        </li>
                        @foreach ($tags as $tag)
                            <li class="text-center">
                                <a href="/blog/tag/{{ $tag->name }}">{{strtoupper($tag->name)}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
