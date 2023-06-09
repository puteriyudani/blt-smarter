<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaianform extends Model
{
    use HasFactory;

    protected $table = 'penilaianform';
    protected $guarded = [];
    protected $fillable = ['form_id', 'subkriteria_id'];

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }

    public function forms() {
        return $this->belongsTo(Form::class, 'form_id');
    }
}
