<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index(){
        $users = User::where('usertype', '!=', 'admin')->get();
        return view('admin.userlist',[
            'users'=> $users
        ]);
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.edituser',[
            'user'=> $user
        ]);
        
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|regex:/\./',            
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()) {
            return redirect()->route('admin.edituser',$user->id)->withInput()->withErrors($validator);
        }

        // here we will update user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('admin.userlist')->with('success','user updated successfully.');
    }

    public function destroy($id){
        $user = User::findOrFail($id);

       // delete user from database
       $user->delete();

       return redirect()->route('admin.userlist')->with('success','user deleted successfully.');
    }
}
