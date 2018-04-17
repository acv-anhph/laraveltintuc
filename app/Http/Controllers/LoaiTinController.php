<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiTin;
use App\Models\TheLoai;
use Illuminate\Validation\Rule;

class LoaiTinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.list', array(
            'loaitin' => $loaitin,
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = TheLoai::all('id', 'Ten');
        $option = $theloai->toArray();
        $result = array();
        foreach ($option as $value) {
            $result[$value['id']] = $value['Ten'];
        }

        return view('admin.loaitin.create', array(
            'theloai' => $result
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
                'Ten' => 'required|min:3|max:100',
                'TheLoai' => 'required'
            ), array(
                'Ten.required' => 'Ban chua nhap ten loai tin',
                'Ten.min' => '3 -> 100 ki tu',
                'Ten.max' => '3 -> 100 li tu',
                'TheLoai.required' => 'phai chon the loai'
            )
        );

        $loaitin = new LoaiTin();
        $loaitin->Ten = $request->Ten;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();

        return back()->with('thongbao', 'tao moi thanh cong');
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
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all('id', 'Ten');

        return view('admin.loaitin.edit')->with(array(
            'loaitin' => $loaitin,
            'theloai' => $theloai
        ));
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
        $loaitin = LoaiTin::find($id);

        $this->validate(
            $request,
            array(
                'Ten' => [
                    'required',
                    'min:3',
                    'max: 100',
                    Rule::unique('loaitin', 'Ten')->ignore($loaitin->id)
                ],
//                'Ten' => 'unique:loaitin,Ten,'.$loaitin->id.',id',
                'TheLoai' => 'required'
            ),
            array(
                'Ten.required' => 'Ban chua nhap ten the loai',
                'Ten.min' => '3 -> 100 ki tu',
                'Ten.max' => '3 -> 100 li tu',
                'Ten.unique' => 'ten da ton tai',
                'TheLoai.required' => 'phai chon the loai'
            )
        );

        $loaitin->Ten = $request->Ten;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();

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
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return back()->with('message', 'Xóa sản phẩm thành công');
    }
}
