@extends('admin.layout.main')

@section('title', 'Calon Bupati ')
@push('mycss')
    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow: 0px 0px 0px 0px #000;
            box-shadow: 0px 0px 0px 0px #000;
            border: 1px solid darkgray !important;
            border-radius: 5px;
        }

        legend.scheduler-border {
            font-size: 1em !important;
            font-weight: bold !important;
            text-align: center !important;
            width: auto;
            padding: 0 10px;
            border-bottom: none;
            margin-bottom: 5px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
@endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <section class="content">
        <div class="container-fluid">

            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Data Pemilihan Umum Kabupaten Ponorogo</legend>
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Data Wilayah
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">Jumlah Dapil</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $dapil }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">Jumlah Kecamatan</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $kecamatan }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">Jumlah Desa</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $desa }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-6">Jumlah TPS</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $tps }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Jumlah Kecamatan Per Dapil
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @foreach ($detail_dapil as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">Dapil Ponorogo {{ $item->title }}</div>
                                                <div class="col-1">:</div>
                                                <div class="col-4">{{ $item->kecamatan_count }} </div>
                                            </div>
                                        </li>
                                    @endforeach


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Jumlah Desa Per Dapil
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    @foreach ($detail_dapil as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-6">Dapil Ponorogo {{ $item->title }}</div>
                                                <div class="col-1">:</div>
                                                <div class="col-4">{{ $item->desa_count }} </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>

    </section>
@endsection
@push('java')
@endpush
