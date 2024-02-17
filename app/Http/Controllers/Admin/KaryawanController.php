<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function showUnit()
    {
    }
    public function dropdown_karyawan(Request $request)
    {
        // $karyawan = Karyawan::where("departments_id", $request->id)->pluck('nama', 'id', 'position');
        $karyawan = Karyawan::where("departments_id", $request->id)->get();

        // return response()->json(['res' => $karyawan]);
        return response()->json($karyawan);
        // $karyawan = Karyawan::findOrFail($request->id);
        // $department = $karyawan->departments()->pluck('id', 'nama', 'position');
        // return response()->json(['data' => $department]);
        // return response()->json($department);
    }
}
