<?php

use Illuminate\Database\Seeder;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masyarakats')->insert([
            'id' => Str::uuid(),
            'nama' => 'Masyarakat',
            'email' => 'masyarakat@gmail.com',
            'password' => Hash::make('masyarakat'),
            'no_hp' => '012304902',
            'foto' => '<img src=# />',
            'alamat' => 'jln. di tepi jalan'
        ]);
    }
}
