@extends('layouts.adminty')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header">
                        History Antrian Obat
                    </div>

                    <div class="card-block">
                        <div class="dt-responsive table-responsive">
                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Pasien</th>
                                        <th>Jenis Obat</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pasien as $row)
                                        <tr>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->jenis_pasien }}</td>
                                            <td>{{ $row->jenis_obat }}</td>
                                            <td>{{ $row->created_at->format('d F Y') }}</td>
                                            <td>{{ $row->created_at->format('H:i:s') }}</td>
                                            <td>{{ date('H:i:s', strtotime($row->waktu_selesai)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Jenis Pasien</th>
                                        <th>Jenis Obat</th>
                                        <th>Tanggal</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
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
    <script src="{{ asset('adminty\files\bower_components\datatables.net\js\jquery.dataTables.min.js') }}"></script>
    <script>
        $('#simpletable').DataTable();

    </script>
@endpush
