<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murid';
    protected $primaryKey = 'nis'; // Primary key: nis
    public $incrementing = false; // Tidak auto-increment
    protected $keyType = 'string'; // Tipe data string

    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'no_telp',
        'jenis_kelamin',
        'tgl_lahir',
        'username_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'username_user', 'username');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'nis', 'nis');
    }
}