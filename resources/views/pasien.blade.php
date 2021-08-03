@extends('layouts.adminty')

@section('title', 'Antrian Obat')

@section('content')

    <div class="container chats">
        {{-- <loading v-model:active="isLoading" :can-cancel="false" :on-cancel="" :is-full-page="true" /> --}}

        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header">
                        <strong>
                            Antrian Obat
                        </strong>
                        <br>
                        <small> @{{ date }}</small>
                        <a href="{{ route('dashboard', ['tanggal_awal' => now()->format('Y-m-01'), 'tanggal_akhir' => now()->format('Y-m-t')]) }}"
                            class="btn btn-sm btn-inverse float-right">
                            Dashboard
                        </a>
                        <a href="{{ route('antrian') }}" class="btn btn-sm btn-warning float-right mr-2">
                            Antrian
                        </a>
                        <a href="javascript:void(0);" id="refresh" class="btn btn-sm btn-inverse float-right mr-2 pr-2"
                            data-toggle="tooltip" data-placement="top" title="" data-original-title="Refresh"
                            @click="fetchAntrian">
                            <i class="feather icon-refresh-cw"></i>
                        </a>
                    </div>

                    <div class="card-body">
                        <pasien-list :time="time" :pasien="pasien" url="{{ env('TELEGRAM_START_URL', null) }}"
                            :user="{{ auth()->user() }}" @statusupdated="updateStatus"></pasien-list>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                @if (auth()->user()->is_admin)
                    <pasien-form @pasiencreated="createPasien"></pasien-form>
                @endif
            </div>
        </div>
    </div>
@endsection
