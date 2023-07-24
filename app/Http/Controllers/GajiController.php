<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Hrd;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;


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
    public function create(Request $request)
    {
        $hrd = Hrd::findOrFail($request->hrd_id);
        return view('gaji.create', compact('hrd'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'hrd_id' => 'required',
            'status_id' => 'required',
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
            'start_date_medical' => 'required|date',
            'end_date_medical' => 'required|date|after_or_equal:start_date_medical',
        ]);

        $status = $request->input('status_id');

        // If the status is probation (status_id = 2), calculate 80% of the salary
        $salary = ($status == 2) ? ($request->input('salary') * 0.8) : $request->input('salary');

        // Get the total medical claim for the HRD within the specified date range
        $start_date_medical = $request->input('start_date_medical');
        $end_date_medical = $request->input('end_date_medical');

        $medicalClaimTotal = Hrd::findOrFail($request->input('hrd_id'))
            ->medical()
            ->whereBetween('date_claim', [$start_date_medical, $end_date_medical])
            ->sum('Total');

        $gaji = new Gaji;
        $gaji->hrd_id = $request->input('hrd_id');
        $gaji->status_id = $status;
        $gaji->salary = $salary;
        $gaji->lembur = $request->input('lembur');
        $gaji->medical_claim = $medicalClaimTotal;
        $gaji->transport = $request->input('transport');
        $gaji->meals = $request->input('meals');
        $gaji->total = $salary + $request->input('lembur') + $medicalClaimTotal + $request->input('transport') + $request->input('meals');
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
            'status_id' => 'required',
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
            'start_date_medical' => 'required|date',
            'end_date_medical' => 'required|date|after_or_equal:start_date_medical',
        ]);

        $status = $request->input('status_id');

        // If the status is probation (status_id = 2), calculate 80% of the salary
        $salary = ($status == 2) ? ($request->input('salary') * 0.8) : $request->input('salary');

        // Get the total medical claim for the HRD within the specified date range
        $start_date_medical = $request->input('start_date_medical');
        $end_date_medical = $request->input('end_date_medical');

        $medicalClaimTotal = Hrd::findOrFail($request->input('hrd_id'))
            ->medical()
            ->whereBetween('date_claim', [$start_date_medical, $end_date_medical])
            ->sum('Total');

        $gaji = Gaji::findOrFail($id);
        $gaji->status_id = $status;
        $gaji->salary = $salary;
        $gaji->lembur = $request->input('lembur');
        $gaji->medical_claim = $medicalClaimTotal;
        $gaji->transport = $request->input('transport');
        $gaji->meals = $request->input('meals');
        $gaji->total = $salary + $request->input('lembur') + $medicalClaimTotal + $request->input('transport') + $request->input('meals');
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
