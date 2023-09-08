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
                        <legend class="scheduler-border">DATA DESA <span id="kec_name"></span> </legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group mb-0">
                                        <select class="form-control select2" id="kecamatan">
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
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian desa..." id="cari_desa">

                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Desa</th>
                                            <th class="text-center px-1">Jumlah TPS</th>
                                            <th class="text-center px-2">Aksi</th>
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
                                    <button class="btn btn-info btn-sm " data-toggle="modal" data-target="#modal-tps">
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

                                            <th class="text-center px-2">Aksi</th>
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
                                <button class="btn btn-xs btn-secondary"><i class="ri-add-fill px-1"></i></button>
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
            <div class="modal-content pb-2">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH TPS</label>
                </div>
                <div class="modal-body">
                    <div class="form-group floating">
                        <input type="number" min="0" id="tps"
                            oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
                            class="form-control floating" autocomplete="off">
                        <label for="password">Jumlah TPS</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.no.title.plugin.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                selectionTitleAttribute: false
            })

        })

    </script>
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
            addToolTip('#tps', 'bottom', 'focus', 'press enter to save');
        });

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

        $('#modal-tps').on('hidden.bs.modal', function() {
            $('#tps').val('');
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




    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
