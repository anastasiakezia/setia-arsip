<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'name',
    // ];
    protected $guarded = [];

    protected $hidden = [];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class);
    }
}
