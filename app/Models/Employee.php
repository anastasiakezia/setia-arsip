<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_name',
        'unit',
        'position'
    ];

    // protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'departments_id', 'id');
    }
    public function letter()
    {
        return $this->hasMany(Letter::class);
    }
}
