<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letterout;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class LetteroutController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        return view('pages.admin.letterout.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letterout_date' => 'required',
            'letterout_type' => 'required',
            'letterout_char' => 'required',
            'letterout_name' => 'required',
            // 'regarding' => 'required',
            'purpose' => 'required',
            'letter_file' => 'required|mimes:pdf|file',
            'letter_type' => 'required',
            'status_condition'
        ]);

        if ($request->file('letter_file')) {
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Keluar') {
            $redirect = 'surat-keluar';
        }

        $validatedData['status_condition'] = $request->input('status_condition', 0);
        Letterout::create($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function outgoing_mail()
    {
        if (request()->ajax()) {
            // $query = Letterout::latest()->get();
            $query = Letterout::where('letter_type', 'Surat Keluar')
                ->where('status_condition', 0)
                ->latest()
                ->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat-keluar', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letterout.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        </a>
                            <a class="btn btn-warning btn-xs" href="' . route('letter.edit', $item->id) . '" data-bs-toggle="modal" data-bs-target="#createModal">
                            <i class="fas fa-book"></i> &nbsp; Catatan
                        </a>
                        <form action="' . route('deletes-surat-keluar', $item->id) . ' "onsubmit="return confirm(' . "'Anda akan menghapus item ini dari situs anda?'" . ')">
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

        return view('pages.admin.letterout.outgoing');
    }

    public function show($id)
    {
        $item = Letterout::findOrFail($id);

        return view('pages.admin.letterout.show', [
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = Letterout::findOrFail($id);

        return view('pages.admin.letterout.edit', [
            'item' => $item,
        ]);
    }

    public function download_letter($id)
    {
        $item = Letterout::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letterout_date' => 'required',
            'letterout_type' => 'required',
            'letterout_char' => 'required',
            'letterout_name' => 'required',
            // 'regarding' => 'required',
            'purpose' => 'required',
            'letter_file' => 'mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        $item = Letterout::findOrFail($id);

        if ($request->file('letter_file')) {
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }
        $redirect = 'surat-keluar';

        $item->update($validatedData);

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Letterout::findorFail($id);

        if ($item->letter_type == 'Surat Keluar') {
            $redirect = 'surat-keluar';
        }

        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function delete_letter($id)
    {
        $item = Letterout::findOrFail($id);
        if ($item->letter_type == 'Surat Keluar') {
            $redirect = 'surat-keluar';
        }

        Letterout::where('id', $id)->update(['status_condition' => 1]);
        return redirect()
            ->route($redirect)
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }

    public function outgoing_mail_delete()
    {
        if (request()->ajax()) {
            // $query = Letterout::latest()->get();
            $query = Letterout::where('letter_type', 'Surat Keluar')
                ->where('status_condition', 1)
                ->latest()
                ->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat-keluar', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letterout.edit', $item->id) . '">
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

        return view('pages.admin.letterout.outgoing');
    }

    public function check_nomor_surat_keluar(Request $request)
    {
        $no_surat_keluar = $request->input('letter_no');
        $duplicate = Letterout::where('letter_no', $no_surat_keluar)->exists();

        return response()->json(['duplicate' => $duplicate]);
    }
}
