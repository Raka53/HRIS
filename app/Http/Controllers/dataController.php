<?php

namespace App\Http\Controllers;


use App\Models\hrd;
use App\Models\kandidat;
use App\Models\medical;
use App\Models\gaji;
use App\Models\status_kdt;
use App\Models\status_kry;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\JsonResponse;
class dataController extends Controller
{
    public function datakry()
    {
        $data = hrd::orderBy('name','asc')->get();
           
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            return view('hrd.tombol')->with('data', $data);
        })
        ->addColumn('action', function ($data) {
            return view('medical.tombol')->with('data', $data);
        })
        ->Make(true);
    }
    public function datakdt()
    {
        $data = kandidat::with('posisiKdt')->get();
           
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            return view('kandidat.tombol')->with('data', $data);
        })
        ->Make(true);
    }
    public function dataStatus()
    {
        $data = kandidat::whereDoesntHave('statuskdt')->get();
        return new JsonResponse($data);
        
    }
    public function statusData()
    {
        $data = status_kdt::with('kandidat')->get();
           
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            $editUrl = route('statusKdt.edit', $data->id);
            $btn = '<div class = "justify-content-center"> <a href="' . $editUrl . '" class="btn btn-primary btn-sm ">Edit/Update</a></div>';
            return $btn;
        })->rawColumns(['aksi'])
        ->Make(true);
    }

    public function editStatus($id)
    {
        $status = status_kdt::with('kandidat')->findOrFail($id);
        return view('kandidat.statusUbah', compact('status'));
    }

    public function updateStatus(Request $request, $id)
{
    $status = status_kdt::findOrFail($id);

    $status->interview_user = $request->input('interview_user');
    $status->interview_MR = $request->input('interview_MR');
    $status->interview_FG = $request->input('interview_FG');
    $status->posisi_usulan = $request->input('posisi_usulan');
    $status->status_hasil = $request->input('status_hasil');

    // Anda bisa menambahkan validasi tambahan di sini sebelum menyimpan data

    $status->save();
    Alert::success('Success', 'Data Status berhasil di update.')->persistent(true);
    return redirect()->route('statuskandidat.status')->with('success', 'Status berhasil diperbarui.');
}
    public function dataCari()
    {
        $data = hrd::with('gaji')->get();
           
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            return view('gaji.show')->with('data', $data);
        })
        ->Make(true);
    }
    public function relatedData($id)
    {
        $gajiData = Gaji::where('hrd_id', $id)->get();

        return Datatables::of($gajiData)
            ->addIndexColumn()
            ->addColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->addColumn('action', function ($row) {
                // Add action buttons if needed
                return '<a href="#">Detail</a>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }


    
}
