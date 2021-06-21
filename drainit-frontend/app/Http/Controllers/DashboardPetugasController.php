<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardPetugasController extends Controller
{
    //
    public function laporan(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/pengaduan_not_assign');
        
        // dd($data->json());
        return view('petugas/laporan', ['data' => $data->json()]);
    }

    public function prosesLaporan(Request $request, $id){
        $token = $request->session()->get('token', 'default');
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token",
        ])->post('http://gis-drainase.pocari.id/api/update_pengaduan/petugas/' . $id, [
            '_method' => 'put',
            'status_pengaduan'=>'Sedang diproses'
        ]);

        // dd($response->json()["data"]["id"]);
        return redirect('/dashboard-petugas/detail/'.$id);   
    }
    public function detailLaporan(Request $request, $id){
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/pengaduan/' . $id);

        $laporan = $data->json();
        
        // dd($drainase);
        $point = [
            "type" => "Feature",
            "properties" => [
                "name" => "Coors Field",
                "amenity" => "Baseball Stadium",
                "popupContent" => "This is where the Rockies play!"
            ],
            "geometry" => json_decode($laporan['geometry'], true),
        ];

        $point['view'] = $point['geometry']['coordinates'];

        // dd($point['geometry']->{'coordinates'});

        return view('petugas/detailLaporan', ['data' => json_encode($point), 'item' => $laporan]);
    }

    public function riwayatLaporan(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/pengaduan_by_petugas');
          
        // dd($data->json());
        return view('petugas/riwayatLaporan', ['data' => $data->json()]);
    }

    public function updateLaporan(Request $request, $id) {
        $token = $request->session()->get('token', 'default');

        $validate = $request->validate([
            'status_pengaduan' => 'required',
            'laporan_petugas' => 'required'
        ]);

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
            ])->post('http://gis-drainase.pocari.id/api/update_pengaduan/petugas/' . $id, [
            '_method' => 'put',
            'status_pengaduan' => $request->post('status_pengaduan'),
            'laporan_petugas' => $request->post('laporan_petugas')
        ]);

        // dd($response->json());

        return redirect('/dashboard-petugas/detail/'.$id);
    }
}
