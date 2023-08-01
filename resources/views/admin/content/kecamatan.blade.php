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
                        <legend class="scheduler-border">DATA KECAMATAN</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-7 mb-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-kecamatan">
                                        <i class="mdi mdi-plus"></i> Tambah Kecamatan</button>

                                </div>
                                <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control-yellow" type="text"
                                        placeholder="Pencarian kecamatan..." id="cari_kecamatan">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Kecamatan</th>
                                            <th class="text-center">Jumlah Desa</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($data as $d)
                                            <tr id="tr-{{ $d->id }}">
                                                <td class="td-i">
                                                    <input id="{{ $d->id }}" type="text" value="{{ $d->title }}"
                                                        class="form-control form-control-under border-0 ml-0">
                                                </td>
                                                <td class="text-center" id="desa_count">{{ $d->desa_count }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button"
                                                            data-quantity="{{ $d->id }}">
                                                            <i class="ri-delete-bin-line px-1"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-secondary add"
                                                            data-quantity="{{ $d->id }}">
                                                            <i class="mdi mdi-eye-outline px-1"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
                {{-- ---------------------------------------------------------------------------------------------------------- --}}
                <div class="col-md-6">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATA DESA <span id="kec_name"></span></legend>
                        <div class="card-body p-0 mb-2 mt-1 d-none " id="d-cari">
                            <div class="row">
                                <div class="col-md-7">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-desa">
                                        <i class="mdi mdi-plus"></i> Tambah Desa</button>
                                </div>
                                <div class="col-md-5 text-right">

                                    <input class="form-control form-control-yellow" type="text"
                                        placeholder="Pencarian desa..." id="cari_desa">
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="d-list">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Desa</th>
                                            <th class="text-center">Jumlah TPS</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-desa">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="card mt-1" id="default">
                            <div class="card-body">
                                Untuk menambah desa, klik tombol
                                <button class="btn btn-xs btn-secondary"><i class="ri-add-fill px-1"></i></button> pada
                                daftar kecamatan.
                            </div>
                        </div>
                        {{--  --}}
                    </fieldset>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-kecamatan">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="modal-body">
                    <label>TAMBAH KECAMATAN</label>
                    <input class="form-control mt-2 form-control-yellow" type="text" placeholder="Nama kecamatan..."
                        id="kecamatan">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-desa">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="modal-body">
                    <label>TAMBAH DESA</label>
                    <input class="form-control mt-2 form-control-yellow" type="text" placeholder="Nama desa..." id="desa"
                        data-quantity="">
                </div>
            </div>
        </div>
    </div>

@endsection
@push('java')

    @include('admin.js.kecamatan.store-kecamatan')
    @include('admin.js.kecamatan.update-kecamatan')
    @include('admin.js.kecamatan.delete-kecamatan')
    @include('admin.js.kecamatan.show-desa')
    @include('admin.js.kecamatan.store-desa')
    @include('admin.js.kecamatan.update-desa')
    @include('admin.js.kecamatan.delete-desa')

    <script>
        $('#modal-kecamatan').on('shown.bs.modal', function() {
            $('#kecamatan').focus();
        })

    </script>
    <script>
        $('#modal-desa').on('shown.bs.modal', function() {
            $('#desa').focus();
        })

    </script>

    <script>
        function filterRows() {
            let query = $.trim($('#cari_kecamatan').val().toUpperCase());
            $('#table-body tr').each(function() {
                let animal1 = $(this).closest('tr').find('input').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_kecamatan').on('input', filterRows);

    </script>

    <script>
        function filterRows() {
            let query = $.trim($('#cari_desa').val().toUpperCase());
            $('#table-body-desa tr').each(function() {
                let animal1 = $(this).closest('tr').find('input').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_desa').on('input', filterRows);

    </script>


    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
