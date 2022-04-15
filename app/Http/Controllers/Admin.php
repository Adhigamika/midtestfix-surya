<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use illuminate\Pagination\Paginator;
use App\Models\keluhan;

class Admin extends Controller
{
    //
    public function login(){
        return view('admin.login');
    }

    public function proses_login(request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $check= $request->only('email','password');
        if(Auth::guard('admin')->attempt($check)){
            return redirect()->route('admin.Keluhanh');
        }else{
            return redirect()->back()->with('erorr','Login Failed');
        }
    
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function editKeluhan2(Request $request,$id){
        $data = keluhan::find($id);
        return view('admin.editKeluhan',compact('data'));
    }

    public function KeluhanAdmin(){
        
        $data= keluhan::join('users','users.id','keluhans.id_user')
        ->select('keluhans.*','users.name')->latest()->paginate(5);
        Paginator::useBootstrap();
   
        return view('Admin.dashboard',compact('data'));
    }

    public function tanggapiKeluhan($id){
        $data= keluhan::find($id);
        return view('Admin.tanggapan',compact('data'));
    }

    public function tanggapiKeluhanSave(request $request,$id){

        $request->validate([
            'tanggapan'=>'required'
        ]);
   
        $data = keluhan::find($id);
        $data->id_user = $request->id_user;
        $data->keluhan = $request->keluhan;
        $data->Tanggal_Pengajuan = $request->tanggal;
        $data->tanggapan_admin = $request->tanggapan;
        $data->id_admin=auth()->user()->id;
        $data->update();
        
        return redirect()->route('admin.Keluhanh');  
        
    }

    public function saveEditKeluhan2(request $request,$id){

        $request->validate([
            'tanggapan'=>'required'
        ]);
   
        $data = keluhan::find($id);
        $data->id_user = $request->id_user;
        $data->keluhan = $request->keluhan;
        $data->Tanggal_Pengajuan = $request->tanggal;
        $data->tanggapan_admin = $request->tanggapan;
        $data->id_admin=auth()->user()->id;
        $data->update();
        
        return redirect()->route('admin.Keluhanh');  
        
    }

    
    public function deleteKeluhan2(Request $request,$id){
        $data = keluhan::find($id);
        $data->tanggapan_admin=null;
        $data->id_admin=null;
        $data->update();
        return redirect()->route('admin.Keluhanh');
     }
}
