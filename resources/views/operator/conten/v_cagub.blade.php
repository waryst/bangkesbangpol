@extends('operator.layout.main')

@section('title', 'Calon Gubernur')
@push('mycss')
    <style>
        input.salah {
            border: solid red 2px;
        }

        .nomer_suara {
            border: solid darkgrey 2px;
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
                <legend class="scheduler-border">Perolehan Suara Sah Calon Gubernur dan Wakil Gubernur</legend>

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
                </div>
                <div class="row justify-content-center">
                    <div class="text-center mx-auto col-12 my-2" style="font-weight: 700;font-size: 2em">
                        @if ($pilih_tps->id ?? 0 != null)
                            Nomer TPS :
                            {{ sprintf('%02d', $pilih_tps->title) }}
                        @endif
                    </div>
                    @foreach ($cagub as $cagub)
                        <div class="col-md-4">
                            <div class="card card_suara">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item text-center py-0 my-0 d-flex justify-content-center back">
                                        <h1 class="font-weight-bold rounded-circle px-1 my-2 nomer_suara">
                                            0{{ $cagub->no_urut }}
                                        </h1>
                                    </li>
                                </ul>
                                <img src="{{ asset('foto/' . $cagub->foto) }}" class="card-img-top " alt="...">
                                <div class="card-body justify-content-center">
                                    <div class="row ">
                                        <div class="col-6 text-center">
                                            <span>Calon Gubernur</span>
                                            <p class="card-text">{{ $cagub->nama_cagub }}</p>
                                        </div>
                                        <div class="col-6 text-center">
                                            <span>Calon Wakil Gubernur</span>
                                            <p class="card-text">{{ $cagub->nama_cawagub }}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center">

                                        @if ($pilih_tps->id ?? 0 != null)
                                            <div style="position: relative">
                                                <input type="number" min="0"
                                                    onKeyPress="if(this.value.length==3) return false;"
                                                    data-default="{{ $cagub->suaracagub[0]->jumlah ?? 0 }}"
                                                    oninput="this.value = Math.abs(this.value)" autocomplete="off"
                                                    id="{{ $cagub->id }}" data-id="{{ $cagub->id }}"
                                                    onfocus="this.placeholder = ''" onblur="this.placeholder = '0'"
                                                    value="{{ $cagub->suaracagub[0]->jumlah ?? 0 }}"
                                                    class="form-control text-center suara submit">

                                                <div class="loadingsuara" id="save{{ $cagub->id }}"
                                                    style="position: absolute;left: 110%;top:25%">
                                                </div>

                                            </div>
                                        @endif
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
    <script type="text/javascript">
        var status;
        var Interval;
        var cagub_id;
        var tps_id;
        var jumlah_suara;

        $(document).ready(function() {
            $(document).on('click', '.suara', function(e) {
                e.preventDefault();
                status = '';
            });
            $(document).on('focus', '.suara', function(e) {
                e.preventDefault();
                status = '';
            });
            $('.submit').keyup(function(e) {
                if (e.keyCode != 9) {
                    input_id = $(this).data('id');
                    tps_id = "{{ $pilih_tps->id ?? 0 }}";
                    jumlah_suara = $(this).val();
                    var cagub_id = $(this).data('id');
                    data_default = $(this).data('default');
                    if (jumlah_suara != $("#" + input_id).attr("data-default")) {
                        document.getElementById(input_id).setAttribute("data-default", jumlah_suara);
                        $('#save' + cagub_id).html(`   `);
                        clearTimeout(Interval);
                        Interval = setTimeout(saveSuara, 1000);
                    } else {
                        $('#save' + cagub_id).html(`
                            <svg viewBox="0 0 128 128" width="30" height="30">
                                <path d="M0 64.37a9.67 9.67 0 0 1 2.94-4.67 8 8 0 0 1 9.2-.66 57.21 57.21 0 0 1 13.8 11 114.1 114.1 0 0 1 13.18 16.73c.17.26.36.5.56.77 1.83-3.43 3.54-6.85 5.44-10.17C56 58.23 70 41.83 88.16 29.21a125.64 125.64 0 0 1 28.44-14.62c5.76-2.12 11.08 1.82 11.22 6.91a1.32 1.32 0 0 0 .18.43v.24c-.11.49-.2 1-.32 1.47a7.91 7.91 0 0 1-5.35 5.95 105 105 0 0 0-25.56 13.15 125.27 125.27 0 0 0-33.1 34.91A138 138 0 0 0 48.5 108.5a7.69 7.69 0 0 1-6.15 5.27 4.66 4.66 0 0 0-.64.23h-1.44c-.1-.06-.19-.16-.3-.18a8.17 8.17 0 0 1-6.42-4.82 128.9 128.9 0 0 0-15.12-23.32c-3.76-4.53-7.75-8.87-12.87-11.88C2.92 72.25.87 70.46 0 67.48z" fill="#1148f1"></path>
                            </svg>          
                        `);
                    }
                }
            });
            $('.submit').blur(function() {
                if (status == '') {
                    input_id = $(this).data('id');
                    tps_id = "{{ $pilih_tps->id ?? 0 }}";
                    jumlah_suara = $(this).val();
                    if (jumlah_suara != $("#" + input_id).attr("data-default")) {
                        document.getElementById(input_id).setAttribute("data-default", jumlah_suara);
                        var fd = new FormData();
                        fd.append(input_id, jumlah_suara);
                        fd.append('cagub_id', input_id);
                        fd.append('tps_id', tps_id);
                        fd.append('jumlah_suara', jumlah_suara);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ url('savesuara/cagub') }}",
                            data: fd,
                            contentType: false,
                            processData: false,
                            dataType: 'json',

                            success: function(data) {
                                $('#save' + data.cagub_id).html(`
                                <svg viewBox="0 0 128 128" width="30" height="30">
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
                                    <svg fill='#f90b0b' height='30px' width='30px'   viewBox='-176.4 -176.4 842.80 842.80' xml:space='preserve' stroke='#f90b0b' stroke-width='49'>
                                    <polygon points='456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337 '></polygon> </g></svg>
                                    
                            `);
                                    })
                                }
                            }
                        });
                    }
                }
            });
            $('#tps').change(function() {
                var tps_id = $('#tps').val();
                window.location = "{{ url('pilgub') }}/" + tps_id;
            });
        });

        function saveSuara() {
            var fd = new FormData();
            fd.append(input_id, jumlah_suara);
            fd.append('cagub_id', input_id);
            fd.append('tps_id', tps_id);
            fd.append('jumlah_suara', jumlah_suara);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('savesuara/cagub') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function(data) {
                    $('#save' + data.cagub_id).html(`
                            <svg viewBox="0 0 128 128" width="30" height="30">
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
                                <svg fill='#f90b0b' height='30px' width='30px'   viewBox='-176.4 -176.4 842.80 842.80' xml:space='preserve' stroke='#f90b0b' stroke-width='49'>
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
