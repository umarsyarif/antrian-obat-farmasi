<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Events\PasienCreated;
use App\Events\StatusUpdated;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function page()
    {
        return view('pasien');
    }

    public function antrian()
    {
        return view('antrian');
    }

    public function index(Request $request)
    {
        $jenis_obat = $request->jenis_obat;
        $jenis_pasien = $request->jenis_pasien;
        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;

        $pasien = Pasien::latest()
            ->when($tanggal_awal & $tanggal_akhir, function ($q) use ($tanggal_awal, $tanggal_akhir) {
                $q->whereBetween('created_at', [$tanggal_awal, Carbon::parse($tanggal_akhir)->addDay()]);
            })
            ->when($jenis_obat, function ($q) use ($jenis_obat) {
                $q->where('jenis_obat', $jenis_obat);
            })
            ->when($jenis_pasien, function ($q) use ($jenis_pasien) {
                $q->where('jenis_pasien', $jenis_pasien);
            })->get();

        $data = [
            'pasien' => $pasien,
            'filter' => [
                'jenis_obat' => $request->jenis_obat,
                'jenis_pasien' => $request->jenis_pasien,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir
            ]
        ];
        return view('dashboard', $data);
    }

    public function fetchAntrian(Request $request)
    {
        $today = $request->date ?? today();
        return Pasien::whereDate('created_at', $today)->latest()->get();
    }

    public function store(Request $request)
    {
        $pasien = Pasien::create($request->all());

        broadcast(new PasienCreated($pasien));

        return ['status' => 'Pasien Created!'];
    }

    public function update(Request $request, Pasien $pasien)
    {
        $pasien->update(['status' => $request->status]);

        broadcast(new StatusUpdated($pasien));

        return ['status' => 'Status Updated!'];
    }
}
