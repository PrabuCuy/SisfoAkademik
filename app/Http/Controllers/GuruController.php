<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GuruController extends Controller
{
    public function index()
    {
         $gurus = Guru::all();
        return view('guru.index', compact('gurus'));
        // TODO: Ambil semua data guru dan tampilkan ke view 'guru.index'
    }

    public function create()
    {
        return view('guru.create');
        // TODO: Tampilkan form tambah data guru di view 'guru.create'
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
    'nip'           => ['required', 'string', 'max:20', Rule::unique(Guru::class, 'nip')],
    'nama'  => 'required|string|max:100',
    'jenis_kelamin' => 'required|in:L,P',
    'email'         => 'required|email|max:100',
    'no_hp'         => 'required|numeric|digits_between:10,15',
    'alamat'        => 'required|string',
], [
    'nip.required' => 'NIP wajib diisi.',
    'nip.unique'   => 'NIP sudah terdaftar.',
    'email.email'  => 'Format email tidak valid.',
    'no_hp.numeric' => 'No HP harus berupa angka.',
]);

        Guru::create($validated);

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil ditambahkan');
        // TODO: Validasi input (nip, nama, jenis_kelamin, email, no_hp, alamat) lalu simpan data guru baru
    }

    public function edit(Guru $guru)
    {
         return view('guru.edit', compact('guru'));
        // TODO: Tampilkan form edit data guru di view 'guru.edit'
    }

    public function update(Request $request, Guru $guru)
{
    $validated = $request->validate([
        'nip' => ['required', 'string', 'max:20', Rule::unique(Guru::class, 'nip')->ignore($guru->id)],
        'nama' => 'required|string|max:100',
        'jenis_kelamin' => 'required|in:L,P',
        'email' => 'required|email|max:100',
        'no_hp' => 'required|numeric|digits_between:10,15',
        'alamat' => 'required|string',
    ]);

    $guru->update($validated);

    return redirect()->route('guru.index')
        ->with('success', 'Data guru berhasil diperbarui');
          // TODO: Validasi input lalu perbarui data guru   
}
      

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return redirect()->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus');
        // TODO: Hapus data guru yang dipilih
    }
}

