@extends('operator.layout.main')

@section('title', 'Calon DPR RI')
@push('mycss')
    <style>
        input.salah {
            border: solid red 2px;
        }

        .nomer_suara {
            border-right: solid darkgrey 1px;
            font-size: 18px;
            font-weight: 600;
            padding: 4px;
        }

        .nama_partai {
            font-size: 16px;
            font-weight: 600;
            padding: 4px;
        }

        .card_suara {
            /* width: 20rem; */
            /* height: 26rem; */
            border: solid darkgrey 1px
        }

        .card_suara img {
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
            /* margin-top: 20px; */
        }

        .loadingsuara {}

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

        li {
            list-style: none;
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
                <legend class="scheduler-border">Perolehan Suara Sah Calon DPR Provinsi</legend>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select id="tps" class="form-control select2">
                                @if ($pilih_tps->id ?? 0 != null)
                                    <option selected> {{ 'TPS ' . $pilih_tps->title ?? 'Pilih TPS' }}</option>
                                @else
                                    <option selected>Pilih TPS</option>
                                @endif
                                @foreach ($tps as $tps)
                                    <option value="{{ $tps->id }}">TPS
                                        {{ $tps->title }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    @if ($pilih_tps->id ?? 0 != null)
                        <div class="col-md-9 d-flex d-md-block justify-content-center">
                            <div class="input-group input-group-sm float-md-right" style="width: 200px;">
                                <input type="text" id="myInput" onkeyup="myFunction()" class="form-control float-right"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <svg height="1em" viewBox="0 0 512 512">
                                            <path
                                                d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z" />
                                        </svg> </button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row ">
                    <div class="text-center mx-auto col-12 mb-3" style="font-weight: 700;font-size: 2em">
                        @if ($pilih_tps->id ?? 0 != null)
                            Nomer TPS :
                            {{ sprintf('%02d', $pilih_tps->title) }}
                        @endif
                    </div>

                    @foreach ($partai as $partai)
                        <span></span>
                        <div class="col-md-4 data">
                            <a hidden>
                                {{ sprintf('%02d', $partai->no_urut) }}
                                {{ $partai->nama }}
                                {{ $partai->singkatan }}
                            </a>
                            <div class="card card_suara">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0 my-0 d-flex justify-content-start ">

                                        <div class="d-flex align-items-center nomer_suara">
                                            {{ sprintf('%02d', $partai->no_urut) }}
                                        </div>
                                        <div class="d-flex align-items-center nama_partai">
                                            {{ $partai->nama }}
                                        </div>
                                    </li>

                                </ul>
                                <div class="card-body px-2">
                                    @foreach ($partai->caleg as $caleg)
                                        <div class="row border">
                                            <div class="d-flex align-items-center px-2 col-1">
                                                <span class="mx-auto py-1"> {{ $caleg->no_urut }}. </span>
                                            </div>
                                            <div class="d-flex align-items-center col-8">
                                                <span>{{ $caleg->nama ?? 0 }}</span>
                                            </div>
                                            @if ($pilih_tps->id ?? 0 != null)
                                                <div class="d-flex align-items-center float-right col-3">
                                                    <input type="number" min="0"
                                                        onKeyPress="if(this.value.length==3) return false;"
                                                        oninput="this.value = Math.abs(this.value)" autocomplete="off"
                                                        id="{{ $caleg->id }}" data-id="{{ $caleg->id }}"
                                                        data-partai="{{ $partai->id }}" onfocus="this.placeholder = ''"
                                                        onblur="this.placeholder = '0'"
                                                        value="{{ $caleg->suaracalegprov[0]->jumlah ?? 0 }}"
                                                        class="form-control text-center submit p-0 mr-1 font-weight-bold"
                                                        style="height: 20px;font-size: 13px;">
                                                    <div class="loadingsuara" id="save{{ $caleg->id }}">
                                                        <svg viewBox="0 0 110 110" width="10" height="10"></svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
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
    <script type="text/javascript">
        var status;
        var Interval;
        var caleg_id;
        var tps_id;
        var jumlah_suara;

        function myFunction() {
            var input, filter, data, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            data = document.getElementsByClassName("data");
            for (i = 0; i < data.length; i++) {
                a = data[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    data[i].style.display = "";
                } else {
                    data[i].style.display = "none";
                }
            }
        }
        $(document).ready(function() {
            $(document).on('focus', '.submit', function(e) {
                e.preventDefault();
                status = '';
            });
            $(document).on('click', '.submit', function(e) {
                e.preventDefault();
                status = '';
            });
            $('.submit').keyup(function(e) {
                if (e.keyCode != 9) {
                    input_id = $(this).data('id');
                    tps_id = "{{ $pilih_tps->id ?? 0 }}";
                    jumlah_suara = $(this).val();
                    partai_id = $(this).data('partai');
                    caleg_id = $(this).data('id');
                    $('#save' + caleg_id).html(`   `);
                    clearTimeout(Interval);
                    Interval = setTimeout(saveSuara, 1000);
                }
            });
            $('.submit').blur(function() {
                var input_id = $(this).data('id');
                var partai_id = $(this).data('partai');
                var tps_id = "{{ $pilih_tps->id ?? 0 }}";
                var jumlah_suara = $(this).val();
                var fd = new FormData();
                fd.append(input_id, jumlah_suara);
                fd.append('partai_id', partai_id);
                fd.append('caleg_id', input_id);
                fd.append('tps_id', tps_id);
                fd.append('jumlah_suara', jumlah_suara);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('savesuara/calegprov') }}",
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        $('#save' + data.caleg_id).html(`
                            <svg viewBox="0 0 110 110" width="10" height="10">
                                <path d="M0 64.37a9.67 9.67 0 0 1 2.94-4.67 8 8 0 0 1 9.2-.66 57.21 57.21 0 0 1 13.8 11 114.1 114.1 0 0 1 13.18 16.73c.17.26.36.5.56.77 1.83-3.43 3.54-6.85 5.44-10.17C56 58.23 70 41.83 88.16 29.21a125.64 125.64 0 0 1 28.44-14.62c5.76-2.12 11.08 1.82 11.22 6.91a1.32 1.32 0 0 0 .18.43v.24c-.11.49-.2 1-.32 1.47a7.91 7.91 0 0 1-5.35 5.95 105 105 0 0 0-25.56 13.15 125.27 125.27 0 0 0-33.1 34.91A138 138 0 0 0 48.5 108.5a7.69 7.69 0 0 1-6.15 5.27 4.66 4.66 0 0 0-.64.23h-1.44c-.1-.06-.19-.16-.3-.18a8.17 8.17 0 0 1-6.42-4.82 128.9 128.9 0 0 0-15.12-23.32c-3.76-4.53-7.75-8.87-12.87-11.88C2.92 72.25.87 70.46 0 67.48z" fill="#1148f1"></path>
                            </svg>          
                        `);
                        status = '';
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        if ($.isEmptyObject(errors) == false) {
                            $.each(errors.errors, function(key, value) {
                                var InputID = '#save' + key;
                                $(InputID).html(`
                                <svg fill='#f90b0b' height='15px' width='15px'   viewBox='-176.4 -176.4 842.80 842.80' xml:space='preserve' stroke='#f90b0b' stroke-width='49'>
                                <polygon points='456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337 '></polygon> </g></svg>
                                   
                        `);
                            })
                        }
                    }
                });

            });
            $('#tps').change(function() {
                var tps_id = $('#tps').val();
                window.location = "{{ url('calegprov') }}/" + tps_id;
            });
        });

        function saveSuara() {
            var fd = new FormData();
            fd.append(input_id, jumlah_suara);
            fd.append('partai_id', partai_id);
            fd.append('caleg_id', input_id);
            fd.append('tps_id', tps_id);
            fd.append('jumlah_suara', jumlah_suara);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('savesuara/calegprov') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function(data) {
                    $('#save' + data.caleg_id).html(`
                            <svg viewBox="0 0 110 110" width="10" height="10">
                                <path d="M0 64.37a9.67 9.67 0 0 1 2.94-4.67 8 8 0 0 1 9.2-.66 57.21 57.21 0 0 1 13.8 11 114.1 114.1 0 0 1 13.18 16.73c.17.26.36.5.56.77 1.83-3.43 3.54-6.85 5.44-10.17C56 58.23 70 41.83 88.16 29.21a125.64 125.64 0 0 1 28.44-14.62c5.76-2.12 11.08 1.82 11.22 6.91a1.32 1.32 0 0 0 .18.43v.24c-.11.49-.2 1-.32 1.47a7.91 7.91 0 0 1-5.35 5.95 105 105 0 0 0-25.56 13.15 125.27 125.27 0 0 0-33.1 34.91A138 138 0 0 0 48.5 108.5a7.69 7.69 0 0 1-6.15 5.27 4.66 4.66 0 0 0-.64.23h-1.44c-.1-.06-.19-.16-.3-.18a8.17 8.17 0 0 1-6.42-4.82 128.9 128.9 0 0 0-15.12-23.32c-3.76-4.53-7.75-8.87-12.87-11.88C2.92 72.25.87 70.46 0 67.48z" fill="#1148f1"></path>
                            </svg>          
                        `);
                    status = 'sukses';
                },
                error: function(data) {
                    var errors = data.responseJSON;
                    if ($.isEmptyObject(errors) == false) {
                        $.each(errors.errors, function(key, value) {
                            var InputID = '#save' + key;
                            $(InputID).html(`
                            <svg fill='#f90b0b' height='10px' width='10px'   viewBox='-176.4 -176.4 842.80 842.80' xml:space='preserve' stroke='#f90b0b' stroke-width='49'>
                            <polygon points='456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337 '></polygon> </g></svg>   
                        `);
                        })
                    }
                }
            });
        }
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
