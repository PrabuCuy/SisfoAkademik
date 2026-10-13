<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
          $kelas = Kelas::withCount('siswas')->get();
        return view('kelas.index', compact('kelas'));
        // TODO: Ambil semua data kelas beserta jumlah siswa (withCount 'siswas') dan tampilkan ke view 'kelas.index'
    }

    public function create()
    {
        return view('kelas.create');
        // TODO: Tampilkan form tambah data kelas di view 'kelas.create'
    }

    public function store(Request $request)
    {
          $validated = $request->validate([
            'nama_kelas'   => 'required|string|max:50',
            'tingkat'      => 'required|string|max:10',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        Kelas::create($validated);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil ditambahkan');
        // TODO: Validasi input (nama_kelas, tingkat, jurusan, tahun_ajaran) lalu simpan data kelas baru
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', ['kelas' => $kelas]);
        // TODO: Tampilkan form edit data kelas di view 'kelas.edit'
    }

    public function update(Request $request, Kelas $kelas)
    {
                $validated = $request->validate([
            'nama_kelas'   => 'required|string|max:50',
            'tingkat'      => 'required|string|max:10',
            'jurusan'      => 'required|string|max:100',
            'tahun_ajaran' => 'required|string|max:20',
        ]);

        $kelas->update($validated);

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil diperbarui');
              // TODO: Validasi input lalu perbarui data kelas
    }
      
    

    public function destroy(Kelas $kelas)
    {
          $kelas->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Data kelas berhasil dihapus');
        // TODO: Hapus data kelas yang dipilih
    }
}

