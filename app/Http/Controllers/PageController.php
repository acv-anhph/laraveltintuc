<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;
use App\Models\TheLoai;
use App\Models\LoaiTin;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $theloai = TheLoai::all();
        view()->share('theloai', $theloai);
    }

    public function trangchu()
    {
        return view('pages.trangchu');
    }

    public function lienhe()
    {
        return view('pages.lienhe');
    }

    public function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = $loaitin->tintuc()->paginate(5);
        return view('pages.loaitin')->with(array('loaitin' => $loaitin, 'tintuc' => $tintuc));
    }

    public function tintuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinlienquan = $tintuc->loaitin->tintuc()->where('id', '<>', $id)->take(4)->orderBy('id', 'desc')->get();
        $tinnoibat = $tintuc->loaitin->tintuc()->where('NoiBat', '=', 1)->where('id', '<>', $id)->take(4)->orderBy('id', 'desc')->get();

        return view('pages.tintuc')->with(array(
            'tintuc' => $tintuc,
            'tinlienquan' => $tinlienquan,
            'tinnoibat' => $tinnoibat
        ));
    }

    public function get_login()
    {
        return view('pages.dangnhap');
    }

    public function post_login(Request $request)
    {
        $this->validate(
            $request,
            array(
                'email' => 'required',
                'password' => 'required'
            ),
            array(
                'email.required' => 'ban chua nhap email',
                'password.required' => 'ban chua nhap password'
            )
        );

        if (Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')))) {
            return redirect('/');
        } else {
            return back()->with('thongbao', 'dang nhap khong thanh cong');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }

    public function timkiem(Request $request)
    {
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe', 'like', "%$tukhoa%")
                        ->orWhere('TomTat', 'like', "%$tukhoa%")
                        ->orWhere('NoiDung', 'like', "%$tukhoa%")->paginate(5);

        return view('pages.timkiem')->with(array(
            'tukhoa' => $tukhoa,
            'tintuc' => $tintuc
        ));
    }
}
