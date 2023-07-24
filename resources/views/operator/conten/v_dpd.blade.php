@extends('operator.layout.main')

@section('title', 'Calon DPD')
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
            width: 50px;
            height: 30px;
            border: solid rgb(109, 106, 106) 1px;
            font-size: 15px;
            font-weight: 600;
            padding-left: 0;
            padding-right: 0;
            color: black;
            /* margin-top: 20px; */
        }

        .loadingsuara {}

        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 0.5em 1.4em 0.5em !important;
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
        <fieldset class="scheduler-border">
            <legend class="scheduler-border ">Perolehan Suara Sah Calon DPD</legend>

            <div class="row my-0">

                <div class="text-center mx-auto col-12 my-2" style="font-weight: 700;font-size: 2em">
                    @if ($pilih_tps->id ?? 0 != null)
                        Nomer TPS :
                        {{ sprintf('%02d', $pilih_tps->title) }}
                    @endif
                </div>
                <div class="col-md-8 mx-auto p-0">
                    <div class="card ">
                        <div class="card-header">
                            <div class="row justify-content-center">
                                <div class="col-md-6 d-flex d-md-block justify-content-center">
                                    <div class="form-group m-1">
                                        <select id="tps" class="form-control select2" style="width: 250px;">
                                            <option selected>Pilih TPS</option>
                                            @foreach ($tps as $tps)
                                                <option value="{{ $tps->id }}">TPS
                                                    {{ $tps->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex d-md-block justify-content-center">
                                    <div class="input-group input-group-sm float-md-right" style="width: 200px;">
                                        <input type="text" id="myInput" onkeyup="myFunction()" name="table_search"
                                            class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table id="myTable" class="table table-head-fixed table-bordered table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="1px">No</th>
                                        <th class="text-center text-md-left">Nama Calon</th>
                                        <th class="text-center text-md-left" width="30px">Jumlah Suara</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dpd as $dpd)
                                        <tr>
                                            <td class="text-center">{{ $dpd->no_urut }}</td>
                                            <td>{{ $dpd->nama }}</td>
                                            <td>
                                                @if ($pilih_tps->id ?? 0 != null)
                                                    <div class="d-flex mx-auto justify-content-center"
                                                        style="width: 100px;">
                                                        <input type="number" min="0"
                                                            oninput="this.value = Math.abs(this.value)" autocomplete="off"
                                                            id="{{ $dpd->id }}" data-id="{{ $dpd->id }}"
                                                            onfocus="this.placeholder = ''" onblur="this.placeholder = '0'"
                                                            value="{{ $dpd->suaradpd[0]->jumlah ?? 0 }}"
                                                            class="form-control text-center suara submit">

                                                        <div class="input-group-append ml-2">
                                                            <span class="loadingsuara" id="save{{ $dpd->id }}">
                                                                <svg viewBox="0 0 170 170" width="20" height="20">
                                                                    @if ($dpd->suaradpd[0]->jumlah ?? 0 != null)
                                                                        <path
                                                                            d="M0 64.37a9.67 9.67 0 0 1 2.94-4.67 8 8 0 0 1 9.2-.66 57.21 57.21 0 0 1 13.8 11 114.1 114.1 0 0 1 13.18 16.73c.17.26.36.5.56.77 1.83-3.43 3.54-6.85 5.44-10.17C56 58.23 70 41.83 88.16 29.21a125.64 125.64 0 0 1 28.44-14.62c5.76-2.12 11.08 1.82 11.22 6.91a1.32 1.32 0 0 0 .18.43v.24c-.11.49-.2 1-.32 1.47a7.91 7.91 0 0 1-5.35 5.95 105 105 0 0 0-25.56 13.15 125.27 125.27 0 0 0-33.1 34.91A138 138 0 0 0 48.5 108.5a7.69 7.69 0 0 1-6.15 5.27 4.66 4.66 0 0 0-.64.23h-1.44c-.1-.06-.19-.16-.3-.18a8.17 8.17 0 0 1-6.42-4.82 128.9 128.9 0 0 0-15.12-23.32c-3.76-4.53-7.75-8.87-12.87-11.88C2.92 72.25.87 70.46 0 67.48z"
                                                                            fill="#1148f1"></path>
                                                                    @endif

                                                                </svg>
                                                            </span>
                                                        </div>

                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </fieldset>
    </section>
@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td_no = tr[i].getElementsByTagName("td")[0];
                td_name = tr[i].getElementsByTagName("td")[1];
                if (td_no || td_name) {
                    txtValue_no = td_no.textContent || td_no.innerText;
                    txtValue_name = td_name.textContent || td_name.innerText;
                    if (txtValue_no.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else if (txtValue_name.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                } else if (td_name) {
                    txtValue = td_name.textContent || td_name.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
        // function myFunction() {
        //     var input, filter, ul, li, a, i, txtValue;
        //     input = document.getElementById("myInput");
        //     filter = input.value.toUpperCase();
        //     ul = document.getElementById("myUL");
        //     li = ul.getElementsByTagName("li");
        //     for (i = 0; i < li.length; i++) {
        //         a = li[i].getElementsByTagName("a")[0];
        //         txtValue = a.textContent || a.innerText;
        //         if (txtValue.toUpperCase().indexOf(filter) > -1) {
        //             li[i].style.display = "";
        //         } else {
        //             li[i].style.display = "none";
        //         }
        //     }
        // }
        $(document).ready(function() {

            $(document).on('click', '.suara', function(e) {
                e.preventDefault();
                var dpd_id = $(this).data('id');
                $('#save' + dpd_id).html(`   `);
            });
            $(document).on('focus', '.suara', function(e) {
                e.preventDefault();
                var dpd_id = $(this).data('id');
                $('#save' + dpd_id).html(`   `);
            });
            $('.submit').blur(function() {
                var input_id = $(this).data('id');
                var tps_id = "{{ $pilih_tps->id ?? 0 }}";
                var jumlah_suara = $(this).val();
                var fd = new FormData();
                fd.append(input_id, jumlah_suara);
                fd.append('dpd_id', input_id);
                fd.append('tps_id', tps_id);
                fd.append('jumlah_suara', jumlah_suara);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ url('savesuara/dpd') }}",
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',

                    success: function(data) {
                        $('#save' + data.dpd_id).html(`
                            <svg viewBox="0 0 170 170" width="20" height="20">
                                <path d="M0 64.37a9.67 9.67 0 0 1 2.94-4.67 8 8 0 0 1 9.2-.66 57.21 57.21 0 0 1 13.8 11 114.1 114.1 0 0 1 13.18 16.73c.17.26.36.5.56.77 1.83-3.43 3.54-6.85 5.44-10.17C56 58.23 70 41.83 88.16 29.21a125.64 125.64 0 0 1 28.44-14.62c5.76-2.12 11.08 1.82 11.22 6.91a1.32 1.32 0 0 0 .18.43v.24c-.11.49-.2 1-.32 1.47a7.91 7.91 0 0 1-5.35 5.95 105 105 0 0 0-25.56 13.15 125.27 125.27 0 0 0-33.1 34.91A138 138 0 0 0 48.5 108.5a7.69 7.69 0 0 1-6.15 5.27 4.66 4.66 0 0 0-.64.23h-1.44c-.1-.06-.19-.16-.3-.18a8.17 8.17 0 0 1-6.42-4.82 128.9 128.9 0 0 0-15.12-23.32c-3.76-4.53-7.75-8.87-12.87-11.88C2.92 72.25.87 70.46 0 67.48z" fill="#1148f1"></path>
                            </svg>          
                        `);
                    },
                    error: function(data) {
                        var errors = data.responseJSON;
                        if ($.isEmptyObject(errors) == false) {
                            $.each(errors.errors, function(key, value) {
                                var InputID = '#save' + key;
                                $(InputID).html(`
                                <svg fill='#f90b0b' height='20px' width='20px'   viewBox='-176.4 -176.4 842.80 842.80' xml:space='preserve' stroke='#f90b0b' stroke-width='49'>
                                <polygon points='456.851,0 245,212.564 33.149,0 0.708,32.337 212.669,245.004 0.708,457.678 33.149,490 245,277.443 456.851,490 489.292,457.678 277.331,245.004 489.292,32.337 '></polygon> </g></svg>
                                   
                        `);
                            })
                        }
                    }
                });

            });
        });
        $(document).ready(function() {
            $('#tps').change(function() {
                var tps_id = $('#tps').val();
                window.location = "{{ url('dpd') }}/" + tps_id;
            });
        });

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
