<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('username',$request->username);
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=> 'Username Wajib Di Isi!',
            'password.required'=> 'Password Wajib Di Isi!'
        ]);
        $infologin = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){
            return redirect('/')->with('Success','Berhasil Login!');
        }else{
            return redirect('login')->withErrors('Username atau Password Tidak Sesuai!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('login')->with('success','Berhasil Log Out!');
    }
    
}
