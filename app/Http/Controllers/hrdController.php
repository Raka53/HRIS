<?php

namespace App\Http\Controllers;

use App\Models\hrd;
use App\Models\gaji;
use App\Models\medical;
use Illuminate\Http\Request;
use App\Models\sewaKendaraan;
use App\Exports\ExportKaryawan;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class hrdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('hrd.index');
    }
    public function exportExcel()
    {
        return Excel::download(new ExportKaryawan, "datakaryawan.xlsx");
    }
  
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = hrd::all();
        return view('hrd.form', compact('status'));
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
            'statusKry' => 'required',
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
            'statusKry' => 'required',
            // Tambahkan validasi untuk field lainnya
        ],[
            'name.required' => 'Nama wajib diisi',
            'location.required' => 'Lokasi wajib diisi',
        ]);
    
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
            $validatedData['foto'] = $fileName;
        }
    
        hrd::find($id)->update($validatedData);
        Alert::success('Success', 'Data Karyawan berhasil diperbarui.')->persistent(true);
        return redirect('datakaryawanAjax');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      // Menghapus data dari tabel gaji
      $gaji = gaji::where('hrd_id', $id)->delete();
      $sewa = sewaKendaraan::where('hrd_id', $id)->delete();
      $medical = medical::where('hrd_id', $id)->delete();

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
    //restore data yang di hapus
    public function restoreHrdData($id)
        {
            $hrd = hrd::onlyTrashed()->findOrFail($id);

            // Mengembalikan data yang telah dihapus
            $hrd->restore();

            // Redirect atau berikan respons sesuai kebutuhan Anda
            return redirect()->route('hrd.index')->with('success', 'Data berhasil dikembalikan!');
        }

        public function showDeletedData()
        {
            $deletedHrds = hrd::onlyTrashed()->get();
            return view('hrd.restore', compact('deletedHrds'));
        }
}
