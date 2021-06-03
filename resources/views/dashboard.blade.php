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
                <dashboard :pasien="{{ $pasien }}" :user="{{ auth()->user() }}"></dashboard>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- data-table js -->
    <script src=" https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('#simpletable').DataTable({
            // "order": [
            //     [4, "asc"]
            // ]
        });

    </script>
@endpush
