<?php

namespace App\Http\Controllers\Api;

use App\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CustomHelpper;
use App\Http\Controllers\Controller;

class PengaduanController extends Controller
{
    public function index(){
      $data = Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->orderBy('created_at','desc')->get();
      foreach ($data as $d) {
        if(!is_null($d->nama_pelapor)){
          $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
        }
        if(!is_null($d->nama_petugas)){
            $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
        }
        if(!is_null($d->nama_admin)){
            $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
        }
      }
      return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->orderBy('created_at','desc')->get();
    }

    public function show($id){
      $data = Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();

      $data->nama_pelapor = DB::table('masyarakats')->where('id',$data->nama_pelapor)->first()->nama;
      if(!is_null($data->nama_petugas)){
          $data->nama_petugas = DB::table('petugas')->where('id',$data->nama_petugas)->first()->nama;
      }
      if(!is_null($data->nama_admin)){
          $data->nama_admin = DB::table('admins')->where('id',$data->nama_admin)->first()->nama;
      }

      return $data;

    }
    public function get_by_masyarakat(){
        $id = auth()->user()->id;
        $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
            'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
            'foto','tipe_pengaduan','deskripsi_pengaduan',
            'status_pengaduan','laporan_petugas','feedback_masyarakat'
            ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
          ->where('id_masyarakat',$id)->orderBy('created_at','desc')->get();
          foreach ($data as $d) {
            if(!is_null($d->nama_pelapor)){
              $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
            }
            if(!is_null($d->nama_petugas)){
                $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
            }
            if(!is_null($d->nama_admin)){
                $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
            }
          }
        return $data;
    }
    public function get_by_petugas(){
        $id = auth()->user()->id;
        $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
            'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
            'foto','tipe_pengaduan','deskripsi_pengaduan',
            'status_pengaduan','laporan_petugas','feedback_masyarakat'
            ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
          ->where('id_petugas',$id)->orderBy('created_at','desc')->get();
          foreach ($data as $d) {
            if(!is_null($d->nama_pelapor)){
              $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
            }
            if(!is_null($d->nama_petugas)){
                $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
            }
            if(!is_null($d->nama_admin)){
                $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
            }
          }
        return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id_petugas',$id)->orderBy('created_at','desc')->get();
    }

    public function get_not_assign(){
      $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->whereNull('id_petugas')->where('status_pengaduan','verified')
        ->orderBy('created_at','desc')->get();
        foreach ($data as $d) {
          if(!is_null($d->nama_pelapor)){
            $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
          }
          if(!is_null($d->nama_petugas)){
              $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
          }
          if(!is_null($d->nama_admin)){
              $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
          }
        }
      return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->whereNull('id_petugas')->whereNotNull('id_admin')->orderBy('created_at','desc')->get();
    }

    public function get_not_verified(){
      $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->whereNull('id_admin')->where('status_pengaduan','belum diverifikasi')
        ->orderBy('created_at','desc')->get();
        foreach ($data as $d) {
          if(!is_null($d->nama_pelapor)){
            $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
          }
          if(!is_null($d->nama_petugas)){
              $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
          }
          if(!is_null($d->nama_admin)){
              $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
          }
        }
      return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->whereNull('id_admin')->orderBy('created_at','desc')->get();
    }

    public function get_by_tipe($tipe){
      $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->where('tipe_pengaduan',$tipe)
        ->orderBy('created_at','desc')->get();
        foreach ($data as $d) {
          if(!is_null($d->nama_pelapor)){
            $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
          }
          if(!is_null($d->nama_petugas)){
              $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
          }
          if(!is_null($d->nama_admin)){
              $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
          }
        }
      return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('tipe_pengaduan',$tipe)->orderBy('created_at','desc')->get();
    }
    public function get_by_status($status){
      $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->where('status_pengaduan',$status)
        ->orderBy('created_at','desc')->get();
        foreach ($data as $d) {
          if(!is_null($d->nama_pelapor)){
            $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
          }
          if(!is_null($d->nama_petugas)){
              $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
          }
          if(!is_null($d->nama_admin)){
              $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
          }
        }
      return $data;
        // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('status_pengaduan',$status)->orderBy('created_at','desc')->get();
    }

    public function get_by_tipe_n_status($tipe,$status){
      $data =  Pengaduan::select('id','id_masyarakat','id_masyarakat as nama_pelapor',
          'id_admin','id_admin as nama_admin','id_petugas','id_petugas as nama_petugas','nama_jalan',
          'foto','tipe_pengaduan','deskripsi_pengaduan',
          'status_pengaduan','laporan_petugas','feedback_masyarakat'
          ,DB::Raw('ST_AsGeoJSON(geometry) as geometry'))
        ->where('status_pengaduan',$status)->where('tipe_pengaduan',$tipe)
        ->orderBy('created_at','desc')->get();
        foreach ($data as $d) {
          if(!is_null($d->nama_pelapor)){
            $d->nama_pelapor = DB::table('masyarakats')->where('id',$d->nama_pelapor)->first()->nama;
          }
          if(!is_null($d->nama_petugas)){
              $d->nama_petugas = DB::table('petugas')->where('id',$d->nama_petugas)->first()->nama;
          }
          if(!is_null($d->nama_admin)){
              $d->nama_admin = DB::table('admins')->where('id',$d->nama_admin)->first()->nama;
          }
        }
      return $data;
      // return Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('status_pengaduan',$status)->where('tipe_pengaduan',$tipe)->get();
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
        $validated['status_pengaduan'] = "belum diverifikasi";
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

    public function anonim(request $request){
        $validated = $request->validate([
            'nama_jalan'=> 'required',
            'foto'=> 'nullable',
            'tipe_pengaduan' => 'required',
            'deskripsi_pengaduan'=>'required',
            'geometry' => 'required|JSON'
        ]);
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
            'status_pengaduan' => 'nullable',
            'laporan_petugas' => 'nullable',
        ]);

        $data = Pengaduan::select('id','id_masyarakat','id_admin','id_petugas','nama_jalan','foto','tipe_pengaduan','deskripsi_pengaduan','status_pengaduan','laporan_petugas','feedback_masyarakat',DB::Raw('ST_AsGeoJSON(geometry) as geometry'))->where('id',$id)->first();
        $data->id_petugas = auth()->user()->id;
        if(is_null($request->status_pengaduan)){
          $data->status_pengaduan = "Proses Petugas";
        }else{
          $data->status_pengaduan = $request->status_pengaduan;
        }
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
