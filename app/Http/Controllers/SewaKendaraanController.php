<?php

namespace App\Http\Controllers;

use App\Models\sewaKendaraan;
use App\Models\Hrd;
use App\Http\Requests\StoresewaKendaraanRequest;
use App\Http\Requests\UpdatesewaKendaraanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class SewaKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = sewaKendaraan::with('hrd')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('SewaKendaraan.edit', $row->id);
                    $btn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit/Update</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('sewakendaraan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Hrd::WheredoesntHave('sewa')->get();
        return view('sewakendaraan.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hrd_id' => 'required',
            'jenis_kendaraan' => 'required',
            'harga_sewa' => 'required|numeric|min:0',
        
        ]);
        $sewa = new sewaKendaraan;
        $sewa->hrd_id = $request->hrd_id;
        $sewa->jenis_kendaraan = $request->jenis_kendaraan;
        $sewa->harga_sewa = $request->harga_sewa;
       
        $sewa->save();
    
        Alert::success('Success', 'Data Sewa berhasil ditambah.')->persistent(true);

        return redirect()->route('SewaKendaraan.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(sewaKendaraan $sewaKendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sewaKendaraan = sewaKendaraan::findOrFail($id);
        return view('sewakendaraan.edit', compact('sewaKendaraan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sewaKendaraan = sewaKendaraan::findOrFail($id);
        $request->validate([
            'jenis_kendaraan' => 'required',
            'harga_sewa' => 'required|numeric|min:0',
        ]);
       
        $sewaKendaraan->jenis_kendaraan = $request->jenis_kendaraan;
        $sewaKendaraan->harga_sewa = $request->harga_sewa;
    
        $sewaKendaraan->save();
    
        Alert::success('Success', 'Data Sewa berhasil diperbarui.')->persistent(true);
    
        return redirect()->route('SewaKendaraan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(sewaKendaraan $sewaKendaraan)
    {
        //
    }
   
}
