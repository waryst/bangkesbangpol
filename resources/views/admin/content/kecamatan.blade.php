@extends('admin.layout.main')

@section('title', 'Calon Presiden')
    @push('mycss')
        @include('admin.css.css')
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
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-kecamatan">
                                        <i class="mdi mdi-plus"></i> Tambah Kecamatan</button>

                                </div>
                                <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
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
                                            <th class="text-center px-1" width="10%">Dapil</th>
                                            <th class="text-center px-1">Jumlah Desa</th>
                                            <th class="text-center px-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($data as $d)
                                            <tr id="tr-{{ $d->id }}">
                                                <td class="td-i">
                                                    <input id="{{ $d->id }}" type="text" value="{{ $d->title }}"
                                                        class="form-control form-control-under border-0 ml-0" autocomplete="off">
                                                </td>
                                                <td class="text-center">{{ $d->dapil->title ?? '' }}</td>
                                                <td class="text-center" id="desa_count">{{ $d->desa_count }}</td>
                                                <td class="text-center px-1">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button"
                                                            data-quantity="{{ $d->id }}">
                                                            <i class="ri-delete-bin-line px-1"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-secondary add"
                                                            data-quantity="{{ $d->id }}">
                                                            <i class="ri-add-fill px-1"></i>
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
                                <div class="col-md-7 mb-2">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-desa">
                                        <i class="mdi mdi-plus"></i> Tambah Desa</button>
                                </div>
                                <div class="col-md-5 text-right">

                                    <input class="form-control form-control-sm form-control-yellow" type="text"
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
                                            <th class="text-center px-1">Jumlah TPS</th>
                                            <th class="text-center px-1">Aksi</th>
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
                                <button class="btn btn-xs btn-secondary"><i
                                        class="ri-add-fill px-1"></i></button> pada
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
            <div class="modal-content pb-2">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH KECAMATAN</label>
                </div>
                <div class="modal-body">
                    <div class="form-group floating">
                        <input type="text" id="kecamatan"
                            class="form-control floating" autocomplete="off">
                        <label for="password">Nama Kecamatan</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-desa">
        <div class="modal-dialog">
            <div class="modal-content pb-2">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH DESA</label>
                </div>
                <div class="modal-body">
                    <div class="form-group floating">
                        <input type="text" id="desa"
                            class="form-control floating" autocomplete="off">
                        <label for="password">Nama desa</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('java')

    <script>
        //--------------------------------------------------------ADD TOOLTIP FUCNTION HELPER
        function addToolTip(id, place, trigger, title, ) {
            $(id).tooltip({
                placement: place,
                trigger: trigger,
                title: title,
                delay: {
                    "show": 300,
                    "hide": 0
                }
            });
        }

        $(document).ready(function() {
            addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
            addToolTip('#kecamatan', 'bottom', 'focus', 'press enter to save');
            addToolTip('#desa', 'bottom', 'focus', 'press enter to save');
        });

        $(document).ready(function() {

        });

    </script>
    <script>
        $('#modal-kecamatan').on('shown.bs.modal', function() {
            $('#kecamatan').focus();
        })

        $('#modal-desa').on('shown.bs.modal', function() {
            $('#desa').focus();
        })

        $('#modal-kecamatan').on('hidden.bs.modal', function() {
            $('#kecamatan').val('');
        })

        $('#modal-desa').on('hidden.bs.modal', function() {
            $('#desa').val('');
        })

        $("#table-body").on("focus", "input", function(e) {
            $(this).data("previous-value", $(this).val());
        });

        $("#table-body").on("blur", "input", function(e) {
            $(this).val($(this).data("previous-value"));
        });

        $("#table-body-desa").on("focus", "input", function(e) {
            $(this).data("previous-value", $(this).val());
        });

        $("#table-body-desa").on("blur", "input", function(e) {
            $(this).val($(this).data("previous-value"));
        });

    </script>

    @include('admin.js.kecamatan.store-kecamatan')
    @include('admin.js.kecamatan.update-kecamatan')
    @include('admin.js.kecamatan.delete-kecamatan')
    @include('admin.js.kecamatan.show-desa')
    @include('admin.js.kecamatan.store-desa')
    @include('admin.js.kecamatan.update-desa')
    @include('admin.js.kecamatan.delete-desa')



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
