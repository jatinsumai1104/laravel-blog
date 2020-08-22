<?php

namespace App\Http\Controllers\WebController;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateBLogPost;
use Illuminate\Http\Request;

use App\Blog;
use App\User;
use App\Tag;

class BlogController extends Controller
{

    public function index(Request $request){
        $blogs = Blog::where(['published'=>true])->first()->orderBy("updated_at", "DESC")->paginate(5);
        $tags = Tag::all();
        $data = ['blogs' => $blogs, "tags"=>$tags];
        return view('blog.index', $data);
    }

    public function postsByUser(User $user){
        return view('blog.index', ['blogs' => $user->blogs()->orderBy("updated_at", "DESC")->paginate(5), "tags"=>Tag::all()]);
    }

    public function postsByTag(Tag $tag){
        return view('blog.index', ['blogs' => $tag->blogs()->where(['published'=>true])->orderBy("updated_at", "DESC")->paginate(5), "tags"=>Tag::all()]);
    }


    public function show(Blog $blog){
        return view('blog.show', ['blog' => $blog, "tags"=>Tag::all()]);
    }


    public function create(){
        return view('blog.create', ["tags"=>Tag::all()]);
    }

    public function store(StoreUpdateBLogPost $request){

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

    public function edit(Blog $blog){

        $this->authorize('update', $blog);

        return view('blog.edit', ['blog' => $blog, "tags"=>Tag::all()]);
    }

    public function update(StoreUpdateBLogPost $request, Blog $blog){

        $this->authorize('update', $blog);

        $validated = (object)$request->validated();

        $image = $blog->image;

        if($request->image){
            $data = file_get_contents($request->image->getRealPath());
            $image = 'data:image/jpg;base64,' . base64_encode($data);
        }

        $blog->update([
            "title" => $validated->title,
            "content" => $validated->content,
            "image" => $image,
            "short_description" => $validated->short_description
        ]);

        $blog->tags()->sync($validated->tags);

        return redirect('/blog')->with("blog", "Post Updated Successfully!!");
    }

    public function destroy(){
        //delete blog
    }

}
