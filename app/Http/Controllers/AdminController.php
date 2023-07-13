<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with('roles')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    return $row->roles->pluck('name')->implode(', ');
                })
                ->addColumn('aksi',function($data){
                    return view('admin.tombol')->with('data', $data);
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user){
            $user->delete();
        }

    return response()->json(['success' => true]);
    }
}
