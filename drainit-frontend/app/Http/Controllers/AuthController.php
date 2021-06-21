<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function loginadmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $response = Http::withHeaders([
            'accept' => 'application/json',
        ])->post('http://gis-drainase.pocari.id/api/login/admin', [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
        ]);

        $data = $response->json();

        if($data['status_code'] == 200) {
            $token = $data['access_token'];
            $id_admin = $data['user']['id'];
            $request->session()->put('role','admin');
            $request->session()->put('token', $token);
            $request->session()->put('id_admin', $id_admin);
            return redirect('/petugas');
        }

        $response = Http::withHeaders([
            'accept' => 'application/json',
        ])->post('http://gis-drainase.pocari.id/api/login/petugas', [
            'email' => $request->post('email'),
            'password' => $request->post('password'),
        ]);

        $data = $response->json();

        if($data['status_code'] == 200) {
            $token = $data['access_token'];
            $id_petugas = $data['user']['id'];
            $request->session()->put('role','petugas');
            $request->session()->put('token', $token);
            $request->session()->put('id_petugas', $id_petugas);
            return redirect('/dashboard-petugas/laporan');
        }

        // dd($data);
        
        return redirect('/');
        

        // return dd($data);
    }
}
