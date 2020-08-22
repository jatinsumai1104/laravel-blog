<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBLogPost;
use Illuminate\Http\Request;
use App\Blog;
use App\Tag;
use App\User;

use App\Http\Resources\Blog as BlogResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::where(['published'=>true])->first()->orderBy("updated_at", "DESC")->with('tags', 'user')->paginate(5);

        return new BlogResource($blogs);
    }

    /**
     * Display a listing of the posts of user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postsByUser(User $user)
    {
        $blogs = $user->blogs()->orderBy("updated_at", "DESC")->with('tags', 'user')->paginate(5);

        return new BlogResource($blogs);
    }

    /**
     * Display a listing of the posts of tag.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postsByTag(Tag $tag){
        $blogs = $tag->blogs()->where(['published'=>true])->orderBy("updated_at", "DESC")->with('tags', 'user')->paginate(5);

        return new BlogResource($blogs);
    }

    /**
     * Display the specified Post.
     *
     * @param  Blog $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        $blog->tags = $blog->tags;
        $blog->user = $blog->user;
        return $blog;
        return "Hello";
        return $blog->toArray();
//        return new BlogResource($blog->with('tags', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateBLogPost $request)
    {
        //Data is Validated
        $validated = (object)$request->validated();

        $image = null;

        if($validated->image){
            $data = file_get_contents($validated->image->getRealPath());
            $image = 'data:image/jpg;base64,' . base64_encode($data);
        }

        $blog = Blog::create([
            "title" => $validated->title,
            "content" => $validated->content,
            "image" => $image,
            "user_id" => \Auth::user()->id,
            "short_description" => $validated->short_description
        ]);

        $blog->tags()->attach($request->tags);
        return redirect('/blog')->with("blog", "Post Created Successfully!!");
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
