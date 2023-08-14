<?php

namespace App\Http\Controllers;

use App\Models\kandidat;
use App\Http\Requests\StorekandidatRequest;
use App\Http\Requests\UpdatekandidatRequest;
use App\Models\posisi_kdt;
use App\Models\status_kdt;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kandidat.index');
    }
    public function status()
    {
        return view('kandidat.status');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posisi = posisi_kdt::all();
        return view('kandidat.create',compact('posisi'));
    }


    public function createStatus()
    {
        return view('kandidat.statusCreate');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
                 
            'nama' => 'required',     
            'Tanggal_cv' => 'date',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'age' => 'required',
            'status' => 'nullable',
            'phone' => 'required',
            'email' => 'required',
            'pendidikan' => 'required',
            'universitas' => 'required',
            'ipk' => 'nullable',
            'sumber_lamaran' => 'nullable',
            
            // Tambahkan validasi untuk field lainnya
        ],
        [
            
            
            'nama.required' => 'Nama wajib disii',
            
        ]);

        $validatePosisi = $request->validate([
            'dokumen' => 'nullable|image|mimes:jpeg,png,jpg,gif,pdf|max:3048',
            'pengalaman_terakhir' => 'nullable',
            'posisi_terakhir' => 'nullable',
            'posisi1' => 'required',
            'posisi2' => 'nullable',
            'penampilan' => 'nullable',
        ]);


        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('fotos', $fileName, 'public');
            $validatePosisi['dokumen'] = $fileName;
        }

        $kandidat = kandidat::create($validatedData);

        $posisikdt = posisi_kdt::create([
            'kandidat_id' => $kandidat->id,
            'pengalaman_terakhir' => $validatePosisi['pengalaman_terakhir'],
            'posisi_terakhir' => $validatePosisi['posisi_terakhir'],
            'posisi1' => $validatePosisi['posisi1'],
            'posisi2' => $validatePosisi['posisi2'],
            'dokumen' => $validatePosisi['dokumen'],
            'penampilan' => $validatePosisi['penampilan'],
        ]);
        
        Alert::success('Success', 'Data Kandidat berhasil ditambah.')->persistent(true);
        return redirect('/kandidat')->with('success', 'Data berhasil ditambahkan!');
    }
    public function storeStatus(Request $request){

        $validatedData = $request->validate([
            'kandidat_id' => 'required',
            'interview_user' => 'required|in:Belum,Yes,No',
            'interview_MR' => 'required|in:Belum,Yes,No',
            'interview_FG' => 'required|in:Belum,Yes,No',
            'posisi_usulan' => 'required',
            'status_hasil' => 'required|in:Belum,Drop,Terima',
        ]);
    
        // Simpan data ke dalam database
        $status = new status_kdt();
        $status->kandidat_id = $validatedData['kandidat_id'];
        $status->interview_user = $validatedData['interview_user'];
        $status->interview_MR = $validatedData['interview_MR'];
        $status->interview_FG = $validatedData['interview_FG'];
        $status->posisi_usulan = $validatedData['posisi_usulan'];
        $status->status_hasil = $validatedData['status_hasil'];
        $status->save();
        Alert::success('Success', 'Data Status berhasil ditambah.')->persistent(true);
        return redirect()->route('statuskandidat.status')->with('success', 'Data status berhasil ditambahkan.');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(kandidat $kandidat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = kandidat::findOrFail($id);
        return view('kandidat.ubah', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekandidatRequest $request, kandidat $kandidat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kandidat $kandidat)
    {
        //
    }
}
