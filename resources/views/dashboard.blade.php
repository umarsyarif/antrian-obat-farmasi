@extends('layouts.adminty')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header">
                        <h6 class="text-muted"><i class="feather icon-filter"></i> Filter</h6>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">

                                <li><i class="feather minimize-card icon-minus"></i></li>

                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="">
                            <div class="row">
                                <div class="col-6">
                                    <div class="col-12 form-group row px-0">
                                        <label class="col-sm-5 col-form-label">Jenis Obat :</label>
                                        <div class="col-sm-7">
                                            <select name="jenis_obat" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="Racikan"
                                                    {{ $filter['jenis_obat'] == 'Racikan' ? 'selected' : '' }}>
                                                    Racikan
                                                </option>
                                                <option value="Non-Racikan"
                                                    {{ $filter['jenis_obat'] == 'Non-Racikan' ? 'selected' : '' }}>
                                                    Non-Racikan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group row px-0">
                                        <label class="col-sm-5 col-form-label">Jenis Pasien :</label>
                                        <div class="col-sm-7">
                                            <select name="jenis_pasien" class="form-control">
                                                <option value="">Semua</option>
                                                <option value="BPJS"
                                                    {{ $filter['jenis_pasien'] == 'BPJS' ? 'selected' : '' }}>
                                                    BPJS
                                                </option>
                                                <option value="Umum"
                                                    {{ $filter['jenis_pasien'] == 'Umum' ? 'selected' : '' }}>
                                                    Umum
                                                </option>
                                                <option value="Perusahaan"
                                                    {{ $filter['jenis_pasien'] == 'Perusahaan' ? 'selected' : '' }}>
                                                    Perusahaan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="col-12 form-group row px-0">
                                        <label class="col-sm-5 col-form-label">Awal :</label>
                                        <div class="col-sm-7">
                                            <input type="date" name="tanggal_awal" class="form-control"
                                                value="{{ $filter['tanggal_awal'] }}" />
                                        </div>
                                    </div>
                                    <div class="col-12 form-group row px-0">
                                        <label class="col-sm-5 col-form-label">Akhir :</label>
                                        <div class="col-sm-7">
                                            <input type="date" name="tanggal_akhir" class="form-control"
                                                value="{{ $filter['tanggal_akhir'] }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-primary float-right mr-2">Filter</button>
                        </form>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <h5>
                            History Antrian Obat
                        </h5>
                        <a href="javascript:void(0)" class="btn btn-sm btn-warning float-right">
                            <i class="feather icon-printer"></i> Print
                        </a>
                    </div>
                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Jenis Pasien</th>
                                        <th>Jenis Obat</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Terlambat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $orang_telat = 0; ?>
                                    @foreach ($pasien as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->jenis_pasien }}</td>
                                            <td>{{ $row->jenis_obat }}</td>
                                            <td>{{ $row->created_at->format('d F Y') }}</td>
                                            <td>{{ $mulai = $row->created_at->format('H:i:s') }}</td>
                                            <td>
                                                {{ $row->waktu_selesai ? ($selesai = date('H:i:s', strtotime($row->waktu_selesai))) : '-' }}
                                            </td>
                                            <?php
                                            $diff = $row->waktu_selesai ?
                                            Carbon\Carbon::parse($mulai)->diffInSeconds($selesai) : 0;
                                            $diff > 3600 ? $orang_telat++ : '';
                                            ?>
                                            <td>
                                                {{ $row->waktu_selesai ? ($diff > 3600 ? gmdate('H:i:s', $diff - 3600) : '-') : '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="7">Terlambat</th>
                                        <th>{{ $orang_telat }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#simpletable').DataTable({
            // "order": [
            //     [4, "asc"]
            // ]
        });

    </script>
@endpush
