<?php

namespace App\Http\Controllers;

use App\Exports\ExportGaji;
use App\Models\Hrd;
use App\Models\Gaji;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat\Wizard\Currency;
use RealRashid\SweetAlert\Facades\Alert;

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

                    $btn = '<a href="' . $editUrl . '" class="btn btn-primary btn-sm">Update</a>';
                    return $btn;
                })

                ->rawColumns(['action'])
                ->make(true);
        }

        return view('gaji.index');
    }
    public function exportExcel()
    {
        return Excel::download(new ExportGaji, "gaji.xlsx");
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
        $hrd = Hrd::WheredoesntHave('Gaji')->with('sewa','medical')->get(); // Change this to fetch only necessary fields if there are many columns
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
            'total' => 'required',
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

        Alert::success('Success', 'Data Gaji berhasil ditambah.')->persistent(true);
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
        $hrd = Hrd::with(['sewa', 'medical'])
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

        $gaji = new Gaji(); // Add a semicolon here


        $gaji->salary = $request->input('salary');
        $gaji->hrd_id = $request->input('hrd_id');
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
    public function cari(Request $request)
        {
            return view('gaji.cari');
        }

        public function detailCari($id)
        {
            $gaji = Hrd::with('gaji')->findOrFail($id);
            return view('gaji.showGaji', compact('gaji'));
        }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
