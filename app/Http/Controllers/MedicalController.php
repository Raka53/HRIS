<?php

namespace App\Http\Controllers;

use App\Models\medical;
use App\Models\hrd;
use App\Http\Requests\StoremedicalRequest;
use App\Http\Requests\UpdatemedicalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
            'date_claim' => 'required',
            'doctor_fee' => 'required|numeric|min:0',
            'obat' => 'required|numeric|min:0',
            'kacamata' => 'required|numeric|min:0',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'total' => 'required',
        ]);
        
       
         $filePath = null; 
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/medical', $fileName);
            }
        medical::create([
        'hrd_id' => $request->hrd_id,
        'patient' => $request->patient,
        'date_claim' => $request->date_claim,
        'date' => $request->date,
        'doctor_fee' => $request->doctor_fee,
        'obat' => $request->obat,
        'kacamata' => $request->kacamata,
        'Total' => $request->total,
        'foto' => $filePath,
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
                    $editButton = '<a href="' . route('medical.edit', $row->id) . '" class="btn btn-primary btn-sm">Edit</a>';
                    $deleteButton = '<button class="btn btn-danger btn-sm tombol-del" data-id="' . $row->id . '">Delete</button>';
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medical $medical)
    {
        return view('medical.edit', compact('medical'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medical $medical)
    {
        $request->validate([
            'hrd_id' => 'required',
            'statusKry' => 'required',
            'patient' => 'required',
            'date' => 'required|date',
            'date_claim' => 'required',
            'doctor_fee' => 'required|numeric|min:0',
            'obat' => 'required|numeric|min:0',
            'kacamata' => 'required|numeric|min:0',
            'foto' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
            'total' => 'required'
        ]);
    
       
       
    
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/medical', $fileName);
    
            // Hapus foto lama jika ada
            if ($medical->foto) {
                Storage::disk('public')->delete('medical/' . $medical->foto);
            }
    
            $medical->update([
                'hrd_id' => $request->hrd_id,
                'patient' => $request->patient,
                'date_claim' => $request->date_claim,
                'date' => $request->date,
                'doctor_fee' => $request->doctor_fee,
                'obat' => $request->obat,
                'kacamata' => $request->kacamata,
                'Total' => $request->total,
                'foto' => $filePath,
            ]);
        } else {
            $medical->update([
                'hrd_id' => $request->hrd_id,
                'patient' => $request->patient,
                'date_claim' => $request->date_claim,
                'date' => $request->date,
                'doctor_fee' => $request->doctor_fee,
                'obat' => $request->obat,
                'kacamata' => $request->kacamata,
                'Total' => $request->total,
            ]);
        }
    
        Alert::success('Success', 'Data berhasil diupdate.')->persistent(true);
    
        return redirect()->route('medical.show', $medical->hrd_id);
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
