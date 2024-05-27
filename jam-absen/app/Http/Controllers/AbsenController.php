<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client = new Client();
        $url = "http://localhost:8000/api/absen";
        $response = $client->request('GET', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];

        return view('Absen.index', ['data' => $data]);
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
        $nama = $request->nama;
        $status_waktu = $request->status_waktu;

        $jam_masuk = null;
        $jam_telat = null;

        if ($status_waktu == 'tepat_waktu') {
            $jam_masuk = Carbon::now()->format('H:i:s');
        } elseif ($status_waktu == 'terlambat') {
            $jam_telat = Carbon::now()->format('H:i:s');
        }

        $parameter = [
            'nama' => $nama,
            'jam_masuk' => $jam_masuk,
            'jam_telat' => $jam_telat,
        ];

        $client = new Client();
        $url = "http://localhost:8000/api/absen";
        $response = $client->request('POST', $url, [
            'headers' => ['Content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if ($contentArray['status'] != true) {
            $error = $contentArray['data'];
            return redirect()->to('/')->withErrors($error)->withInput();
        } else {
            return redirect()->to('/')->with('succsess', 'Berhasil menambahkan data');
        }
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
        // $client = new Client();
        // $url = "http://localhost:8000/api/absen/$id";
        // $response = $client->request('GET', $url);
        // $content = $response->getBody()->getContents();
        // $contentArray = json_decode($content, true);
        // if($contentArray['status'] != true){
        //     $error = $contentArray['massage'];
        //     return redirect()->to('/')->withErrors($error);
        // }
        $absen = Absen::find($id);

        if (!$absen) {
            return redirect('/')->withErrors('Data tidak ditemukan');
        }

        return view('Absen.editAbsen', ['absen' => $absen]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $request->validate([
        'nama' => 'required',
        'jam_masuk' => 'nullable|date_format:H:i:s',
        'jam_telat' => 'nullable|date_format:H:i:s',
        'jam_keluar' => 'nullable|date_format:H:i:s',
    ]);

    $absen = Absen::find($id);

    if (!$absen) {
        return redirect('/')->withErrors('Data tidak ditemukan');
    }

    $absen->nama = $request->nama;
    $absen->jam_masuk = $request->jam_masuk;
    $absen->jam_telat = $request->jam_telat;
    $absen->jam_keluar = $request->jam_keluar;

    $absen->save();

    return redirect('/')->with('success', 'Data berhasil diupdate');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $absen = Absen::find($id);

    if (!$absen) {
        // Debugging
        return redirect('/')->withErrors('Data tidak ditemukan dengan ID: ' . $id);
    }

    $absen->delete();

    return redirect('/')->with('success', 'Data berhasil dihapus');
}

    
}

        //  $client = new Client();
        // $url = "http://localhost:8000/api/absen/$id";
        // $response = $client->request('Delete', $url);
        // $content = $response->getBody()->getContents();
        // $contentArray = json_decode($content, true);
        // if ($contentArray['status'] != true) {
        //     $error = $contentArray['data'];
        //     return redirect()->to('/')->withErrors($error)->withInput();
        // } else {
        //     return redirect()->to('/')->with('succsess', 'Berhasil hapus data');
        // }