<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Jurusan extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function member(){
        return $this->hasMany(Member::class);
    }
}
