<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'letter_no',
    //     'letter_date',
    //     'letter_char',
    //     // 'date_received',
    //     // 'agenda_no',
    //     'regarding',
    //     'sender_type',
    //     'sender_external',
    //     'sender_internal',
    //     'pengirim_unit_internal',
    //     'unit_tujuan',
    //     'karyawan_tujuan',
    //     'department_id',
    //     // 'sender_id',
    //     'letter_file',
    //     'letter_type',
    //     'status_condition'
    // ];
    protected $guarded = [];

    protected $hidden = [];
    // protected $dates = ['letter_date','date_received'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employees_id_destination', 'id');
    }

    public function PengirimUnitInternal()
    {
        return $this->belongsTo(Department::class, 'pengirim_unit_internal', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(Sender::class, 'sender_id', 'id');
    }
}
