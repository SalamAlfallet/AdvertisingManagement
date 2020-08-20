<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class UsersController extends Controller
{
    //
    public function index(){

        return view ('backend.users.index')->with([
            'users' => User::get()
            ]);


    }

    public function create(){

        return view ('backend.users.adduser');


    }

    public function store(Request $request){

        $request->validate([

            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],


        ]);


     

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user ->password = Hash::make($request->input('password'));

        $user ->save();
        if ($user->save()) {
            return redirect(route('admin.users'))->with([
                'message' => sprintf('The user: "%s" add success !', $user->name),
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => sprintf('The user: "%s" can not add success !', $user->name),
                'alert-type' => 'error'
            ])->withInput();
        }



    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        if (!$user) {
            return redirect()->back()->with([
                'message' => sprintf('The user can not found!'),
                'alert-type' => 'error'
            ]);
        }

        return  view('backend.users.update', [
            'user' =>  $user,


        ]);
    }
    public function editProfile()
    {
        $user = Auth::user();

        return  view('backend.users.updateProfile', [
            'user' =>  $user,


        ]);
    }
    public function updateProfile(Request $request)
    {
        // $user = User::findOrfail($id);

        $userid = Auth::id();
        $user = User::findOrfail($userid);

       
        $user->fname = $request->input('fname');

        $user->lname = $request->input('lname');
        $user->location = $request->input('location');
        $user->phone = $request->input('phone');

        $user->email = $request->input('email');


        $user ->password = Hash::make($request->input('password'));
        if ($user->save()) {
            return redirect()->back()->with([

                'message' => sprintf('تم تعديل البيانات بنجاح'),

                'alert-type' => 'success'

            ]);

           
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' هناك مشكلة في عملية التعديل'),
                'alert-type' => 'error'
            ])->withInput();
        }
     }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrfail($id);


       
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user ->password = Hash::make($request->input('password'));
        if ($user->save()) {
            return redirect()->back()->with([

                'message' => sprintf('The Profile edit success !'),

                'alert-type' => 'success'

            ]);

           
        } else {
            return redirect()->back()->with([
                'message' => sprintf(' The Profile : "%s" can not edit success !', $user->name),
                'alert-type' => 'error'
            ])->withInput();
        }
     }

    public function delete($id)
    {
        $user = User::findOrfail($id);
        if (!$user) {
            return redirect()->back()->with([
                'message' => sprintf('The user can not found!'),
                'alert-type' => 'error'
            ]);
        }
  
      if($user->delete()){
        return response()->json(['message' => sprintf('The user: "%s" deleted success !', $user->name)]);
    }
    }

    
}
