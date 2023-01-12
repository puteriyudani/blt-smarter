<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakats';
    protected $guarded = [];
    protected $fillable = ['NIK', 'nama', 'jenis_kelamin', 'alamat'];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'masyarakat_id');
    }
}
