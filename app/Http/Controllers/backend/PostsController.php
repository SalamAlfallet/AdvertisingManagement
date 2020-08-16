<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Posts;
class PostsController extends Controller
{
    //
    //
    public function index(){

        return view ('backend.Posts.index')->with([
            'posts' => Posts::get()
            ]);


    }

    public function create(){

        return view ('backend.Posts.addPosts');


    }

    public function store(Request $request){

        $request->validate([

            'name' => 'required',
            'description' =>'required ',
            'short_description'=>'required ',
            'image' => 'required|image',

        ]);
        $description = $request->input('description');

        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        
        foreach($images as $k=> $img){
        $data = $img->getAttribute('src');
        if(preg_match('/data:image/', $data)){
            // get the mimetype
            preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
            $mimetype = $groups['mime'];
 
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name= "images/" .time().$k.".".$mimetype;
                 $path = storage_path($image_name);
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                  $new_src= Storage::url($image_name);
                  $filepath= asset($new_src);
                $img->setAttribute('src',$filepath);
        }
    }
        $description = $dom->saveHTML();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('posts', 'public');
        } else {

            $path = null;
        }

        $posts = new Posts();
        $posts->name = $request->input('name');
        $posts->description = $description;
        $posts->short_description=$request->input('short_description');
         $posts ->image = $path;
        $posts ->save();

        if ($posts->save()) {
            return redirect(route('admin.posts'))->with([
                'message' => sprintf(' The Post: "%s" add success !', $posts->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Post: "%s" can not add success !', $posts->name),
                'alert-type' => 'error'
            ])->withInput();
        }

    }

    public function delete($id)
    {
         $posts = Posts::findOrfail($id);

        if (!$posts) {
            return redirect()->back()->with([
                'message' => sprintf('The Post can not found!'),
                'alert-type' => 'error'
            ]);
        }

        $posts->delete();
        return response()->json(['message' => sprintf(' The Post: "%s" deleted success !', $posts->name)]);
    }



    public function editPost($id)
    {
        $posts = Posts::findOrfail($id);

        if (!$posts) {
            return redirect()->back()->with([
                'message' => sprintf('The Post can not found!'),
                'alert-type' => 'error'
            ]);
        }
        return  view('backend.Posts.update', [
            'posts' =>  $posts,


        ]);
    }

    public function updatePost(Request $request, $id)
    {
        
        $posts = Posts::findOrfail($id);
        $description = $request->input('description');
        libxml_use_internal_errors(true);

        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');
        
        foreach($images as $k=> $img){
        $data = $img->getAttribute('src');
        if(preg_match('/data:image/', $data)){
            // get the mimetype
            preg_match('/data:image\/(?<mime>.*?)\;/', $data, $groups);
            $mimetype = $groups['mime'];
 
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name= "images/" .time().$k.".".$mimetype;
                 $path = storage_path($image_name);
                file_put_contents($path, $data);
                $img->removeAttribute('src');
                  $new_src= Storage::url($image_name);
                  $filepath= asset($new_src);
                $img->setAttribute('src',$filepath);
        }
    }
        $description = $dom->saveHTML();

        $image = $request->file('image');

        if ($image && $image->isValid()) {
            $path = $image->storeAs('posts', basename($posts->image), 'public');
            $posts->image = $path;
        }

        $posts->name = $request->input('name');
        $posts->description = $description;
        $posts->short_description=$request->input('short_description');

        $posts->save();

        if ($posts->save()) {
            return redirect(route('admin.posts'))->with([
                'message' => sprintf(' The Post: "%s" edit success !', $posts->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Post: "%s" can not edit success !', $posts->name),
                'alert-type' => 'error'
            ])->withInput();
        }
     }


}
