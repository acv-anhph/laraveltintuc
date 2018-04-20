<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\TheLoai;
use App\Models\LoaiTin;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tintuc = TinTuc::orderBy('id', 'desc')->take(20)->get();

        return view('admin.tintuc.list')->with(
            array(
                'tintuc' => $tintuc
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.create')->with(
            array(
                'theloai' => $theloai,
                'loaitin' => $loaitin
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            array(
                'TieuDe' => 'required|min:3|max:100|unique:tintuc,TieuDe',
                'TomTat' => 'required',
                'NoiDung' => 'required'

            ),
            array(
                'TieuDe.required' => 'Ban chua nhap ten tieu de',
                'TomTat.required' => 'Ban chua nhap tom tat',
                'NoiDung.required' => 'Ban chua nhap noi dung',
                'TieuDe.min' => '3 -> 100 ki tu',
                'TieuDe.max' => '3 -> 100 li tu',
                'TieuDe.unique' => 'tieu de da ton tai'
            )
        );

        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        if ($request->hasFile('Hinh')) {
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $tintuc->Hinh = time() . '_' . $name;
            $file->move('uploads/tintuc', $tintuc->Hinh);
        } else {
            $tintuc->Hinh = '';
        }

        $tintuc->save();

        return back()->with('thongbao', 'tao moi thanh cong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all('id', 'Ten');
        $loaitin = $tintuc->loaitin->theloai->loaitin;

        return view('admin.tintuc.edit')->with(array(
            'tintuc' => $tintuc,
            'theloai' => $theloai,
            'loaitin' => $loaitin
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tintuc = TinTuc::find($id);

        $this->validate(
            $request,
            array(
                'TieuDe' => 'required|min:3|max:100|unique:tintuc,TieuDe,' . $id,
                'TomTat' => 'required',
                'NoiDung' => 'required'

            ),
            array(
                'TieuDe.required' => 'Ban chua nhap ten tieu de',
                'TomTat.required' => 'Ban chua nhap tom tat',
                'NoiDung.required' => 'Ban chua nhap noi dung',
                'TieuDe.min' => '3 -> 100 ki tu',
                'TieuDe.max' => '3 -> 100 li tu',
                'TieuDe.unique' => 'tieu de da ton tai'
            )
        );

        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;

        if ($request->hasFile('Hinh')) {
            unlink('uploads/tintuc/' . $tintuc->Hinh);

            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $tintuc->Hinh = time() . '_' . $name;
            $file->move('uploads/tintuc', $tintuc->Hinh);
        }

        $tintuc->save();

        return back()->with('thongbao', 'sua thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return back()->with('message', 'Xóa thành công');
    }
}
