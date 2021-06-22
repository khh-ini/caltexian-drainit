<?php

use Illuminate\Database\Seeder;

class VotesSeeders extends Seeder
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
        
        DB::table('petugas')->insert([
            'id' => Str::uuid(),
            'id_masyarakat' => $user->id,
            'nama_jalan'=> 'jalan pesisir',
            'foto'=> 'defaultbajir.png',
            'tipe_pengaduan' => 'Banjir',
            'deskripsi_pengaduan'=>'test',
            'geometry' => "{\"type\": \"Point\", \"coordinates\": [30, 10]}"
        ]);
    }
}
