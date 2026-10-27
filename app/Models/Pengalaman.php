<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengalaman extends Model
{
    protected $table    = 'Pengalaman_1156';
    protected $fillable = ['biodata_id', 'perusahaan', 'posisi', 'tahun'];
}
