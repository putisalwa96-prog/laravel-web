<?php
namespace App\Http\Controllers;

use App\Models\Biodata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function index()
    {
        $biodata = Biodata::all();
        return view('biodata.index', compact('biodata'));
    }

    public function create()
    {
        return view('biodata.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'profesi'    => 'required',
            'email'      => 'required|email',
            'telepon'    => 'required',
            'alamat'     => 'required',
            'tentang'    => 'required',
            'pendidikan' => 'required',
            'skill'      => 'required',
            'foto'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        Biodata::create($data);
        return redirect()->route('biodata.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(Biodata $biodata)
    {
        return view('biodata.show', compact('biodata'));
    }

    public function edit(Biodata $biodata)
    {
        return view('biodata.form', compact('biodata'));
    }

    public function update(Request $request, Biodata $biodata)
    {
        $data = $request->validate([
            'nama'       => 'required',
            'profesi'    => 'required',
            'email'      => 'required|email',
            'telepon'    => 'required',
            'alamat'     => 'required',
            'tentang'    => 'required',
            'pendidikan' => 'required',
            'skill'      => 'required',
            'foto'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($biodata->foto) {
                Storage::disk('public')->delete($biodata->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto', 'public');
        }

        $biodata->update($data);
        return redirect()->route('biodata.index')->with('success', 'Perubahan data berhasil!');
    }

    public function destroy(Biodata $biodata)
    {
        if ($biodata->foto) {
            Storage::disk('public')->delete($biodata->foto);
        }
        $biodata->delete();
        return redirect()->route('biodata.index')->with('success', 'Data berhasil dihapus!');
    }

    public function updateFoto(Request $request, Biodata $biodata)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
        ]);

        if ($biodata->foto) {
            Storage::disk('public')->delete($biodata->foto);
        }

        $biodata->update([
            'foto' => $request->file('foto')->store('foto', 'public'),
        ]);

        return back()->with('success', 'Foto profil berhasil diganti!');
    }
}
