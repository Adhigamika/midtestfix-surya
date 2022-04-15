<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keluhan;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use illuminate\Pagination\Paginator;
class KeluhanController extends Controller
{
    
    public function Keluhan(){
       
        $data= keluhan::join('users','users.id','keluhans.id_user')->where('keluhans.id_user',auth()->user()->id)
        ->select('keluhans.*','users.name')->latest()->paginate(5);
        Paginator::useBootstrap();

        return view('dashboard.dashboard',compact('data')); 
    }


    public function addKeluhan(){
        return view('keluhan.add');
    }

   
    public function saveKeluhan(Request $request){
        $request->validate([
            'keluhan'=>'required',
            'tanggal'=>'required',
        ]);
   
      
        $data = new keluhan();
        $data->id_user = auth()->user()->id;
        $data->keluhan = $request->keluhan;
        $data->Tanggal_Pengajuan = $request->tanggal;
        $data->save();

        return redirect()->route('user.Keluhans');

    }

    public function editKeluhan(Request $request,$id){
      $data= keluhan::find($id);
      return view('keluhan.edit',compact('data'));
    }

    public function saveEditKeluhan(request $request,$id){
        $request->validate([
            'keluhan'=>'required',
            'tanggal'=>'required',
        ]);
   
      
        $data = keluhan::find($id);
        $data->id_user = $request->id_user;
        $data->keluhan = $request->keluhan;
        $data->Tanggal_Pengajuan = $request->tanggal;
        $data->update();
            return redirect()->route('user.Keluhans');  
        
    }

    public function deleteKeluhan(Request $request,$id){
       $data = keluhan::find($id);
       $data->delete();
       return redirect()->route('user.Keluhans');
    }

}
