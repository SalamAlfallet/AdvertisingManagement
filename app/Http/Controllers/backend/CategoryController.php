<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Products;
use Storage;
use Illuminate\Support\Facades\File;

use App\Category;

class CategoryController extends Controller
{
    //

    public function index()
    {
        return view('backend.Categories.index')->with([

            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        $category = Category::all();
        return view('backend.Categories.addCategory')->with(['category' => $category]);
    }

    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',

            'image' => 'required',
        ]);

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $path = $image->store('categories', 'public');
        // } else {

        //     $path = null;
        // }

        $category = new Category();
        $category->name = $request->input('name');
        $category->image = $request->image;


        $category->save();
        if ($category->save()) {
            return redirect(route('admin.category'))->with([
                'message' => sprintf('تمت عملية الإضافة بنجاح '),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf('هناك مشكلة في عملية الإضافة'),
                'alert-type' => 'error'
            ])->withInput();
        }
    }

    public function delete($id)
    {



        $Category = Category::findOrfail($id);
        if (!empty($Category)) {
            $Category->delete();
            $data['msg'] =  'success';
        } else {
            $data['msg'] = 'error';
        }

        return response()->json($data);
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


        if ($category->image != null) {

                File::delete('storage/' . $category->image );


        }


        $category->name = $request->input('name');
        $category->image = $request->input('image');

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


    public function uploadsFile(Request $request)
    {


        if ($request->file('file')) {

            $file = $request->file('file');
            $path = $file->store('Categories', 'public');



            // return $path;
            return response()->json(['success' => $path]);
        }

        return "";
    }



}
