<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;
use App\Models\Disposisi;
use App\Models\Employee;
use App\Models\Department;


use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DisposisiController extends Controller
{

    public function index()
    {
        //
    }

    // public function create()
    // {

    //     $letters = Letter::all();
    //     return view('pages.admin.disposisi.create', [
    //         'letters' => $letters,
    //     ]);
    // }

    // public function modalContent(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'letter_id' => 'required',
    //         // 'status' => 'required',
    //         // 'sifat' => 'required',
    //         'asal_disposisi' => 'required',
    //         'tujuan_disposisi' => 'required',
    //         'isi_disposisi' => 'required',
    //         'status_surat' => 'required',
    //         'letter_file' => 'mimes:pdf|file'
    //     ]);

    //     if ($request->file('letter_file')) {
    //         $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
    //     }
    //     // if ($request->input('status')) {
    //     //     $validatedData['status'] = implode(',', $request->status);
    //     // }
    //     // if ($request->input('sifat')) {
    //     //     $validatedData['sifat'] = implode(',', $request->sifat);
    //     // }

    //     $validateData['approve_status'] = 0;
    //     //   ddd($request->all());
    //     $redirect = 'surat-disposisi';

    //     Disposisi::create($validatedData);

    //     $employees = Employee::all();
    //     $departments = Department::all();
    //     $item = Disposisi::with(['letter', 'asal_disposisi', 'asal_disposisi.department', 'tujuan_disposisi', 'tujuan_disposisi.department'])->get();
    //     // return view('pages.admin.letter.incoming', [
    //     //     'item' => $item,
    //     //     'departments' => $departments,
    //     //     'employees' => $employees
    //     // ]);

    //     return view('modal-content', [
    //         'items' => $item,
    //         'departments' => $departments,
    //         'employees' => $employees
    //     ]);

    //     // return response()->json(['item' => $item]);

    //     return redirect()
    //         ->route($redirect)
    //         ->with('success', 'Sukses! 1 Data Berhasil Disimpan');

    //     return view('partial.modal-content-first')->render();
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_id' => 'required',
            // 'status' => 'required',
            // 'sifat' => 'required',
            'asal_disposisi' => 'required',
            'tujuan_disposisi' => 'required',
            'isi_disposisi' => 'required',
            'status_surat' => 'required',
            'letter_file' => 'mimes:pdf|file'
        ]);

        if ($request->file('letter_file')) {
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }
        // if ($request->input('status')) {
        //     $validatedData['status'] = implode(',', $request->status);
        // }
        // if ($request->input('sifat')) {
        //     $validatedData['sifat'] = implode(',', $request->sifat);
        // }

        $validateData['approve_status'] = 0;
        //   ddd($request->all());
        $redirect = 'surat-disposisi';

        Disposisi::create($validatedData);

        // $employees = Employee::all();
        // $departments = Department::all();
        // $item = Disposisi::with(['letter', 'asal_disposisi', 'asal_disposisi.department', 'tujuan_disposisi', 'tujuan_disposisi.department'])->get();
        // return view('pages.admin.letter.incoming', [
        //     'item' => $item,
        //     'departments' => $departments,
        //     'employees' => $employees
        // ]);

        // return response()->json(['item' => $item]);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function disposisi_form()
    {
        if (request()->ajax()) {
            $query = Disposisi::with(['letter', 'asal_disposisi', 'asal_disposisi.department', 'tujuan_disposisi', 'tujuan_disposisi.department'])->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-disposisi', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('disposisi.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Disposisi/Eskalasi
                        </a>
                        <a class="btn btn-secondary btn-xs" href="' . route('disposisi-surat', $item->id) . '" target="_blank">
                            <i class="fas fa-print"></i> &nbsp; Cetak
                        </a>
                        <form action="' . route('disposisi.destroy', $item->id) . '" method="POST" onsubmit="return confirm(' . "'Anda akan menghapus item ini dari situs anda?'" . ')">
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
                ->make(true);
        }

        // $item = Letter::with(['employee', 'employee.department', 'PengirimUnitInternal'])->get();
        $employees = Employee::all();
        $departments = Department::all();
        $item = Disposisi::with(['letter', 'asal_disposisi', 'asal_disposisi.department', 'tujuan_disposisi', 'tujuan_disposisi.department'])->get();

        // $item = Disposisi::with(['letter', 'asalDisposisi', 'tujuanDisposisi', 'tujuanDisposisi.department'])->get();

        return view('pages.admin.disposisi.incoming', [
            'item' => $item,
            'departments' => $departments,
            'employees' => $employees
        ]);
        // return response()->json(['item' => $item]);
    }

    public function show($id)
    {
        // $item = Disposisi::with(['letter', 'asal_disposisi', 'asal_disposisi.department', 'tujuan_disposisi', 'tujuanDisposisi', 'tujuan_disposisi.department', 'tujuanDisposisi.department'])->findOrFail($id);
        $item = Disposisi::with(['letter', 'asalDisposisi', 'tujuanDisposisi', 'tujuanDisposisi.department'])->findOrFail($id);

        return view('pages.admin.disposisi.show', [
            'item' => $item,
        ]);

        // return response()->json(['items' => $item]);
    }
    public function disposisiprint($id)
    {
        $item = Disposisi::with(['letter'])->findOrFail($id);

        return view('pages.admin.disposisi.print-incoming', [
            'item' => $item,
            // 'status' => explode(',', $item->status),
            // 'sifat' => explode(',', $item->sifat),
            // 'petunjuk' => explode(',', $item->petunjuk),
            // 'disposisi' => explode(',', $item->letter->disposisi),
        ]);
    }

    public function edit($id)
    {
        $item = Disposisi::with(['letter', 'asalDisposisi', 'tujuanDisposisi', 'tujuanDisposisi.department'])->findOrFail($id);

        $letters = Letter::all();
        $employees = Employee::all();
        $departments = Department::all();

        return view('pages.admin.disposisi.edit', [
            'letters' => $letters,
            'item' => $item,
            'departments' => $departments,
            'employees' => $employees
            //     // 'status' => explode(',', $item->status),
            //     // 'sifat' => explode(',', $item->sifat)
        ]);

        // return response()->json(['item' => $item]);
    }

    public function getDropdownKaryawan($asal_unit)
    {
        $karyawan = Employee::where('departments_id', $asal_unit)->get();

        // return view('pages.admin.letter.edit', ['karyawan' => $karyawan]);
        return response()->json(['karyawan' => $karyawan]);
    }

    public function download_letter($id)
    {
        $item = Disposisi::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'letter_id' => 'required',
            'asal_disposisi' => 'required',
            'tujuan_disposisi' => 'required',
            'isi_disposisi' => 'required',
            'status_surat' => 'required',
            'letter_file' => 'mimes:pdf|file'
        ]);

        $item = Disposisi::findOrFail($id);

        // if ($request->file('letter_file')) {
        //     $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        // }
        // if ($request->input('status')) {
        //     $validatedData['status'] = implode(',', $request->status);
        // }
        // if ($request->input('sifat')) {
        //     $validatedData['sifat'] = implode(',', $request->sifat);
        // }
        // if ($request->input('petunjuk')) {
        //     $validatedData['petunjuk'] = implode(',', $request->petunjuk);
        // }
        // if ($request->input('penerima_disposisi_2')) {
        //     $validatedData['penerima_disposisi_2'] = implode(',', $request->penerima_disposisi_2);
        // }
        $redirect = 'surat-disposisi';

        // dd($request->all());

        $item->update($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Disposisi::findorFail($id);
        $redirect = 'surat-disposisi';
        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
