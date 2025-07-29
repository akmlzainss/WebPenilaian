<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'nip'; // Primary key: nip
    public $incrementing = false; // Tidak auto-increment
    protected $keyType = 'string'; // Tipe data string

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'no_telp',
        'jenis_kelamin',
        'tgl_lahir',
        'username_user',
        'kode',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username_user', 'username');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'kode', 'kode');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'nip', 'nip');
    }
}