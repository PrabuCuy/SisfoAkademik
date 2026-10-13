@extends('layouts.main')

@section('title', 'Tambah Data Kelas')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf

            @foreach (['nama_kelas' => 'Nama Kelas', 'tingkat' => 'Tingkat', 'jurusan' => 'Jurusan', 'tahun_ajaran' => 'Tahun Ajaran'] as $field => $label)
                <div class="mb-3">
                    <label for="{{ $field }}" class="form-label">{{ $label }}</label>
                    <input type="text" name="{{ $field }}" id="{{ $field }}"
                        class="form-control @error($field) is-invalid @enderror"
                        value="{{ old($field) }}">
                    @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection