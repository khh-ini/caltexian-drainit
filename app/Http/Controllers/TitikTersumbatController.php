<?php

namespace App\Http\Controllers;

use App\TitikTersumbat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitikTersumbatController extends Controller
{
    public function index(){
        return TitikTersumbat::select(
            'id',
            'id_admin',
            'nama_jalan',
            'keterangan',
            'foto',
            DB::Raw('ST_AsGeoJSON(geometry) as geometry')
        )->get();
    }

    public function show($id){
        return TitikTersumbat::select(
            'id',
            'id_admin',
            'nama_jalan',
            'keterangan',
            'foto',
            DB::Raw('ST_AsGeoJSON(geometry) as geometry')
        )->where('id',$id)->first();;
    }

    public function create(request $request){

        $validated = $request->validate([
            'nama_jalan' => 'required',
            'geometry' => 'required',
            'foto'=> 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable',
        ]);

        $validated['id_admin'] = auth()->user()->id;
        $validated['geometry'] = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");

        if(is_null($request->foto)){
            $validated['foto'] = 'defaulttersumbat.png';
        }else{
            $uploadFolder = 'images';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $validated['foto'] = basename($image_uploaded_path);
        }

        $data = TitikTersumbat::create($validated);

        $data->geometry = json_decode($request->geometry);

        return response()->json(["message" => "Data Added Successfully!", "data" => $data,'status_code'=>201],201);
    }

    public function update(request $request, $id){

        $validated = $request->validate([
            'nama_jalan' => 'required',
            'geometry' => 'required',
            'foto'=> 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
            'keterangan' => 'nullable',
        ]);

        $data = TitikTersumbat::find($id);
        $data->id_admin = auth()->user()->id;
        $data->geometry = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");
        $data->nama_jalan = $request->nama_jalan;
        $data->keterangan = $request->keterangan;

        if(!is_null($request->foto)){
            $uploadFolder = 'images';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $data->foto = basename($image_uploaded_path);
        }
        $data->save();

        $data->geometry = json_decode($request->geometry);

        return response()->json(["message" => "Data Updated Successfully!", "data" => $data,'status_code'=>200],200);
    }

    public function delete($id){
        $data = TitikTersumbat::find($id);
        if($data){
          $data->delete();
        }else{
          return response()->json(['status_code'=>400],400);
        }

        return response()->json(['status_code'=>204],204);
    }
}
