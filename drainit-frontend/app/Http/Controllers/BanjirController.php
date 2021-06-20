<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BanjirController extends Controller
{
    //
    public function index(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/titik_banjir');
        return view('banjir', ['data' => $data->json()]);
    }

    public function detail(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/titik_banjir/' . $id);

        $banjir = $data->json();
        
        // dd($drainase);

        $point = [
            "type" => "Feature",
            "properties" => [
                "name" => "Coors Field",
                "amenity" => "Baseball Stadium",
                "popupContent" => "This is where the Rockies play!"
            ],
            "geometry" => json_decode($banjir['geometry'], true),
        ];

        $point['view'] = $point['geometry']['coordinates'];

        // dd($point['geometry']->{'coordinates'});

        return view('detailBanjir', ['data' => json_encode($point), 'item' => $banjir]);
    }


    public function addBanjir(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $id_admin = $request->session()->get('id_admin', 'default');
        $geo = $request->post('geometry');
        $point = '{"type": "Point", "coordinates": [ ' . $geo . '] }';
        // dd($request->file('foto'));

        //image logic
        $image = $_FILES['foto'];
        $file_tmp = $image['tmp_name'];
        $data = file_get_contents($file_tmp);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->post('http://gis-drainase.pocari.id/api/titik_banjir', [
            'id_admin' => $id_admin,
            'nama_jalan' => $request->post('nama_jalan'),
            'kondisi_kerusakan' => $request->post('kondisi'),
            'foto' => base64_encode($data),
            'keterangan' => $request->post('keterangan'),
            'geometry' => $point,
        ]);

        // dd($_FILES['foto']);

        // dd($response->json());
        return redirect('/banjir');
    }

    public function update(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $id_admin = $request->session()->get('id_admin', 'default');
        $geo = $request->post('geometry');
        $point = '{"type": "Point", "coordinates": [ ' . $geo . '] }';

        //image logic
        $image = $_FILES['foto'];
        $file_tmp = $image['tmp_name'];
        $data = file_get_contents($file_tmp);
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->post('http://gis-drainase.pocari.id/api/titik_banjir/' . $id, [
            '_method' => 'put',
            'id_admin' => $id_admin,
            'nama_jalan' => $request->post('nama_jalan'),
            'kondisi_kerusakan' => $request->post('kondisi'),
            'foto' => base64_encode($data),
            'keterangan' => $request->post('keterangan'),
            'geometry' => $point,
        ]);

        // dd($_FILES['foto']);

        // dd($response->json());
        return redirect('/banjir/detail/' . $id);
    }

    public function delete(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/titik_banjir/' . $id, [
            '_method' => 'delete'
        ]);

        // dd($response->json());
        return redirect('/banjir');
    }
}
