<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiAbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Absen::all();
        return response()->json([
            'status' => true,
            'message' => 'Berhasil Mengambil Data',
            'data' => $data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        $dataAbsen = new Absen;
        $rules = [
            'nama' => 'required',
            'jam_masuk' => 'nullable|date_format:H:i:s',
            'jam_telat' => 'nullable|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'massage' => 'Gagal memasukan data',
                'data' => $validator->errors(),
            ]);
        }
        $dataAbsen->nama = $request->nama;
        $dataAbsen->jam_masuk = $request->jam_masuk;
        $dataAbsen->jam_telat = $request->jam_telat;
        $dataAbsen->jam_keluar = $request->jam_keluar;
    
        $post = $dataAbsen->save();

        return response()->json([
            'status' => true,
            'massage' => 'berhasil menambahkan data baru',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataAbsen = Absen::find($id);
        if (empty($dataAbsen)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak di temukan',
            ], 404);
        }

        $rules = [
            'nama' => 'required',
            'jam_masuk' => 'nullable|date_format:H:i:s',
            'jam_telat' => 'nullable|date_format:H:i:s',
            'jam_keluar' => 'nullable|date_format:H:i:s',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'massage' => 'Gagal update data',
                'data' => $validator->errors(),
            ]);
        }
        $dataAbsen->nama = $request->nama;
        $dataAbsen->jam_masuk = $request->jam_masuk;
        $dataAbsen->jam_telat = $request->jam_telat;
        $dataAbsen->jam_keluar = $request->jam_keluar;
    
        $post = $dataAbsen->save();

        return response()->json([
            'status' => true,
            'massage' => 'berhasil update data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataAbsen = Absen::find($id);
        if (empty($dataAbsen)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak di temukan',
            ], 404);
        }
    
        $post = $dataAbsen->delete();

        return response()->json([
            'status' => true,
            'massage' => 'berhasil delete data',
        ]);
    }
}
