<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LaporanBanjirController extends Controller
{
    //
    public function index(Request $request)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/pengaduan_by_tipe_n_status/Banjir/Belum diverifikasi');
          
        return view('/laporanbanjir', ['data' => $data->json()]);
    }

    public function verifikasi(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $id_admin = $request->session()->get('id_admin', 'default');

        $validated = $request->validate([
            'status_pengaduan' => "Sudah diverifikasi"
        ]);

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/update_pengaduan/admin/' . $id, [
            '_method' => 'put',
            'id_admin' => $id_admin,
            'status_pengaduan' => "Sudah diverifikasi"
        ]);

        // dd($response->json());
        return redirect('/laporanbanjir');
    }

    public function tolak(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $id_admin = $request->session()->get('id_admin', 'default');

        $validated = $request->validate([
            'status_pengaduan' => "Pengajuan ditolak"
        ]);

        $response = Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/update_pengaduan/admin/' . $id, [
            '_method' => 'put',
            'id_admin' => $id_admin,
            'status_pengaduan' => "Pengajuan ditolak"
        ]);

        // dd($response->json());
        return redirect('/laporanbanjir');
    }

    public function detail(Request $request, $id)
    {
        $token = $request->session()->get('token', 'default');
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('http://gis-drainase.pocari.id/api/pengaduan/' . $id);

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

        return view('detailLaporanBanjir', ['data' => json_encode($point), 'item' => $tersumbat]);
    }
}
