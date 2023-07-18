<?php

namespace App\Http\Controllers;

use App\Models\medical;
use App\Models\hrd;
use App\Http\Requests\StoremedicalRequest;
use App\Http\Requests\UpdatemedicalRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = medical::with('hrd')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('medical.tombol')->with('data', $row);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
            return view('medical.index');
        
    
    }
  

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $medicalClaim = medical::findOrFail($id);
        return view('medical.add_patient', compact('medicalClaim'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremedicalRequest $request, $id)
    {
        $medicalClaim = medical::findOrFail($id);
        
        // Validate the request data
        $validatedData = $request->validate([
            'patient_name' => 'required|string|max:255',
            'doctor_fee' => 'required|numeric',
            'obat' => 'required|numeric',
            'kacamata' => 'required|numeric',
        ]);

        // Create a new patient
        $medicalClaim->patients()->create($validatedData);

        // Optionally, add a success message
        Alert::success('Patient added successfully!');
        return redirect()->route('medical.show', $medicalClaim->id);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
        {
            $medicalClaim = medical::findOrFail($id);
            return view('medical.detail', compact('medicalClaim'));
        }

    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medical $medical)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemedicalRequest $request, medical $medical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medical $medical)
    {
        //
    }
}
