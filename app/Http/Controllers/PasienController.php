<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\Events\PasienCreated;
use App\Events\StatusUpdated;
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
        $pasien = Pasien::latest()->get();
        $data = [
            'pasien' => $pasien
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
