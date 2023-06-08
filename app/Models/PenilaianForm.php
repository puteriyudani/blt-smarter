<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianForm extends Model
{
    protected $table = 'penilaian_form';
    protected $guarded = [];
    protected $fillable = ['form_id', 'subkriteria_id'];

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }

    public function masyarakats_form() {
        return $this->belongsTo(MasyarakatForm::class, 'form_id');
    }
}
