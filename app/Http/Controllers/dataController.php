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
        $data = hrd::orderBy('name','asc')->with('status_kry');
           
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
            return view('kandidat.tombol')->with('data', $data);
        })
        ->Make(true);
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
