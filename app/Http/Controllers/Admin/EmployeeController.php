<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Employee;

use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        // $departments = Department::all();
        // return view('pages.admin.employee.index', [
        //     'departments' => $departments
        // ]);

        if (request()->ajax()) {
            // $query = Employee::latest()->get();
            $query = Employee::all();

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
        $employees = Employee::all();

        return view('pages.admin.employee.index', [
            'employees' => $employees
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
        ]);

        Employee::create([
            'employee_name' => $request->employee_name,
            'unit' => $request->unit,
            'position' => $request->position
        ]);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Employee::where('id', $id)
            ->update([
                'name' => $request->name
            ]);

        return redirect()
            ->route('employee.index')
            ->with('success', 'Sukses! 1 Data telah diperbarui');
    }

    public function destroy($id)
    {
        $item = Employee::findorFail($id);

        $item->delete();

        return redirect()
            ->route('employee.index')
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
