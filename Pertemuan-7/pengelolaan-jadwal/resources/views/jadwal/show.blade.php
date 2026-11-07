@extends('layouts.app')

@section('title', 'Detail Jadwal')

@section('content')

<div class="page-header">
    <h1>Detail Jadwal Perkuliahan</h1>
    <p>Informasi lengkap mengenai jadwal perkuliahan.</p>
</div>

<div class="panel">

    @if ($jadwal === null)

        <div class="empty">
            <h3>Jadwal Tidak Ditemukan</h3>
            <p>Jadwal dengan ID {{ $id }} tidak tersedia.</p>
        </div>

    @else

        <div class="panel-heading">
            <h2>Informasi Jadwal</h2>

            <span class="badge {{ $jadwal['status'] }}">
                {{ ucfirst($jadwal['status']) }}
            </span>
        </div>

        <div class="table-wrap">
            <table class="detail-table">
                <tbody>
                    <tr>
                        <th>ID Jadwal</th>
                        <td>{{ $jadwal['id'] }}</td>
                    </tr>

                    <tr>
                        <th>Mata Kuliah</th>
                        <td>{{ $jadwal['matkul'] }}</td>
                    </tr>

                    <tr>
                        <th>Dosen</th>
                        <td>
                            <a class="link"
                               href="{{ route('dosen.jadwal', $jadwal['dosen_slug']) }}">
                                {{ $jadwal['dosen'] }}
                            </a>
                        </td>
                    </tr>

                    <tr>
                        <th>Ruang</th>
                        <td>{{ $jadwal['ruang'] }}</td>
                    </tr>

                    <tr>
                        <th>Waktu</th>
                        <td>{{ $jadwal['waktu'] }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge {{ $jadwal['status'] }}">
                                {{ ucfirst($jadwal['status']) }}
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($jadwal['status'] === 'bentrok')
            <div class="alert alert-error" style="margin-top: 20px;">
                Perhatian! Jadwal ini mengalami bentrok dengan jadwal lain.
            </div>
        @endif

    @endif

    <a href="{{ route('jadwal.index') }}" class="btn btn-back">
        Kembali ke Dashboard
    </a>

</div>

@endsection