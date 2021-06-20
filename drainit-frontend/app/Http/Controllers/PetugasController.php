<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetugasController extends Controller
{
    //
    public function __construct(Request $request)
    {
        
    }

    public function index(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
            ])->get('http://gis-drainase.pocari.id/api/petugas');

        return view('petugas', ['data' => $data->json()]);
    }

    public function detail(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
            ])->get('http://gis-drainase.pocari.id/api/petugas/' . $id);

        // dd($data->json());

        return view('detailPetugas', ['data' => $data->json()]);
    }

    public function create(Request $request) {
        $token = $request->session()->get('token', 'default');
        
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
            'password2' => 'required',
            'nama' => 'required',
            'foto' => 'required',
            'no_hp' => 'required',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        //image logic
        $image = $_FILES['foto'];
        $file_tmp = $image['tmp_name'];
        $data = file_get_contents($file_tmp);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
            ])->post('http://gis-drainase.pocari.id/api/register/petugas', [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
            'password_confirmation' => $request->post('password2'),
            'nama' => $request->post('nama'),
            'foto' => base64_encode($data),
            'no_hp' => $request->post('no_hp'),
            'posisi_petugas' => $request->post('posisi_petugas'),
            'tempat_lahir' => $request->post('tempat_lahir'),
            'tgl_lahir' => $request->post('tgl_lahir'),
            'alamat' => $request->post('alamat')
        ]);
        
        // dd($response->json());
        return redirect('/petugas');
    }

    public function delete(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/petugas/' . $id, [
            '_method' => 'delete'
        ]);

        // dd($response->json());
        return redirect('/petugas');
    }

    public function update(Request $request, $id) {
        $token = $request->session()->get('token', 'default');

        $validate = $request->validate([
            'email' => 'required',
            'nama' => 'required',
            'no_hp' => 'required',
            'posisi_petugas' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required'
        ]);

        //image logic
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
            ])->post('http://gis-drainase.pocari.id/api/petugas/' . $id, [
            '_method' => 'put',
            'email' => $request->post('email'),
            'nama' => $request->post('nama'),
            'no_hp' => $request->post('no_hp'),
            'posisi_petugas' => $request->post('posisi_petugas'),
            'tempat_lahir' => $request->post('tempat_lahir'),
            'tgl_lahir' => $request->post('tgl_lahir'),
            'alamat' => $request->post('alamat')
        ]);
        
        // dd($response->json());
        return redirect('/petugas/detail/' . $id);
    }

    public function updateFoto(Request $request, $id) {
        $token = $request->session()->get('token', 'default');

        //image logic
        $image = $_FILES['foto'];
        $file_tmp = $image['tmp_name'];
        $data = file_get_contents($file_tmp);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
            ])->post('http://gis-drainase.pocari.id/api/petugas/' . $id, [
            '_method' => 'put',
            'email' => $request->post('email'),
            'nama' => $request->post('nama'),
            'no_hp' => $request->post('no_hp'),
            'posisi_petugas' => $request->post('posisi_petugas'),
            'tempat_lahir' => $request->post('tempat_lahir'),
            'tgl_lahir' => $request->post('tgl_lahir'),
            'alamat' => $request->post('alamat'),                                                                                                                            
            'foto' => base64_encode($data),
        ]);
        
        // dd($response->json());
        return redirect('/petugas/detail/' . $id);
    }
}
