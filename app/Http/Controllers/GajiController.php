<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Hrd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $data = Gaji::with('hrd')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = route('gajiAjax.edit', $row->id);
                    $btn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Edit/Update</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('gaji.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawan = Hrd::whereDoesntHave('gaji')->get();
        return view('gaji.create', compact('karyawan'));
        
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hrd_id' => 'required',
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
        ]);

        $gaji = new Gaji;
        $gaji->hrd_id = $request->hrd_id;
        $gaji->salary = $request->salary;
        $gaji->lembur = $request->lembur;
        $gaji->transport = $request->transport;
        $gaji->meals = $request->meals;
        $gaji->total = $request->salary + $request->lembur + $request->transport + $request->meals;
        $gaji->save();

        Alert::success('Success', 'Data gaji berhasil ditambah.')->persistent(true);

        return redirect()->route('gajiAjax.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaji $gaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $gaji = Gaji::findOrFail($id);
        return view('gaji.edit', compact('gaji'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
        ]);

        $gaji = Gaji::findOrFail($id);
        $gaji->salary = $request->salary;
        $gaji->lembur = $request->lembur;
        $gaji->transport = $request->transport;
        $gaji->meals = $request->meals;
        $gaji->total = $request->salary + $request->lembur + $request->transport + $request->meals;
        $gaji->save();

        Alert::success('Success', 'Data gaji berhasil diperbarui.')->persistent(true);

        return redirect()->route('gajiAjax.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gaji = Gaji::findOrFail($id);
        $gaji->delete();

        Alert::success('Success', 'Data gaji berhasil dihapus.')->persistent(true);

        return redirect()->route('gajiAjax.index');
    }
}
