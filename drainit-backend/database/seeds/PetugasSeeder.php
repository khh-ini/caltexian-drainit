<?php

use Illuminate\Database\Seeder;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('petugas')->insert([
            'id' => Str::uuid(),
            'nama' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => Hash::make('petugas'),
            'foto' => '<img src=# />',
            'posisi_petugas' => 'petugas',
            'tempat_lahir' => 'selatpanjang',
            'tgl_lahir' => '1999-01-01',
            'alamat'=> 'jln. jangan di tengan',
            'no_hp'=> '08102390123',
        ]);
    }
}
