<?php

namespace App\Http\Controllers;
use App\Models\hrd;
use App\Models\gaji;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
class hrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = hrd::orderBy('name','asc');
           
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('aksi',function($data){
            return view('hrd.tombol')->with('data', $data);
        })
        ->Make(true);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hrd.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NIK' => 'required|numeric|digits:6|unique:hrd',     
            'name' => 'required',     
            'gender' => 'required',
            'joindate' => 'date',
            'location' => 'required',
            'department' => 'required',
            
            'joblevel' => 'required',
            'jobtitle' => 'required',
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Tambahkan validasi untuk field lainnya
        ],
        [
            'NIK.numeric' => 'NIK Harus Angka',
            'NIK.unique' => 'NIK Sudah Digunakan',
            'NIK.required' => 'NIK Harus Di Isi',
            'NIK.digits' => 'NIK Harus Terdiri Dari 6 Karakter',
            'name.required' => 'Nama wajib disii',
            'location.required' => 'lokasi wajib disii',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('fotos', $fileName, 'public');
            $validatedData['foto'] = $fileName;
        }
    
        hrd::create($validatedData);
        Alert::success('Success', 'Data karyawan berhasil ditambah.')->persistent(true);
        return redirect('/datakaryawan')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $datakaryawan = hrd::findOrFail($id);
        return view('hrd.ubah', compact('datakaryawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'NIK' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'joindate' => 'date',
            'location' => 'required',
            'department' => 'required',
            'joblevel' => 'required',
            'jobtitle' => 'required',
            'status' => 'required',
            // Tambahkan validasi untuk field lainnya
        ],[
            'name.required' => 'Nama wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
        ]);
    
        $data = [
            'NIK' => $request->input('NIK'),
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'joindate' => $request->input('joindate'),
            'location' => $request->input('location'),
            'department' => $request->input('department'),
            'joblevel' => $request->input('joblevel'),
            'jobtitle' => $request->input('jobtitle'),
            'status' => $request->input('status'),
            
        ];
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('fotos', $fileName, 'public');
    
            // Hapus foto lama jika ada
            $karyawan = hrd::find($id);
            if ($karyawan->foto) {
                Storage::disk('public')->delete('fotos/' . $karyawan->foto);
            }
    
            // Update nama file foto pada database
            $data['foto'] = $fileName;
        }
        hrd::where('id', $id)->update($data);
        Alert::success('Success', 'Data gaji berhasil diperbarui.')->persistent(true);
        return redirect('/datakaryawan')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      // Menghapus data dari tabel gaji
      $gaji = gaji::where('hrd_id', $id)->delete();

      // Menghapus data dari tabel hrd
      $karyawan = hrd::find($id);
      if ($karyawan) {
          // Hapus foto jika ada
          if ($karyawan->foto) {
              Storage::disk('public')->delete('fotos/' . $karyawan->foto);
          }
          $karyawan->delete();
  
    
          return response()->json(['message' => 'Data berhasil dihapus.']);
      }
  
      return response()->json(['message' => 'Data tidak ditemukan.'], 404);
    }
}
