<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Products;
use Storage;
use App\Category;

class CategoryController extends Controller
{
    //

    public function index()
    {
         return view('backend.Categories.index')->with([

            'categories' => Category::get()
        ]);
    }

    public function create()
    {
        $category=Category::all();
        return view('backend.Categories.addCategory')->with(['category'=>$category]);
    }

    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',

            'image' => 'required|image',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('categories', 'public');
        } else {

            $path = null;
        }

        $category = new Category();
        $category->name = $request->input('name');
        $category->image = $path;

        $category->save();
        if ($category->save()) {
            return redirect(route('admin.category'))->with([
                'message' => sprintf('category: "%s" add success !', $category->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf('category: "%s" can not add success !', $category->name),
                'alert-type' => 'error'
            ])->withInput();
        }


    }

public function delete($id)
{
    $Category = Category::findOrfail($id);

    $Category->delete();


    if ($Category->delete()) {
        return redirect(route('admin.category'))->with([
            'message' => sprintf('تم الحذف بنجاح'),
            'alert-type' => 'success'
        ]);
    } else {
        return redirect()->back()->with([
            'message' => sprintf('خطأ في عملية الحذف !'),
            'alert-type' => 'error'
        ])->withInput();
    }


        






}
    public function editCategory($id)
    {
        $Category = Category::findOrfail($id);
        if (!$Category) {
            return redirect()->back()->with([
                'message' => sprintf('The Category can not found!'),
                'alert-type' => 'error'
            ]);
        }

        return  view('backend.Categories.update', [
            'Category' =>  $Category,


        ]);
    }


    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrfail($id);

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
            $path = $image->storeAs('categories', basename($category->image), 'public');
            $category->image = $path;
        }

        $category->name = $request->input('name');
        $category->description = $description;
        $category->parent_id = $request->input('category_id');

        $category->save();
        if ($category->save()) {
            return redirect(route('admin.category'))->with([
                'message' => sprintf(' The Category: "%s" edit success !', $category->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Category : "%s" can not edit success !', $category->name),
                'alert-type' => 'error'
            ])->withInput();
        }
     }



}
