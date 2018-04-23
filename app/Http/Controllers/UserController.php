<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        echo 'hahahahha';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request)
    {
        $this->validate(
            $request,
            array(
                'email' => 'required',
                'password' => 'required|min:3|max:32'
            ),
            array(
                'email.required' => 'ban chua nhap email',
                'password.required' => 'ban chua nhap password',
                'password.min' => '3 - 32 ki tu',
                'password.max' => '3 - 32 ki tu'
            )
        );

        if (Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')))) {
            return redirect()->route('tintuc.index');
        } else {
            return back()->with('thongbao', 'dang nhap khong thanh cong');
        }

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('user.login');
    }
}
