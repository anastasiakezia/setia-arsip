<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Letter;
use App\Models\Sender;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $departments = Department::all();
        // $senders = Sender::all();

        return view('pages.admin.letter.create', [
            'departments' => $departments,
            // 'senders' => $senders,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required|unique:letters',
            'letter_date' => 'required',
            'letter_char' => 'required',
            'sender_type' => 'required',
            'letter_name' => 'required',
            // 'sender_name_external',
            // 'sender_name_internal',
            'regarding' => 'required',
            // 'department_id' => 'required',
            // 'sender_id' => 'required',
            'sender_name' => 'required',
            'pengirim_unit_internal' => '',
            'employees_id_destination' => 'required',
            'letter_file' => 'required|mimes:pdf|file',
            'letter_type' => 'required',
        ]);
        // $validateData['sender_name_external'] = $request->input('sender_name_external');
        // $validateData['sender_name'] = $request->input('sender_name');
        // $validateData['pengirim_unit_internal'] = $request->input('pengirim_unit_internal');
        // $validateData['employees_id_destination'] = $request->input('employees_id_destination');

        if ($request->input('disposisi')) {
            $validatedData['disposisi'] = implode(',', $request->disposisi);
        }
        if ($request->file('letter_file')) {
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }
        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        }
        // $validatedData['status_condition'] = $request->input('status_condition', 0);
        Letter::create($validatedData);
        // Employee::create($validateData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_mail()
    {
        if (request()->ajax()) {
            // $query = Letter::with(['department', 'sender', 'employee'])
            //     ->where('letter_type', 'Surat Masuk')
            //     ->where('status_condition', 0)
            //     ->latest()
            //     ->get();
            // $query = Letter::with(['employee', 'employee.department'])
            //     ->where('letter_type', 'Surat Masuk')
            //     ->where('status_condition', 0)
            //     ->latest()
            //     ->get();
            $query = Letter::where('letter_type', 'Surat Masuk')
                ->Where('status_condition', 0)
                ->with('employee', 'employee.department')
                ->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                            <a class="btn btn-warning btn-xs" href="' . route('letter.edit', $item->id) . '" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-paper-plane"></i> &nbsp; Disposisi
                        </a>
                        </a>
                            <a class="btn btn-dark btn-xs" href="' . route('letter.edit', $item->id) . '" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-check-circle"></i> &nbsp; Tindak Lanjut
                        </a>
                        <form action="' . route('deletes-surat', $item->id) .  'onsubmit="return confirm(' . "'Anda akan menghapus item ini dari situs anda?'" . ')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })

                ->editColumn('post_status', function ($item) {
                    return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">' . $item->post_status . '</div>' : '<div class="badge bg-gray-200 text-dark">' . $item->post_status . '</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action', 'post_status'])
                ->make();
        }

        $departments = Department::all();
        // $employees = Employee::all();
        // $letters = Letter::with('department')->get();

        // $letters = Letter::with(['employee', 'employee.department'])
        //     ->where('letter_type', 'Surat Masuk')
        //     ->Where('status_condition', 0)
        //     ->latest()
        //     ->get();

        // $letters = Letter::where('letter_type', 'Surat Masuk')
        //     ->Where('status_condition', 0)
        //     ->with(['employee', 'employee.department'])
        //     ->get();
        $letters = Letter::with(['employee', 'employee.department'])
            ->where('letter_type', 'Surat Masuk')
            ->Where('status_condition', 0)
            ->get();

        return view('pages.admin.letter.incoming', [
            'departments' => $departments,
            'letters' => $letters,
        ]);
        // return response()->json(['letters' => $letters]);
    }

    public function show($id)
    {
        // $item = Letter::with(['employee', 'employee.department', 'pengirim_unit_internal'])->findOrFail($id);
        $item = Letter::with(['employee', 'employee.department', 'PengirimUnitInternal'])->findOrFail($id);

        // $item = DB::table('letters')
        //     ->leftJoin('departments', 'letters.pengirim_unit_internal', '=', 'departments.id')
        //     ->get();

        return view('pages.admin.letter.show', [
            'item' => $item,
        ]);

        // return response()->json(['items' => $item]);
    }

    public function edit($id)
    {
        // $item = Letter::findOrFail($id);
        $item = Letter::with(['employee', 'employee.department', 'PengirimUnitInternal'])->findOrFail($id);
        $employees = Employee::all();
        $departments = Department::all();
        // $senders = Sender::all();
        return view('pages.admin.letter.edit', [
            'departments' => $departments,
            // 'senders' => $senders,
            'employees' => $employees,
            'item' => $item,
            // 'disposisi' => explode(',', $item->disposisi),
        ]);
        // return response()->json(['items' => $item]);
    }

    public function download_letter($id)
    {
        $item = Letter::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required|unique:letters',
            'letter_date' => 'required',
            'letter_char' => 'required',
            'sender_type' => 'required',
            'letter_name' => 'required',
            // 'sender_name_external',
            // 'sender_name_internal',
            'regarding' => 'required',
            // 'department_id' => 'required',
            // 'sender_id' => 'required',
            'sender_name' => 'required',
            'pengirim_unit_internal' => '',
            'employees_id_destination' => 'required',
            'letter_file' => 'mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        $item = Letter::findOrFail($id);

        if ($request->file('letter_file')) {
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }
        if ($request->input('disposisi')) {
            $validatedData['disposisi'] = implode(',', $request->disposisi);
        }
        if ($validatedData['letter_type'] == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        }

        $item->update($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }
    public function delete_letter($id)
    {
        $item = Letter::findOrFail($id);
        if ($item->letter_type == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }
        Letter::where('id', $id)->update(['status_condition' => 1]);
        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function destroy($id)
    {
        $item = Letter::findorFail($id);

        if ($item->letter_type == 'Surat Masuk') {
            $redirect = 'surat-masuk';
        } else {
            $redirect = 'surat-keluar';
        }

        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function cobaCetak()
    {
        return view('pages.admin.letter.cetak-disposisi');
    }

    public function incoming_mail_delete()
    {
        if (request()->ajax()) {
            // $query = Letter::with(['department', 'sender'])->where('letter_type', 'Surat Masuk')->latest()->get();
            // $query = Letter::with(['department', 'sender'])
            //     ->where('letter_type', 'Surat Masuk')
            //     ->where('status_condition', 1)
            //     ->latest()
            //     ->get();
            $query = Letter::where('letter_type', 'Surat Masuk')
                ->Where('status_condition', 1)
                ->with(['employee', 'employee.department'])
                ->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                    return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">' . $item->post_status . '</div>' : '<div class="badge bg-gray-200 text-dark">' . $item->post_status . '</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action', 'post_status'])
                ->make();
        }
        $departments = Department::all();
        $employees = Employee::all();

        return view('pages.admin.letter.incoming', [
            'departments' => $departments,
            'employees' => $employees
        ]);
    }
    public function check_nomor_surat(Request $request)
    {
        $no_surat = $request->input('letter_no');
        $isDuplicate = Letter::where('letter_no', $no_surat)->exists();

        return response()->json(['is_duplicate' => $isDuplicate]);
    }
}
