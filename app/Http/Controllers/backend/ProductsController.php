<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\Brands;
use App\Categories;
use Storage;

class ProductsController extends Controller
{
    //
    public function index(){

        return view ('backend.Products.index')->with([
            'products' => Products::get()
            ]);


    }
    public function getSupCat(){

        $categories=DB::select('select distinct id, name, parent_id
        from categories
         group by id');
         if($categories){
            return response()->json(['categories'=>$categories]);

         }
    }

    public function create(){
        $brands=Brands::all();
        return view ('backend.Products.addProduct')->with([ 'brands'=>$brands]);


    }

    public function store(Request $request){

        $request->validate([

            'name' => 'required',
            'description' =>'required ',
            'image' => 'required|image',
             'brand_id'=>'required',
             'main_category_id'=>'required',

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
            $path = $image->store('products', 'public');
        } else {

            $path = null;
        }

        $products = new Products();
        $products->name = $request->input('name');
        $products->description = $description;
        $products->brand_id = $request->input('brand_id');
        $products->category_id = $request->input('main_category_id');

        $products ->image = $path;
        $products->save();
        if ($products->save()) {
            return redirect(route('admin.products'))->with([
                'message' => sprintf('The Product: "%s" add success !', $products->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf('The Product: "%s" can not add success !', $products->name),
                'alert-type' => 'error'
            ])->withInput();
        }



    }

    public function delete($id)
    {
        $products = Products::findOrfail($id);

        if (!$products) {
            return redirect()->back()->with([
                'message' => sprintf('The Brand can not found!'),
                'alert-type' => 'error'
            ]);
        }

        $products->delete();
        return response()->json(['message' => sprintf('The Brand: "%s" deleted success !', $products->name)]);
    }


    public function editProduct($id)
    {
        $products = Products::findOrfail($id);
        if (!$products) {
            return redirect()->back()->with([
                'message' => sprintf('The Brand can not found!'),
                'alert-type' => 'error'
            ]);
        }

        return  view('backend.Products.update', [
            'products' =>  $products,


        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        $products = Products::findOrfail($id);
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
            $path = $image->storeAs('products', basename($products->image), 'public');
            $products->image = $path;
        }

        $products->name = $request->input('name');
        $products->description = $description;;
        $products->brand_id = $request->input('brand_id');
        $products->category_id = $request->input('main_category_id');
        $products->save();
        if ($products->save()) {
            return redirect(route('admin.products'))->with([
                'message' => sprintf(' The Product: "%s" edit success !', $products->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Product : "%s" can not edit success !', $products->name),
                'alert-type' => 'error'
            ])->withInput();
        }
     }

}
