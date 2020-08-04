<?php

namespace App\Http\Controllers\ApiControllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use App\Category;
use App\Adv;
use App\User;

class AdvsController extends Controller
{

// get all Category
    public function Categories()
    {



        $categories = Category::all();
        return response([ 'data'=>$categories, 'message' => 'Retrieved successfully'], 200);

    }

// Search advertising by Category
    public function advsByCategory($category_id)
    {
        $advs = Adv::where('category_id', $category_id)->get();

        return response([ 'data'=>$advs, 'message' => 'Retrieved successfully'], 200);

    }

// Search advertising by ID

    public function advById($advs_id)
    {
        $adv = Adv::find($advs_id);
        return response([ 'data'=>$adv, 'message' => 'Retrieved successfully'], 200);

    }

//   add advertising
    public function storeAdv(Request $request)
    {


        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'price' => 'required',
            'location' => 'required',
            'descrioption' => 'required',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $Adv = Adv::create($request->all());


        return response([ 'data'=>$Adv, 'message' => 'Created  successfully'], 200);


    }

// update advertising
    public function updateAdv(Request $request,$id)
    {

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'price' => 'required',
            'location' => 'required',
            'descrioption' => 'required',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }


        $Adv = Adv::find($id);
     $data= $Adv->update($request->all());
        return response([ 'data'=>$data, 'message' => 'Retrieved successfully'], 200);
    }


// fetch user profile data

    public function profile($id)
    {

        $data = User::find($id);

        return response(['data' => $data, 'message' => 'Retrieved successfully'], 200);
    }


// Search advertising by name or descrioption or location or price
    public function getSearchResults(Request $request) {

        $data = $request->get('data');

        $search_data = Adv::where('name', 'like', "%{$data}%")
                         ->orWhere('descrioption', 'like', "%{$data}%")
                         ->orWhere('location', 'like', "%{$data}%")
                         ->orWhere('price', 'like', "%{$data}%")
                         ->get();

        return response([ 'data' => $search_data   , 'message' => 'Retrieved successfully'], 200);
    }


// update user profile data

public function updateProfile(Request $request,$id)
{

    $validator = Validator::make($data, [
        'fname' => 'required|max:255',
        'lname' => 'required |max:255',
        'location' => 'required',
        'phone' => 'required',
        'email' => 'required'

    ]);

    if($validator->fails()){
        return response(['error' => $validator->errors(), 'Validation Error']);
    }


    $user = User::find($id);
    $data= $user->update($request->all());

    return response(['data' => $user, 'message' => 'Retrieved  successfully'], 200);
}


// Delete user
public function deleteProfile($id)
{

    $user = User::find($id);
    $data= $user->delete();

    return response(['data' => $data, 'message' => 'Deleted successfully'], 200);
}




}
