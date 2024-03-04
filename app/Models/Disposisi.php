<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'letter_id',
        'asal_unit_disposisi',
        'asal_karyawan_disposisi',
        'tujuan_unit_disposisi',
        'tujuan_karyawan_disposisi',
        'isi_disposisi',
        'letter_file'
    ];
    // protected $dates = ['tgl_selesai','tgl_aju_kembali','tgl_selesai_2','tgl_selesai_3'];
    protected $hidden = [];

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_id', 'id');
    }
}
