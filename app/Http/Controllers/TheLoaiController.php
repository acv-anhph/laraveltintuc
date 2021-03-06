<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TheLoai;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.list', array(
            'theloai' => $theloai,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.create', array(
            'theloai' => $theloai,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            array(
                'Ten' => 'required|min:3|max:100'
            ), array(
                'Ten.required' => 'Ban chua nhap ten the loai',
                'Ten.min' => '3 -> 100 ki tu',
                'Ten.max' => '3 -> 100 li tu'
            )
        );

        $theloai = new TheLoai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return back()->with('thongbao', 'them thanh cong');
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
        $theloai = TheLoai::find($id);

        return view('admin.theloai.edit')->with('theloai', $theloai);
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
        $this->validate(
            $request,
            array(
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ),
            array(
                'Ten.required' => 'Ban chua nhap ten the loai',
                'Ten.min' => '3 -> 100 ki tu',
                'Ten.max' => '3 -> 100 li tu',
                'Ten.unique' => 'ten da ton tai'
            )
        );

        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return back()->with('thongbao', 'sua thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = TheLoai::find($id);
        $product->delete();

        return back()->with('message', 'Xóa sản phẩm thành công');
    }
}
