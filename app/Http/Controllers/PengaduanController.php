<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomHelpper;

class PengaduanController extends Controller
{
    public function index(){
        return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->get();
    }

    public function show($id){
        return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
    }
    public function get_by_masyarakat(){
        $id = auth()->user()->id;
        return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id_masyarakat',$id)->get();
    }

    public function create(request $request){
        $validated = $request->validate([
            'nama_jalan'=> 'required',
            'foto'=> 'nullable',
            'tipe_pengaduan' => 'required',
            'deskripsi_pengaduan'=>'required',
            'geometry' => 'required|JSON'
        ]);
        $validated['id_masyarakat'] = auth()->user()->id;
        $validated['status_pengaduan'] = "Menunggu Konfirmasi";
        $validated['geometry'] = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");

        if(is_null($request->foto)){
            $validated['foto'] = 'defaultpengaduan.png';
        }else{
          $fileUploadHelper = new CustomHelpper();

          $encoded_img = $request->foto;
          $decoded = base64_decode($encoded_img);
          $mime_type = finfo_buffer(finfo_open(), $decoded, FILEINFO_MIME_TYPE);
          $extension = $fileUploadHelper->mime2ext($mime_type);
          $file = uniqid() .'.'. $extension;
          $file_dir = storage_path('app/public/images/'). $file;
          file_put_contents($file_dir, $decoded);
          $validated['foto'] = $file;
        }

        $data = Pengaduan::create($validated);
        $data->geometry = json_decode($request->geometry);

        return response()->json(["message" => "Added Successfully!", "data" => $data, 'status_code'=>201],201);
    }

    public function updateAdmin(request $request, $id){
        $validate = $request->validate([
            'status_pengaduan' => 'required'
        ]);

        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();

        $data->id_admin = auth()->user()->id;
        $data->status_pengaduan = $request->status_pengaduan;
        $data->save();

        return response()->json(["message" => "Admin, Update Successfully!", "data" => $data,'status_code'=>200],200);
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

        return response()->json(["message" => "Petugas, Update Successfully!", "data" => $data, 'status_code'=>200],200);
    }

    public function feedbackMasyarakat(request $request, $id){
         $validate = $request->validate([
            'feedback_masyarakat' => 'required',
        ]);
        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
        $data->feedback_masyarakat = $request->feedback_masyarakat;
        $data->save();

        return response()->json(["message" => "Feedback Updated Successfully!", "data" => $data,'status_code'=>200],200);
    }


    public function delete($id){
        $data = Pengaduan::find($id);
        if($data){
          $data->delete();
        }else{
          return response()->json(['status_code'=>400],400);
        }

        return response()->json(['status_code'=>204],204);
    }
}
