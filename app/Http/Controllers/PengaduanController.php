<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    public function index(){
        return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->get();
    }

    public function show($id){
        return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
    }

    public function create(request $request){
        $validate = $request->validate([
            'nama_jalan'=> 'required',
            'foto'=> 'required',
            'tipe_pengaduan' => 'required',
            'deskripsi_pengaduan'=>'required',
            'geometry' => 'required|JSON'
        ]);
        $validate['id_masyarakat'] = auth()->user()->id;
        $validate['status_pengaduan'] = "Menunggu Konfirmasi";
        $validate['geometry'] = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");
        $data = Pengaduan::create($validate);
        $data->geometry = json_decode($request->geometry);
        // $data = new Pengaduan;
        // $data->id_masyarakat = auth()->user()->id;
        // $data->nama_jalan = $request->nama_jalan;
        // $data->foto = $request->foto;
        // $data->tipe_pengaduan = $request->tipe_pengaduan;
        // $data->deskripsi_pengaduan = $request->deskripsi_pengaduan;
        // $data->status_pengaduan = "";
        // $data->geometry = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");
        // $data->save();

        return response()->json(["message" => "Added Successfully!", "data" => $data],201);
    }

    // public function update(request $request, $id){
    //     $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
    //     $data->id_masyarakat = $request->id_masyarakat;
    //     $data->id_admin = $request->id_admin;
    //     $data->id_petugas = $request->id_petugas;
    //     $data->nama_jalan = $request->nama_jalan;
    //     $data->foto = $request->foto;
    //     $data->tipe_pengaduan = $request->tipe_pengaduan;
    //     $data->deskripsi_pengaduan = $request->deskripsi_pengaduan;
    //     $data->status_pengaduan = $request->status_pengaduan;
    //     $data->laporan_petugas = $request->laporan_petugas;
    //     $data->feedback_masyarakat = $request->feedback_masyarakat;
    //     $data->geometry = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");
    //     $data->save();

    //     return response()->json(["message" => "Updated Successfully!", "data" => $data],200);
    // }

    public function updateAdmin(request $request, $id){
        $validate = $request->validate([
            'status_pengaduan' => 'required'
        ]);

        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();

        $data->id_admin = auth()->user()->id;
        $data->status_pengaduan = $request->status_pengaduan;
        $data->save();

        return response()->json(["message" => "Admin Update Successfully!", "data" => $data],200);
    }

    public function updatePetugas(request $request, $id){
        $validate = $request->validate([
            'status_pengaduan' => 'required',
            'laporan_petugas' => 'required',
        ]);
        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
        $data->id_petugas = auth()->user()->id;
        $data->status_pengaduan = $request->status_pengaduan;
        $data->laporan_petugas = $request->laporan_petugas;
        $data->save();

        return response()->json(["message" => "Petugas Update Successfully!", "data" => $data],200);
    }

    public function feedbackMasyarakat(request $request, $id){
         $validate = $request->validate([
            'feedback_masyarakat' => 'required',
        ]);
        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
        $data->feedback_masyarakat = $request->feedback_masyarakat;
        $data->save();

        return response()->json(["message" => "Feedback Updated Successfully!", "data" => $data],200);
    }
    

    public function delete($id){
        $data = Pengaduan::find($id);
        $data->delete();

        return response()->json(null,204);
    }
}
