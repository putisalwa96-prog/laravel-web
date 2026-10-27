<?php

namespace App\Http\Controllers;

use App\Models\Pengalaman;
use Illuminate\Http\Request;

class PengalamanController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'biodata_id' => 'required|exists:Biodata_1156,id',
            'perusahaan' => 'required',
            'posisi'     => 'required',
            'tahun'      => 'required',
        ]);

        Pengalaman::create($data);
        return back()->with('success', 'Pengalaman ditambahkan!');
    }

    public function update(Request $request, Pengalaman $pengalaman)
    {
        $data = $request->validate([
            'perusahaan' => 'required',
            'posisi'     => 'required',
            'tahun'      => 'required',
        ]);

        $pengalaman->update($data);
        return back()->with('success', 'Pengalaman diperbarui!');
    }

    public function destroy(Pengalaman $pengalaman)
    {
        $pengalaman->delete();
        return back()->with('success', 'Pengalaman dihapus!');
    }
}
