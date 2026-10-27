<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $table = 'Biodata_1156';

    protected $fillable = [
        'nama', 'profesi', 'email', 'telepon', 'alamat',
        'tentang', 'pendidikan', 'skill', 'foto',
    ];

    public function pengalaman()
    {
        return $this->hasMany(Pengalaman::class, 'biodata_id');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'biodata_id');
    }
}
