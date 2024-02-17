<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'karyawan';

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
