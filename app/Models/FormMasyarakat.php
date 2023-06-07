<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormMasyarakat extends Model
{
    protected $table = 'form_masyarakat';
    protected $guarded = [];
    protected $fillable = ['nama', 'subkriteria_id'];

    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'subkriteria_id');
    }
}
