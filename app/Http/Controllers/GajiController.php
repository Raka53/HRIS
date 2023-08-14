<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Hrd;
use App\Models\status_kry;
use App\Models\medical;
use App\Models\sewaKendaraan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\JsonResponse;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        if ($request->ajax()) {
            $latestDataIds = Gaji::groupBy('hrd_id')->selectRaw('MAX(id) as id')->pluck('id'); // Ambil ID terbaru dari setiap entri
        
            $data = Gaji::with(['hrd', 'sewa', 'medical'])
                ->whereIn('id', $latestDataIds) // Filter data berdasarkan ID terbaru
                ->orderBy('updated_at', 'desc')
                ->get();
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
       
        return view('gaji.create');

    }
    public function hrdJson()
    {
        $hrd = Hrd::WheredoesntHave('Gaji')->with('sewa','medical','status_kry')->get(); // Change this to fetch only necessary fields if there are many columns
        return new JsonResponse($hrd);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'hrd_id' => 'required',
            'sewa' => 'required|numeric|min:0',
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'total_medical_claim' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'start_date_medical' => 'required',
            'end_date_medical' => 'required',
        ]);
    
        // Create a new Gaji record with the form data
        $gaji = new Gaji();
        $gaji->salary = $request->salary;
        $gaji->hrd_id = $request->hrd_id;
        $gaji->harga_sewa = $request->sewa;
        $gaji->lembur = $request->lembur;
        $gaji->total_medical_claim = $request->total_medical_claim;
        $gaji->start_date_medical = $request->start_date_medical;
        $gaji->end_date_medical = $request->end_date_medical;
        $gaji->transport = $request->transport;
        $gaji->meals = $request->meals;
        $gaji->total = $request->total;
    
        // Save the Gaji record to the database
        $gaji->save();
    
        // Redirect back to the index page or show a success message
        return redirect()->route('gajiAjax.index')->with('success', 'Gaji successfully added!');
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
        $gaji = Gaji::with('hrd','medical','sewa')->findOrFail($id);
        return view('gaji.edit', compact('gaji'));
    }
    public function hrdJsonEdit($id)
    {
        $hrd = Hrd::with(['sewa', 'medical', 'status_kry'])
            ->where('id', $id)
            ->first();

        return response()->json($hrd);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'sewa' => 'required|numeric|min:0',
            'salary' => 'required|numeric|min:0',
            'lembur' => 'required|numeric|min:0',
            'total_medical_claim' => 'required|numeric|min:0',
            'transport' => 'required|numeric|min:0',
            'meals' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'start_date_medical' => 'required',
            'end_date_medical' => 'required',
        ]);

        $oldGaji = Gaji::findOrFail($id); // Add a semicolon here

        $gaji = $oldGaji->replicate();
        $gaji->salary = $request->input('salary');
        
        $gaji->harga_sewa = $request->input('sewa');
        $gaji->lembur = $request->input('lembur');
        $gaji->total_medical_claim = $request->input('total_medical_claim');
        $gaji->transport = $request->input('transport');
        $gaji->meals = $request->input('meals');
        $gaji->total = $request->input('total');
        $gaji->start_date_medical = $request->input('start_date_medical');
        $gaji->end_date_medical = $request->input('end_date_medical');
        $gaji->save();
    
        Alert::success('Success', 'Data gaji berhasil diperbarui.')->persistent(true);
    
        return redirect()->route('gajiAjax.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      
    }
}
