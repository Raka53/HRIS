<?php

namespace App\Http\Controllers;

use App\Models\kandidat;
use App\Http\Requests\StorekandidatRequest;
use App\Http\Requests\UpdatekandidatRequest;
use App\Models\posisi_kdt;
use App\Models\status_kdt;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
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
            'dokumen' => 'nullable|mimes:pdf|max:3048',
            'pengalaman_terakhir' => 'nullable',
            'posisi_terakhir' => 'nullable',
            'posisi1' => 'required',
            'posisi2' => 'nullable',
            'penampilan' => 'nullable',
            
        ]);


        if ($request->hasFile('dokumen')) {
            $file = $request->file('dokumen');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('dokumenkdt', $fileName, 'public');
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
        return redirect()->route('datakandidat.create')->with('success', 'Data berhasil ditambahkan!');
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
        $data = kandidat::with('posisiKdt')->findOrFail($id);
        return view('kandidat.ubah', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = kandidat::findOrFail($id);

    $request->validate([
        'Tanggal_cv' => 'date',
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'sumber_lamaran' => 'nullable',
        'pengalaman_terakhir' => 'nullable',
        'tempat_lahir' => 'nullable',
        'tanggal_lahir' => 'nullable|date',
        'age' => 'required',
        'status' => 'nullable',
        'phone' => 'required',
        'email' => 'required|email',
        'pendidikan' => 'required',
        'universitas' => 'required',
        'ipk' => 'nullable',
        'posisi_terakhir' => 'nullable',
        'posisi1' => 'required',
        'posisi2' => 'nullable',
        'penampilan' => 'nullable',
        'dokumen' => 'nullable|mimes:pdf|max:3048',
    ]);

    $data->Tanggal_cv = $request->input('Tanggal_cv');
    $data->nama = $request->input('nama');
    $data->jenis_kelamin = $request->input('jenis_kelamin');
    $data->sumber_lamaran = $request->input('sumber_lamaran');
    $data->posisiKdt->pengalaman_terakhir = $request->input('pengalaman_terakhir');
    $data->tempat_lahir = $request->input('tempat_lahir');
    $data->tanggal_lahir = $request->input('tanggal_lahir');
    $data->age = $request->input('age');
    $data->status = $request->input('status');
    $data->phone = $request->input('phone');
    $data->email = $request->input('email');
    $data->pendidikan = $request->input('pendidikan');
    $data->universitas = $request->input('universitas');
    $data->ipk = $request->input('ipk');
    $data->posisiKdt->posisi_terakhir = $request->input('posisi_terakhir');
    $data->posisiKdt->posisi1 = $request->input('posisi1');
    $data->posisiKdt->posisi2 = $request->input('posisi2');
    $data->posisiKdt->penampilan = $request->input('penampilan');

    if ($request->hasFile('dokumen')) {
        $file = $request->file('dokumen');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('dokumenkdt', $fileName, 'public');

        // Hapus dokumen lama jika ada
        if ($data->posisiKdt->dokumen) {
            Storage::disk('public')->delete('dokumenkdt/' . $data->posisiKdt->dokumen);
        }

        // Update nama file dokumen pada database
        $data->posisiKdt->dokumen = $fileName;
    }

    $data->update($request->except(['dokumen']));
    $data->posisiKdt->save();
    Alert::success('Success', 'Data Kandidat berhasil di Update.')->persistent(true);
    return redirect()->route('kandidat.index')->with('refresh', true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kandidat $kandidat)
    {
        //
    }
}
