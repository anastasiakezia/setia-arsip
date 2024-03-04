<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'departments_id',
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
    // public function disposisi()
    // {
    //     return $this->hasMany(Disposisi::class);
    // }
    // public function tujuanDisposisi()
    // {
    //     return $this->hasOne('Disposisi::class');
    // }
}
