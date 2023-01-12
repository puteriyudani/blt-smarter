<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $guarded = [];
    protected $fillable = ['nama', 'prioritas'];

    public function subkriterias()
    {
        return $this->hasMany(Subkriteria::class, 'kriteria_id');
    }
}
