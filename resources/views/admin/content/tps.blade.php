@extends('admin.layout.main')

@section('title', 'Calon Presiden')
    @push('mycss')
        <style>
            fieldset.scheduler-border {
                border: 1px groove #ddd !important;
                padding: 0 1.4em 0.8em 1.4em !important;
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
                color: rgb(115, 115, 115);
            }

            legend b {
                color: #000;
            }

            td {
                vertical-align: middle !important;
            }

            .td-i {
                padding-left: 12px !important;
            }

            .form-control-yellow:focus {
                background-color: #fff5d7 !important;
            }

            .form-control-under:focus {
                background-color: #fff5d7 !important;
            }

            .form-control-under {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
                height: 2rem;
            }

            .bg-light2 {
                background-color: #f3f3f3 !important;
            }

            /* Chrome, Safari, Edge, Opera */
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

        <link rel="stylesheet" href="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.css" />

        <link rel="stylesheet" href="{{ asset('asset') }}/plugins/fontawesome-free/css/fontawesome.min.css" />
        <link rel="stylesheet" href="{{ asset('asset') }}/plugins/uil-mdi-ri-icons/uil-mdi-ri-icons.css" />
        <script src="{{ asset('asset') }}/plugins/sweetalert2/sweetalert2.js"></script>
    @endpush
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <section class="content">
        <div class="container-fluid">
            <div class="row mt-2">
                <div class="col-md-6">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATA DESA <span id="kec_name"></span> </legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group mb-0">
                                        <select class="form-control select2" style="width: 100%;" id="kecamatan">
                                            <option selected="selected" disabled="disabled">Pilih
                                                Kecamatan
                                            </option>

                                            @foreach ($data as $d)
                                                <option class="opt" value="{{ $d->id }}">{{ $d->title }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 mb-2"></div>
                                <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control form-control-yellow" type="text"
                                        placeholder="Pencarian desa..." id="cari_desa">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Kecamatan</th>
                                            <th class="text-center">Jumlah TPS</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-desa">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- ---------------------------------------------------------------------------------------------------------- --}}
                <div class="col-md-6">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATA TPS <span id="desa_name"></span></legend>
                        <div class="card-body p-0 mb-2 mt-1 d-none " id="d-cari">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-tps">
                                        <i class="mdi mdi-plus"></i> Tambah TPS</button>
                                </div>
                                <div class="col-md-6 mb-2 text-right">
                                    <button class="btn btn-danger" id="delete-semua">
                                        <i class="mdi mdi-trash-can-outline"></i> Hapus Semua TPS</button>
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="d-list">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama TPS</th>

                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-tps">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="card mt-1" id="default">
                            <div class="card-body">
                                Untuk menambah TPS, pilih kecamatan lalu klik tombol
                                <button class="btn btn-xs btn-secondary"><i class="mdi mdi-eye-outline px-1"></i></button>
                                pada
                                daftar desa.
                            </div>
                        </div>
                        {{--  --}}
                    </fieldset>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-tps">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="modal-body">
                    <label>TAMBAH TPS</label>
                    <input class="form-control mt-2 form-control-yellow" type="number" min="0"
                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
                        placeholder="Jumlah TPS..." id="tps"
                        data-quantity="">
                </div>
            </div>
        </div>
    </div>

@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $('.select2').select2({})
        })

    </script>

    @include('admin.js.tps.show-desa')
    @include('admin.js.tps.show-tps')
    @include('admin.js.tps.store-tps')
    @include('admin.js.tps.delete-tps')
    @include('admin.js.tps.delete-all-tps')




    <script>
        $('#modal-tps').on('shown.bs.modal', function() {
            $('#tps').focus();
        })

    </script>

    <script>
        function filterRows() {
            let query = $.trim($('#cari_desa').val().toUpperCase());
            $('#table-body-desa tr').each(function() {
                let animal1 = $(this).closest('tr').find('input').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1) {
                    $(this).closest('tr').show();
                } else {
                    $(this).closest('tr').hide();
                }
            });
        }

        $('#cari_desa').on('input', filterRows);

    </script>

    <script>
        function filterRows() {
            let query = $.trim($('#cari_tps').val().toUpperCase());
            $('#table-body-tps tr').each(function() {
                let animal1 = $(this).closest('tr').find('input').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1) {
                    $(this).closest('tr').show();
                } else {
                    $(this).closest('tr').hide();
                }
            });
        }

        $('#cari_tps').on('input', filterRows);

    </script>


    <script>
        $(function() {
                    $('.select2').select2()
                }

    </script>
    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
