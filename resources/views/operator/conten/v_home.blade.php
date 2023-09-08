@extends('operator.layout.main')

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
                <legend class="scheduler-border">Data Pemilihan Umum</legend>
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
                                            <div class="col-5  ">Desa</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $data->desa->title }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">Kecamatan</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $data->desa->kecamatan->title }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">Dapil</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">Ponorogo {{ $data->desa->kecamatan->dapil->title }}</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-5">Jumlah TPS</div>
                                            <div class="col-1">:</div>
                                            <div class="col-4">{{ $data->desa->tps_count }}</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Daftar Menu Entry Data
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-1">
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-3 mx-2 my-2">
                                                <a href="{{ url('capres') }}" type="button"
                                                    class="btn btn-block btn-outline-primary">Presiden</a>
                                            </div>
                                            <div class="col-md-3 mx-2 my-2"><a href="{{ url('pilgub') }}" type="button"
                                                    class="btn btn-block btn-outline-info">Gubernur</a></div>
                                            <div class="col-md-3 mx-2 my-2"><a href="{{ url('pilbub') }}" type="button"
                                                    class="btn btn-block btn-outline-danger">Bupati</a></div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-1">
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-3 mx-2 my-2">
                                                <a href="{{ url('dpd') }}" type="button"
                                                    class="btn btn-block btn-outline-primary">DPD</a>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="list-group-item p-1">
                                        <div class="row mx-auto justify-content-center">
                                            <div class="col-md-3 mx-2 my-2">
                                                <a href="{{ url('caleg') }}" type="button"
                                                    class="btn btn-block btn-outline-danger">DPR RI</a>
                                            </div>
                                            <div class="col-md-3 mx-2 my-2"><a href="{{ url('calegprov') }}" type="button"
                                                    class="btn btn-block btn-outline-info">DPR Provinsi</a></div>
                                            <div class="col-md-3 mx-2 my-2"><a href="{{ url('calegkab') }}" type="button"
                                                    class="btn btn-block btn-outline-primary">DPR Kabupaten</a></div>
                                        </div>
                                    </li>
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
