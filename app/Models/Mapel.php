<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $table = 'mapel';
    protected $primaryKey = 'kode'; // Primary key: kode
    public $incrementing = false; // Tidak auto-increment
    protected $keyType = 'string'; // Tipe data string

    protected $fillable = [
        'kode',
        'mata_pelajaran',
    ];

    public function guru()
    {
        return $this->hasMany(Guru::class, 'kode', 'kode');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'kode', 'kode');
    }
}