<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DinasLuar;
use App\Models\Department;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DinasLuarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.admin.dinasLuar.dinas-luar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();

        return view('pages.admin.dinasLuar.create', [
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_type' => 'required',
            'tanggal_laporan' => 'required',
            'nama_petugas' => 'required',
            'unit' => 'required',
            'surat_tugas' => 'required|mimes:pdf|file',
            'laporan_dinas_luar' => 'required|mimes:pdf|file',
            'dokumen_lain' => 'mimes:pdf|file'
        ]);

        if ($request->file('surat_tugas')) {
            $validatedData['surat_tugas'] = $request->file('surat_tugas')->store('assets/surat_tugas');
        }

        if ($request->file('laporan_dinas_luar')) {
            $validatedData['laporan_dinas_luar'] = $request->file('laporan_dinas_luar')->store('assets/laporan_dinas_luar');
        }

        if ($request->file('dokumen_lain')) {
            $validatedData['dokumen_lain'] = $request->file('dokumen_lain')->store('assets/dokumen_lain');
        }

        if ($validatedData['letter_type'] == 'Laporan Dinas Luar') {
            $redirect = 'laporan-dinas-luar';
        }

        DinasLuar::create($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_dinas_luar()
    {
        if (request()->ajax()) {
            $query = DinasLuar::where('letter_type', 'Laporan Dinas Luar')
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
                            <a class="btn btn-dark btn-xs" href="' . route('letter.edit', $item->id) . '" data-bs-toggle="modal" data-bs-target="#createModalTindak">
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

        $letters = DinasLuar::with(['employee', 'employee.department'])
            ->where('letter_type', 'Surat Masuk')
            ->Where('status_condition', 0)
            ->get();

        return view('pages.admin.letter.dinas-luar', [
            'departments' => $departments,
            'letters' => $letters
        ]);
        // return response()->json(['letters' => $letters]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function show(DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function edit(DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DinasLuar $dinasLuar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DinasLuar  $dinasLuar
     * @return \Illuminate\Http\Response
     */
    public function destroy(DinasLuar $dinasLuar)
    {
        //
    }
}
