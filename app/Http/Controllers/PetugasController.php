<?php

namespace App\Http\Controllers;

use App\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    public function index(){
        return Petugas::all();
    }

    public function show($id){
        return Petugas::find($id);
    }

    public function profile(){
        $id = auth()->user()->id;
        return Petugas::find($id);
    }

    public function register(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:55',
            'email' => 'email|required|unique:petugas',
            'password'=> 'required|confirmed',
            'foto' => 'required',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat'=> 'required',
            'no_hp'=> 'required',
        ]);

        $validateData['password'] = Hash::make($request->password);

        $user = Petugas::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['message'=>'petugas created successfully!','user'=>$user,'access_token'=>$accessToken],201);
        
    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password'=> 'required'
        ]);
        $user = Petugas::where('email',$loginData['email'])->first();

        if(!$user || Hash::check($user->password, $request->password)){
            return response(['message'=>'invalid credentials']);
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['message'=>'log in successfully!','user'=>$user,'access_token'=>$accessToken],200);
    }
    public function update(request $request){
        $validateData = $request->validate([
            'nama' => 'required|max:55',
            'email' => 'email|required',
            'password'=> 'required|confirmed',
            'foto' => 'required',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat'=> 'required',
            'no_hp'=> 'required',
        ]);
        $id = auth()->user()->id;

        $data = Petugas::find($id);
        $data->nama = $request->nama;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->foto = $request->foto;
        $data->posisi_petugas = $request->posisi_petugas;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->alamat = $request->alamat;
        $data->save();

        return response()->json(["message" => "Data Updated Successfully!", "data" => $data],200);
    }

    public function delete($id){
        $data = Petugas::find($id);
        $data->delete();

        return response()->json(null,204);
    }
}
