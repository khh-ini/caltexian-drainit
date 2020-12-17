<?php

namespace App;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;


class TitikTersumbat extends Model
{
    protected $fillable = [
        'id_admin', 'geometry', 'nama_jalan', 'foto'
    ];
    protected $spatialFields = [
        'geometry'
    ];
}
