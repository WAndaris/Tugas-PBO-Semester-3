@extends('layouts.app')

@section('title', $judulHalaman)

@section('content')

<h1>{{ $judulHalaman }}</h1>

@if (count($daftarJadwal) === 0)
    <p>Belum ada jadwal.</p>
@else
    <p>Total {{ count($daftarJadwal) }} jadwal.</p>

    <table>
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Dosen</th>
                <th>Ruang</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($daftarJadwal as $jadwal)
                <tr>
                    <td>
                        <a href="{{ route('jadwal.show', $jadwal['id']) }}">
                            {{ $jadwal['matkul'] }}
                        </a>
                    </td>

                    <td>
                        <a href="{{ route('dosen.jadwal', $jadwal['dosen_slug']) }}">
                            {{ $jadwal['dosen'] }}
                        </a>
                    </td>

                    <td>{{ $jadwal['ruang'] }}</td>
                    <td>{{ $jadwal['waktu'] }}</td>

                    <td class="{{ $jadwal['status'] }}">
                        {{ ucfirst($jadwal['status']) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection