@extends('operator.layout.main')

@section('title', 'Calon Presiden')
@push('mycss')
    <style>
        .nomer_capres {
            border: solid darkgrey 2px;
        }

        .card_capres {
            /* width: 20rem; */
            /* height: 26rem; */
            border: solid darkgrey 1px
        }

        .card_capres img {
            border-bottom: solid darkgrey 1px;
            height: 200px;
            background-size: cover;
        }

        .card-body {
            padding-top: 0;

        }

        .card-body span {
            font-size: 12px;
            color: black;
        }

        .card-body p {
            color: black;
            font-size: 14px;
            font-weight: 500;
        }

        .suara {
            width: 140px;
            height: 60px;
            border: solid 1px;
            font-size: 50px;
            font-weight: 900;
            color: black;
            margin-top: 20px;
        }

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
                <legend class="scheduler-border">Perolehan Suara Sah Calon Presiden dan Wakil Presiden</legend>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control select2">
                                <option selected="selected">Pilih TPS</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($capres as $capres)
                        <div class="col-md-4">
                            <div class="card card_capres">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-center py-0 my-0 d-flex justify-content-center back">
                                        <h1 class="font-weight-bold rounded-circle px-1 my-2 nomer_capres">
                                            0{{ $capres->no_urut }}
                                        </h1>
                                    </li>
                                </ul>
                                <img src="{{ asset('foto/' . $capres->no_urut . '.jpeg') }}" class="card-img-top "
                                    alt="...">
                                <div class="card-body justify-content-center">
                                    <div class="row ">
                                        <div class="col-6 text-center">
                                            <span>Calon Presiden</span>
                                            <p class="card-text">{{ $capres->nama_capres }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <span>Calon Wakil Presiden</span>
                                            <p class="card-text">{{ $capres->nama_cawapres }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" placeholder="0" onfocus="this.placeholder = ''"
                                                onblur="this.placeholder = '0'"
                                                value="{{ $capres->suarawapres->jumlah ?? 0 }}"
                                                class="form-control text-center mx-auto suara">

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </fieldset>

    </section>
@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endpush
