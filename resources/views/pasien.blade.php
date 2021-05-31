@extends('layouts.adminty')

@section('title', 'Antrian Obat')

@section('content')

    <div class="container chats">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header">
                        <strong>
                            Antrian Obat
                        </strong>
                        <br>
                        <small> @{{ date }}</small>
                        <a href="{{ route('dashboard') }}" class="btn btn-sm btn-inverse float-right">
                            Dashboard
                        </a>
                        <a href="{{ route('antrian') }}" class="btn btn-sm btn-warning float-right mr-2">
                            Antrian
                        </a>
                    </div>

                    <div class="card-body">
                        <pasien-list :pasien="pasien" :time="time" @statusupdated="updateStatus"></pasien-list>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <pasien-form @pasiencreated="createPasien"></pasien-form>
            </div>
        </div>
    </div>
@endsection
