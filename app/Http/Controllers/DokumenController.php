<?php
namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'biodata_id' => 'required|exists:Biodata_1156,id',
            'nama'       => 'required',
            'file'       => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        $path = $request->file('file')->store('dokumen', 'public');

        Dokumen::create([
            'biodata_id' => $request->biodata_id,
            'nama'       => $request->nama,
            'file'       => $path,
        ]);

        return back()->with('success', 'Dokumen berhasil diupload!');
    }

    public function destroy(Dokumen $dokuman)
    {
        Storage::disk('public')->delete($dokuman->file);
        $dokuman->delete();
        return back()->with('success', 'Dokumen dihapus!');
    }

    public function update(Request $request, Dokumen $dokuman)
    {
        $request->validate([
            'nama' => 'required',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
        ]);

        $data = ['nama' => $request->nama];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dokuman->file);
            $data['file'] = $request->file('file')->store('dokumen', 'public');
        }

        $dokuman->update($data);
        return back()->with('success', 'Dokumen diperbarui!');
    }
}
