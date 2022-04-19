<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'user_name' => 'required|min:3|max:10',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
        $messages = [
            'user_name.required'=>'Please enter your name!',
            'email.email'=>'Email is wrong format !',
            'password.required'=>'Please enter password!',
            'password.confirmed'=>'Confirm password is incorrect !',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return redirect()->route('user.create')->withErrors($validator)->withInput();
        }else{
            $attr = new User;
            $attr['name'] = $request->user_name;
            $attr['email'] = $request->email;
            $attr['password'] = Hash::make($request->password);
            $attr->save();
            return redirect()->route('user.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return view('user.edit')->with('user',$users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $rules = [
            'user_name' => 'required|min:3|max:10',
            /*'email' => 'required|email',*/
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ];
        $messages = [
            'user_name.required'=>'Please enter your name!',
            /*'email.email'=>'Email is wrong format !',*/
            'password.required'=>'Please enter password!',
            'password.confirmed'=>'Confirm password is incorrect !',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect()->route('user.edit',$id)->withErrors($validator)->withInput();
        }else{
            $attr = User::findOrFail($id);
            $attr['name'] = $request->user_name;
            /*$attr['email'] = $request->email;*/
            $attr['password'] = Hash::make($request->password);
            $attr->save();
            if($attr){
                if($attr->wasChanged()){
                    return redirect()->route('user.index');
                }
            }
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
