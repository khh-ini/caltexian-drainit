<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $fillable = [
        'id_masyarakat','id_admin', 'id_petugas', 'nama_jalan', 'foto', 'tipe_pengaduan', 'deskripsi_pengaduan', 'status_pengaduan', 'laporan_petugas', 'feedback_masyarakat','geometry'
    ];
    protected $spatialFields = [
        'geometry'
    ];
}
