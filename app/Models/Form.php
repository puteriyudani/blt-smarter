<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'forms';
    protected $guarded = [];
    protected $fillable = ['nama'];

    public function penilaianform()
    {
        return $this->hasMany(Penilaianform::class, 'form_id');
    }
}
