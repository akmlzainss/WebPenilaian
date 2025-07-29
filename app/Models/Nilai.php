<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $fillable = ['nip', 'nis', 'kode', 'nilai', 'predikat', 'semester'];

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'nis', 'nis');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'kode', 'kode');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'nip', 'nip');
    }
}