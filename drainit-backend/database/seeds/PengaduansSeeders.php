<?php

use Illuminate\Database\Seeder;

class PengaduansSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = DB::table('masyarakats')->first();
        
        DB::table('pengaduans')->insert([
            'id' => Str::uuid(),
            'id_masyarakat' => $user->id,
            'nama_jalan'=> 'jalan pesisir',
            'foto'=> 'defaultbajir.png',
            'tipe_pengaduan' => 'Banjir',
            'deskripsi_pengaduan'=>'test',
            'geometry' => DB::Raw("ST_GeomFromGeoJSON('{\"type\": \"Point\", \"coordinates\": [30, 10]}')"),
            'status_pengaduan' => 'Menunggu Verifikasi'
        ]);
        DB::table('pengaduans')->insert([
            'id' => Str::uuid(),
            'id_masyarakat' => $user->id,
            'nama_jalan'=> 'jalan pesisir2',
            'foto'=> 'defaultbajir.png',
            'tipe_pengaduan' => 'Banjir',
            'deskripsi_pengaduan'=>'test',
            'geometry' => DB::Raw("ST_GeomFromGeoJSON('{\"type\": \"Point\", \"coordinates\": [30, 10]}')"),
            'status_pengaduan' => 'Menunggu Verifikasi'
        ]);
    }
}
