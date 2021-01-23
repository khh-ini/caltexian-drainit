<?php

namespace App\Http\Controllers;

use App\Drainase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DrainaseController extends Controller
{
    public function index(){
        return Drainase::select(
            'id','id_admin',
            'nama_jalan','lebar',
            'panjang','kedalaman',
            'bahan','kondisi',
            'akhir_pembuangan','arah_alir',
            'foto','tipe_drainase',
            DB::Raw('ST_AsGeoJSON(geometry) as geometry')
        )->get();
    }

    public function show($id){
        return Drainase::select(
            'id','id_admin',
            'nama_jalan','lebar',
            'panjang','kedalaman',
            'bahan','kondisi',
            'akhir_pembuangan','arah_alir',
            'foto','tipe_drainase',
            DB::Raw('ST_AsGeoJSON(geometry) as geometry')
        )->where('id',$id)->first();
    }

    public function create(request $request){

        $validated = $request->validate([
            'nama_jalan' => 'required',
            'lebar' => 'required|numeric',
            'panjang' => 'required|numeric',
            'kedalaman' => 'required|numeric',
            'bahan' => 'required',
            'kondisi' => 'required',
            'akhir_pembuangan' => 'required',
            'arah_alir' => 'required',
            'foto' => 'required',
            'tipe_drainase' => 'required',
            'geometry' => 'required|JSON'
        ]);

        $validated['id_admin'] = auth()->user()->id;
        $validated['geometry'] = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");

        $data = Drainase::create($validated);

        $data->geometry = json_decode($request->geometry);

        return response()->json(["message" => "Data Added Successfully!", "data" => $data,'status_code'=>201],201);
    }

    public function update(request $request, $id){
        $validated = $request->validate([
            'nama_jalan' => 'required',
            'lebar' => 'required|numeric',
            'panjang' => 'required|numeric',
            'kedalaman' => 'required|numeric',
            'bahan' => 'required',
            'kondisi' => 'required',
            'akhir_pembuangan' => 'required',
            'arah_alir' => 'required',
            'foto' => 'required',
            'tipe_drainase' => 'required',
            'geometry' => 'required|JSON'
        ]);

        $data = Drainase::find($id);
        $data->id_admin = auth()->user()->id;
        $data->nama_jalan = $request->nama_jalan;
        $data->lebar = $request->lebar;
        $data->panjang = $request->panjang;
        $data->kedalaman = $request->kedalaman;
        $data->bahan = $request->bahan;
        $data->kondisi = $request->kondisi;
        $data->akhir_pembuangan = $request->akhir_pembuangan;
        $data->arah_alir = $request->arah_alir;
        $data->foto = $request->foto;
        $data->tipe_drainase = $request->tipe_drainase;
        $data->geometry = DB::Raw("ST_GeomFromGeoJSON('".$request->geometry."')");
        $data->save();

        $data->geometry = json_decode($request->geometry);

        return response()->json(["message" => "Data Updated Successfully!", "data" => $data,'status_code'=>200],200);
    }

    public function delete($id){
        $data = Drainase::find($id);
        if($data){
          $data->delete();
        }else{
          return response()->json(['status_code'=>400],400);
        }

        return response()->json(['status_code'=>204],204);
    }

}
