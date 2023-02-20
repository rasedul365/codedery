<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
use Flasher\Prime\FlasherInterface;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        // dd($posts);

        // return view('blog.index', compact('posts'));

        return view('blog.index', [
            'posts' => Post::orderBy('id', 'desc')->paginate(20),
        ]);

        // $posts = Post::orderBy('id', 'desc')->get();
        // return view('blog.index', compact('posts'));

        // return view ('blog.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        // exit;

        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            // 'image' => ['required', 'mimes:jpg,png,jpeg', 'max:5048'],
            'image'=>'required|mimes:png,jpg,jpeg',
            'min_to_read' => 'min:0|max:60',
        ]);

        $imageName = '';
        if($image = $request->file('image')){
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/products', $imageName);
        }


        // $post = new Post();
        // $post->title = $request->title;
        // $post->excerpt = $request->excerpt;
        // $post->body = $request->body;
        // $post->image_path = 'temporary';
        // $post->is_published = $request->is_published === 'on';
        // $post->min_to_read = $request->min_to_read;
        // $post->save();

        Post::create([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            // 'image_path' => $this->storeImage($request),
            'image' => $imageName,
            'is_published' => $request->is_published === 'on',
            'min_to_read' => $request->min_to_read,
        ]);

        $flasher->addSuccess('Post has successfully created.');

        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $post = Post::find($id);
        // $post = Post::findOrFail($id);
        // return view('blog.show', compact('post'));

        return view('blog.show', [
            'post' => Post::findOrFail($id)
        ]);

        // dd($post);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('blog.edit', [
            'post' => Post::where('id', $id)->first()
        ]);

        // $post = Post::findOrFail($id);
        // return view ('blog.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, FlasherInterface $flasher)
    {

        $request->validate([
            'title' => 'required|max:255|unique:posts,title,' . $id,
            'excerpt' => 'required',
            'body' => 'required',
            'min_to_read' => 'min:0|max:60',
        ]);

        $imageName = '';
        $deleteOldImage = 'images/products/'. $post->image;

        if($image = $request->file('image')){
            if(file_exists($deleteOldImage)){
                File::delete($deleteOldImage);
            }
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move('images/products', $imageName);
        }else{
            $imageName = $post->image;
        }

        Post::where('id', $id)->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            // 'image_path' => $this->storeImage($request),
            'image' => $imageName,
            'is_published' => $request->is_published === 'on',
            'min_to_read' => $request->min_to_read,
        ]);



        // Post::where('id', $id)->update([
        //     'title' => $request->title,
        //     'excerpt' => $request->excerpt,
        //     'body' => $request->body,
        //     'image_path' => $request->image,
        //     'is_published' => $request->is_published === 'on',
        //     'min_to_read' => $request->min_to_read,
        // ]);


        // Post::where('id', $id)->update($request->except([
        //     '_token', '_method'
        // ]));

        $flasher->addSuccess('Post has successfully updated.');

        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, FlasherInterface $flasher)
    {
        $posts = Post::findOrFail($id);
        $deleteOldImage = 'images/products/'. $posts->image;

        if(file_exists($deleteOldImage)){
            file::delete($deleteOldImage);
        }

        Post::destroy($id);

        $flasher->addSuccess('Post has successfully delete.');

        return redirect(route('blog.index'));

        // return redirect(route('blog.index'))->with('message', 'Post has been deleted.');
    }

    // private function storeImage($request)
    // {
    //     $newImageName = uniqid() . '_' . $request->title . '.' . $request->image->extension();

    //     return $request->image->move(public_path('images', $newImageName));
    // }
}

