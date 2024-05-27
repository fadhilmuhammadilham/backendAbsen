<?php

namespace App\Http\Controllers;

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
        }elseif ($status_waktu == 'terlambat') {
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
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
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
    }
}
