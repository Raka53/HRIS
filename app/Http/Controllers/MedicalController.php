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
      
            return view('medical.index');
        
    
    }
  

    /**
     * Show the form for creating a new resource.
     */
    public function create(hrd $id)
    {
        $medicalClaim = medical::where('hrd_id', $id->id)->get();
   
        return view('medical.add_patient', compact('medicalClaim','id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        
        $request->validate([
            'hrd_id' => 'required',
            'patient' => 'required',
            'date' => 'required|date',
            'doctor_fee' => 'required|numeric|min:0',
            'obat' => 'required|numeric|min:0',
            'kacamata' => 'required|numeric|min:0',
        
        ]);
        $total = ( $request->doctor_fee + $request->obat + $request->kacamata);
        medical::create([
        'hrd_id' => $request->hrd_id,
        'patient' => $request->patient,
        'date' => $request->date,
        'doctor_fee' => $request->doctor_fee,
        'obat' => $request->obat,
        'kacamata' => $request->kacamata,
        'Total' => $total
       
        ]);
    
        Alert::success('Success', 'Data berhasil ditambah.')->persistent(true);

        return redirect()->route('medical.show', $request->hrd_id);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(hrd $medical)
        { 
           
            return view('medical.detail', compact('medical'));
        }


        public function getMedicalData(hrd $medical)
        {
            $medicalClaim = medical::where('hrd_id', $medical->id)->get();
            
            return DataTables::of($medicalClaim)
                ->addIndexColumn()
                ->addColumn('total', function ($row) {
                    return $row->doctor_fee + $row->obat + $row->kacamata;
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-danger btn-sm tombol-del" data-id="' . $row->id . '">Delete</button>';
                })
                ->rawColumns(['action'])
                ->make(true);
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
    public function destroy($id)
    {
        try {
            $medicalClaim = medical::findOrFail($id);
            $medicalClaim->delete();
    
            return response()->json(['success' => true, 'message' => 'Patient deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete patient.']);
        }
    }
}
