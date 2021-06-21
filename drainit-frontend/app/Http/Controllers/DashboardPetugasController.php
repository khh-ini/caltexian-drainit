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
        $data = Http::withHeaders([
            'Authorization' => "Bearer $token"
        ])->post('http://gis-drainase.pocari.id/api/update_pengaduan/petugas'.$id,[
            '_method' => 'put',
            'status_pengaduan' => 'Laporan diproses'
        ]);

        dd($id);
        
    }
}
