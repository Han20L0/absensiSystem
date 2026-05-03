@extends('layouts.main')

@section('content')
<div class="container my-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h4 class="card-title">
                        Daftar Absen Kegiatan
                    </h4>
                </div>
                <div class="col text-end">
                    <button type="button" onclick="copyLink()" class="btn btn-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clipboard-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10 1.5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5zm-5 0A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm-2 0h1v1A2.5 2.5 0 0 0 6.5 5h3A2.5 2.5 0 0 0 12 2.5v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2" />
                        </svg>
                        Copy Link
                    </button>
                    <a href="#" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-filetype-pdf" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zM1.6 11.85H0v3.999h.791v-1.342h.803q.43 0 .732-.173.305-.175.463-.474a1.4 1.4 0 0 0 .161-.677q0-.375-.158-.677a1.2 1.2 0 0 0-.46-.477q-.3-.18-.732-.179m.545 1.333a.8.8 0 0 1-.085.38.57.57 0 0 1-.238.241.8.8 0 0 1-.375.082H.788V12.48h.66q.327 0 .512.181.185.183.185.522m1.217-1.333v3.999h1.46q.602 0 .998-.237a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.589-.68q-.396-.234-1.005-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082h-.563zm3.743 1.763v1.591h-.79V11.85h2.548v.653H7.896v1.117h1.606v.638z" />
                        </svg>
                        Eksport ke PDF
                    </a>
                    <a href="#" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-file-spreadsheet" viewBox="0 0 16 16">
                            <path
                                d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v4h10V2a1 1 0 0 0-1-1zm9 6h-3v2h3zm0 3h-3v2h3zm0 3h-3v2h2a1 1 0 0 0 1-1zm-4 2v-2H6v2zm-4 0v-2H3v1a1 1 0 0 0 1 1zm-2-3h2v-2H3zm0-3h2V7H3zm3-2v2h3V7zm3 3H6v2h3z" />
                        </svg>
                        Eksport ke Excel
                    </a>
                    <a href="{{ route('presence.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <td width="150px">Nama Kegiatan</td>
                    <td width="20px">:</td>
                    <td>{{ $presence->nama_kegiatan }}</td>
                </tr>
                <tr>
                    <td>Tanggal Kegiatan</td>
                    <td>:</td>
                    <td>{{ date('d F Y', strtotime($presence->tgl_kegiatan)) }}</td>
                </tr>
                <tr>
                    <td>Waktu Mulai</td>
                    <td>:</td>
                    <td>{{ date('H:i', strtotime($presence->tgl_kegiatan)) }}</td>
                </tr>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Lengkap</th>
                        <th>NIP/NIK</th>
                        <th>No.HP/WA</th>
                        <th>Instansi/Unit Kerja</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Tanda Tangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($presenceDetails->isEmpty())
                    <tr>
                        <td colspan="9" class="text-center">Tidak ada data Peserta.</td>
                    </tr>
                    @endif
                    @foreach ($presenceDetails as $detail)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $detail->nama}}</td>
                        <td>{{ $detail->nip}}</td>
                        <td>{{ $detail->no_hp}}</td>
                        <td>{{ $detail->asal_instansi}}</td>
                        <td>{{ $detail->jabatan}}</td>
                        <td>{{ $detail->email}}</td>
                        <td>
                            @if ($detail->tanda_tangan)
                            <img src="{{ asset('uploads/' . $detail->tanda_tangan) }}" alt="Tanda Tangan"
                                style="max-width: 100px; max-height: 100px;">
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('presence-detail.destroy', $detail->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    function copyLink(){
            navigator.clipboard.writeText("{{ route('absen.index', $presence->slug) }}");
            alert('Link berhasil disalin ke clipboard!');
        }
</script>
@endpush