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
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/uil-mdi-ri-icons/uil-mdi-ri-icons.css" />
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
                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header font-weight-bold">
                                Contact Person
                            </div>
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-3">SUPIYONO</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">081335649681</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-3">WILDANA</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">085749057575</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-3">NIDIA</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">082230737324</div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-3">ERMANI</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">082233706543</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>
            <div class="modal fade" id="modal-pass" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label class="mb-0">GANTI PASSWORD</label>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group floating">
                                <div class="text-danger" id="passwordError"></div>
                                <div class="input-group">
                                    <input type="password" class="form-control floating" id="password" name="password"
                                        autocomplete="off">
                                    <span class="input-group-append align-middle">
                                        <button tabindex="-1" class="btn btn-default eye" data-input="password">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </span>
                                </div>
                                <label for="password">Password Baru</label>
                            </div>
                            <div class="text-danger" id="password_confirmationError"></div>
                            <div class="form-group floating">
                                <div class="input-group">
                                    <input type="password" class="form-control floating" id="password_confirmation"
                                        name="password_confirmation" autocomplete="off">
                                    <span class="input-group-append">
                                        <button tabindex="-1" class="btn btn-default eye"
                                            data-input="password_confirmation">
                                            <i class="mdi mdi-eye-outline"></i>
                                        </button>
                                    </span>
                                </div>
                                <label for="password_confirmation">Ulangi Password</label>
                            </div>
                            <div class="text-danger" id="hpError"></div>
                            <div class="form-group floating">
                                <div class="input-group">
                                    <input type="text" class="form-control floating" id="hp" name="hp"
                                        autocomplete="off">

                                </div>
                                <label for="hp">No Whatsapp yang aktif</label>
                            </div>
                            <button class="btn btn-info float-right simpan-password">SIMPAN</button>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
@push('java')
    <script type="text/javascript">
        if ("{{ request()->path() }}" == "password") {

            $('#modal-pass').modal('show');
            $(".eye").on("click", function(e) {
                e.preventDefault();

                let input = $(this).data('input');

                if ($("#" + input).attr("type") == "password") {
                    $("#" + input).attr("type", "text");
                    $(this).html('<i class="mdi mdi-eye-off-outline"></i>');
                } else if ($("#" + input).attr("type") == "text") {
                    $("#" + input).attr("type", "password");
                    $(this).html('<i class="mdi mdi-eye-outline"></i>');
                }
            });
        }
        $('.simpan-password').on('click keyup', function(e) {
            password = $('#password').val();
            password_confirmation = $('#password_confirmation').val();
            hp = $('#hp').val();
            var fd = new FormData();
            fd.append('password', password);
            fd.append('password_confirmation', password_confirmation);
            fd.append('hp', hp);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ url('ganti_password') }}",
                data: fd,
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function(data) {
                    window.location = data.url;
                },
                error: function(data) {
                    $('#password').removeClass('is-invalid');
                    $('#passwordError').addClass('d-none');
                    var errors = data.responseJSON;
                    if ($.isEmptyObject(errors) == false) {
                        $.each(errors.errors, function(key, value) {
                            var ErrorID = '#' + key + 'Error';
                            var InputID = '#' + key;
                            $(InputID).addClass("is-invalid");
                            $(ErrorID).removeClass("d-none");
                            $(ErrorID).text(value);
                        })
                    }
                }
            });
        });
    </script>
@endpush
