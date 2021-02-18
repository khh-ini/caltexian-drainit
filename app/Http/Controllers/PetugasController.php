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
            'foto'=> 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat'=> 'required',
            'no_hp'=> 'required',
        ]);

        $validateData['password'] = Hash::make($request->password);

        if(is_null($request->foto)){
            $validated['foto'] = 'defaultpetugas.png';
        }else{
            $uploadFolder = 'images';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $validated['foto'] = basename($image_uploaded_path);
        }
        $user = Petugas::create($validateData);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['message'=>'petugas created successfully!','user'=>$user,'access_token'=>$accessToken,'status_code'=>201],201);

    }
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password'=> 'required'
        ]);
        $user = Petugas::where('email',$loginData['email'])->first();

        if(!$user || !Hash::check( $loginData['password'],$user->password)){
            return response(['message'=>'invalid credentials']);
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json(['message'=>'log in successfully!','user'=>$user,'access_token'=>$accessToken,'status_code'=>200],200);
    }
    public function update(request $request){
        $validateData = $request->validate([
            'nama' => 'required|max:55',
            'email' => 'email|required',
            'password'=> 'required|confirmed',
            'foto'=> 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
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
        $data->posisi_petugas = $request->posisi_petugas;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->alamat = $request->alamat;

        if(!is_null($request->foto)){
            $uploadFolder = 'images';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $data->foto = basename($image_uploaded_path);
        }

        $data->save();

        return response()->json(["message" => "Data Updated Successfully!", "data" => $data,'status_code'=>200],200);
    }

    public function update_by_admin(request $request, $id){
        $validateData = $request->validate([
            'nama' => 'required|max:55',
            'email' => 'email|required',
            'foto'=> 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat'=> 'required',
            'no_hp'=> 'required',
        ]);

        $data = Petugas::find($id);
        $data->nama = $request->nama;
        $data->no_hp = $request->no_hp;
        $data->email = $request->email;
        $data->posisi_petugas = $request->posisi_petugas;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->alamat = $request->alamat;

        if(!is_null($request->foto)){
            $uploadFolder = 'images';
            $image = $request->file('foto');
            $image_uploaded_path = $image->store($uploadFolder, 'public');
            $data->foto = basename($image_uploaded_path);
        }

        $data->save();

        return response()->json(["message" => "Data Updated Successfully!", "data" => $data,'status_code'=>200],200);
    }

    public function delete($id){
        $data = Petugas::find($id);
        if($data){
          $data->delete();
        }else{
          return response()->json(['status_code'=>400],400);
        }

        return response()->json(['status_code'=>204],204);
    }
    public function logoutApi()
    { 
        $data = DB::table('oauth_access_tokens')->where('user_id', auth()->user()->id);
        if($data){
            $data->delete();
        }
        return response()->json(['status_code'=>200],200);
    }
}
