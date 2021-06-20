<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TersumbatController extends Controller
{
    //
    public function index(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/titik_tersumbat');
        return view('tersumbat', ['data' => $data->json()]);
    }

    public function detail(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/titik_tersumbat/' . $id);

        $tersumbat = $data->json();
        
        // dd($drainase);

        $point = [
            "type" => "Feature",
            "properties" => [
                "name" => "Coors Field",
                "amenity" => "Baseball Stadium",
                "popupContent" => "This is where the Rockies play!"
            ],
            "geometry" => json_decode($tersumbat['geometry'], true),
        ];

        $point['view'] = $point['geometry']['coordinates'];

        // dd($point['geometry']->{'coordinates'});

        return view('detailTersumbat', ['data' => json_encode($point), 'item' => $tersumbat]);
    }

    public function addTersumbat(Request $request)
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
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/titik_tersumbat', [
            'id_admin' => $id_admin,
            'nama_jalan' => $request->post('nama_jalan'),
            'foto' => base64_encode($data),
            'keterangan' => $request->post('keterangan'),
            'geometry' => $point,
        ]);

        // dd($response->json());
        return redirect('/tersumbat');
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
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/titik_tersumbat/' . $id, [
            '_method' => "put",
            'id_admin' => $id_admin,
            'nama_jalan' => $request->post('nama_jalan'),
            'foto' => base64_encode($data),
            'keterangan' => $request->post('keterangan'),
            'geometry' => $point,
        ]);

        // dd($response->json());
        return redirect('/tersumbat/detail/' . $id );
    }

    public function delete(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/titik_tersumbat/' . $id, [
            '_method' => 'delete'
        ]);

        // dd($response->json());
        return redirect('/tersumbat');
    }
}
