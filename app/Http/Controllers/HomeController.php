<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       // return auth::user()->name;
        // return redirect(route('profile',['id'=>auth::user()->name]));
    }



    public function uploadsFile(Request $request)
    {
        if ($request->file('file')) {

            $path = Storage::disk('uploads')->put('images', $request->file('file'));

        }

        return $path;
    }
    public function uploadsFileAvater(Request $request)
    {
        if ($request->file('file')) {

            $path = Storage::disk('uploads')->put('images', $request->file('file'));

        }

        return $path;
    }



    //     return $path;
    // }

    public function deleteFile(Request $request)
    {
        $data = '';
        $name = $request->input('name');
        $image_path = 'storage/'.$name;
        //        $dss = File::exists($image_path);


        if (File::exists($image_path)) {
            File::delete($image_path);
            $data = 'success';
        }

        return $image_path;
    }
    public function uploadMultiFile(Request $request) {
        $images=array();
            $files=$request->file('file');
           foreach($files as $file){
            $OriginalName=$file->getClientOriginalName();
            $name =   $OriginalName  ;
               $file= $file->move(public_path('storage/uploads'), $name);
                $images[]= $name;

           }
             return response()->json(['images'=>$images]);




   }
    public function deleteMultiFile(Request $request)
    {
        $data = '';
        $name = $request->input('name');
         $image_path ='storage/uploads/'.$name;
         if (File::exists($image_path)) {
            File::delete($image_path);
            $data = 'success';

        }

         return response()->json($image_path);
    }


}
