<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Department;
use Yajra\DataTables\Facades\DataTables;

class KaryawanController extends Controller
{
    public function showUnit()
    {
    }
    public function get()
    {
        if (request()->ajax()) {
            $query = Department::with('departments')->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-primary btn-xs" data-bs-toggle="modal" data-bs-target="#updateModal' . $item->id . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('department.destroy', $item->id) . '" method="POST" onsubmit="return confirm(' . "'Anda akan menghapus item ini dari situs anda?'" . ')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make();
        }
        $employees = Karyawan::with('departments')->get();
        // $departments = Karyawan::with('departments')->get();
        return response()->json(['employees' => $employees]);

        // return view('pages.admin.employee.index', [
        //     'employees' => $employees,
        //     // 'departments' => $departments
        // ]);
    }
    public function dropdown_karyawan(Request $request)
    {
        $karyawan = Karyawan::where("departments_id", $request->id)->get();
        return response()->json($karyawan);
    }
}
