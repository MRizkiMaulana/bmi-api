<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bmi;

class BmiController extends Controller
{
    public function masukdata(Request $request)
    {
        $request->validate([
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
        ]);

        $tinggi_badan = $request->input('tinggi_badan');
        $berat_badan = $request->input('berat_badan');
        $tinggi_meter = $tinggi_badan / 100;
        $hasil_bmi = $berat_badan / ($tinggi_meter * $tinggi_meter);

        $index_bmi = '';
        if ($hasil_bmi >= 18.5 && $hasil_bmi <= 25) {
            $index_bmi = 'Normal';
        } elseif ($hasil_bmi > 25 && $hasil_bmi <= 27) {
            $index_bmi = 'Gemuk';
        } else {
            $index_bmi = 'Obesitas';
        }

        $bmi = new Bmi();
        $bmi->tinggi_badan = $tinggi_badan;
        $bmi->berat_badan = $berat_badan;
        $bmi->hasil_bmi = $hasil_bmi;
        $bmi->index_bmi = $index_bmi;
        $bmi->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditambahkan',
            'data' => ['bmiId' => $bmi->id],
        ], 201);
    }

    public function liatdata()
    {
        $bmiData = Bmi::all();

        return response()->json([
            'status' => 'success',
            'data' => ['bmi' => $bmiData],
        ]);
    }

    public function lihatdataid($bmiId)
    {
        $bmi = Bmi::find($bmiId);

        if (!$bmi) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => ['bmi' => $bmi],
        ]);
    }

    public function update(Request $request, $bmiId)
    {
        $bmi = Bmi::find($bmiId);

        if (!$bmi) {
            return response()->json([
                'status' => 'fail',
                'message' => 'Gagal memperbarui data. Id tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'tinggi_badan' => 'required|numeric',
            'berat_badan' => 'required|numeric',
        ]);

        $tinggi_badan = $request->input('tinggi_badan');
        $berat_badan = $request->input('berat_badan');
        $tinggi_meter = $tinggi_badan / 100;
        $hasil_bmi = $berat_badan / ($tinggi_meter * $tinggi_meter);

        $index_bmi = '';
        if ($hasil_bmi >= 18.5 && $hasil_bmi <= 25) {
            $index_bmi = 'Normal';
        } elseif ($hasil_bmi > 25 && $hasil_bmi <= 27) {
            $index_bmi = 'Gemuk';
        } else {
            $index_bmi = 'Obesitas';
        }

        $bmi->tinggi_badan = $tinggi_badan;
        $bmi->berat_badan = $berat_badan;
        $bmi->hasil_bmi = $hasil_bmi;
        $bmi->index_bmi = $index_bmi;
        $bmi->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil diperbarui',
        ]);
    }
}

