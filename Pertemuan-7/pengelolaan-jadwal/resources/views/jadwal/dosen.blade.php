@extends('layouts.app')

@section('title', 'Jadwal Dosen')

@section('content')
    <h1>Jadwal Mengajar: {{ $namaDosen }}</h1>

    @if (count($jadwalDosen) === 0)
        <p>Dosen ini belum punya jadwal mengajar.</p>
    @else
        <ul>
            @foreach ($jadwalDosen as $jadwal)
                <li>
                    <a href="{{ route('jadwal.show', $jadwal['id']) }}">{{ $jadwal['matkul'] }}</a>
                    - {{ $jadwal['waktu'] }}, {{ $jadwal['ruang'] }}
                </li>
            @endforeach
        </ul>
    @endif

    <p><a href="{{ route('jadwal.index') }}">Kembali ke daftar</a></p>
@endsection
