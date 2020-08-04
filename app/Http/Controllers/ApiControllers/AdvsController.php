<?php

namespace App\Http\Controllers\ApiControllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use App\Adv;
use App\User;

class AdvsController extends Controller
{


    public function Categories()
    {

        $categories = Category::all();
        return response()->json($categories);
    }


    public function advsByCategory($category_id)
    {
        $advs = Adv::where('category_id', $category_id)->get();
        return response()->json($advs);
    }
    public function advById($advs_id)
    {
        $adv = Adv::find($advs_id);
        return response()->json($adv);
    }


    public function storeAdv(Request $request)
    {
        $Adv = Adv::create($request->all());

        return response()->json($Adv, 201);



    }


    public function updateAdv(Request $request,$id)
    {

        $Adv = Adv::find($id);
     $data= $Adv->update($request->all());
        return response([ $data, 'message' => 'Retrieved successfully'], 200);
    }

    public function profile($id)
    {

        $data = User::find($id);

        return response(['data' => $data, 'message' => 'Retrieved successfully'], 200);
    }



    public function getSearchResults(Request $request) {

        $data = $request->get('data');

        $search_data = Adv::where('name', 'like', "%{$data}%")
                         ->orWhere('descrioption', 'like', "%{$data}%")
                         ->orWhere('location', 'like', "%{$data}%")
                         ->orWhere('price', 'like', "%{$data}%")
                         ->get();

        return response([ 'data' => $search_data   , 'message' => 'Retrieved successfully'], 200);
    }


}
