@extends('layouts.adminty')

@section('title', 'Antrian Obat')

@section('content')

    <div class="container chats">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card card-default">
                    <div class="card-header">Antrian Obat @{{ date }}</div>

                    <div class="card-body">
                        <antrian-list :pasien="pasien"></antrian-list>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
