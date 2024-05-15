<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'jurusan_id'];
    public $timestamps = true;
    protected $primaryKey = "id";

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
