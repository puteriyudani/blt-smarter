<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasyarakatForm extends Model
{
    use HasFactory;

    protected $table = 'masyarakat_forms';
    protected $guarded = [];
    protected $fillable = ['nama'];

    public function penilaian_form()
    {
        return $this->hasMany(PenilaianForm::class, 'form_id');
    }
}
