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
                        <legend class="scheduler-border">DATA PARTAI - <b>DPRD TK. II / KABUPATEN</b> </legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="form-group mb-0">
                                        <select class="form-control select2" id="dapil">
                                            <option selected="selected" disabled="disabled">
                                                Pilih Dapil
                                            </option>

                                            @foreach ($data as $d)
                                                <option class="opt" value="{{ $d->id }}">Dapil {{ $d->title }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1 mb-2"></div>
                                <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian Partai..." id="cari_partai">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center px-1" width="70px">No.</th>
                                            <th class="">Nama Partai</th>
                                            <th class="text-center px-1" width="90px">Jml. Caleg</th>
                                            <th class="text-center px-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATA CALEG <span id="title2"></span></legend>
                        <div class="card-body p-0 mb-2 mt-1 d-none" id="tools">
                            <div class="row">
                                <div class="col-md-7 mb-2">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-caleg">
                                        <i class="mdi mdi-plus"></i> Tambah Caleg</button>
                                </div>
                                <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian Caleg..." id="cari_caleg">
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="table">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="80px">No.</th>
                                            <th class="">Nama Caleg</th>
                                            <th class="text-center px-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-caleg"> </tbody>
                                </table>
                            </div>

                        </div>
                        {{--  --}}
                        <div class="card mt-1" id="default">
                            <div class="card-body">
                                Untuk menambah caleg, pilih dapil lalu klik tombol
                                <button class="btn btn-xs btn-secondary"><i
                                        class="ri-add-fill px-1"></i></button> pada
                                daftar partai.
                            </div>
                        </div>

                        <div class="card mt-1 d-none" id="default2">
                            <div class="card-body">
                                Untuk mengubah data caleg, klik pada nomor atau nama. <br>Tekan enter untuk menyimpan data.
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-caleg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH CALEG DPRD TK. II / KABUPATEN</label>
                </div>
                <div class="modal-body" id="fire1">
                    <input type="hidden" name="partai_id" id="partai_id">
                    <input type="hidden" name="dapil_id" id="dapil_id">

                    <div class="form-group floating">
                        <input type="text" value="" class="form-control floating bg-white" id="party_name" autocomplete="off" readonly>
                        <label for="nama">Partai</label>
                    </div>

                    <div class="form-group floating">
                        <input type="text" class="form-control floating" id="nama" autocomplete="off">
                        <label for="nama">Nama caleg</label>
                    </div>

                    <div class="form-group floating">
                        <input type="number" min="0" autocomplete="off"
                            oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control floating" id="no_urut">
                        <label for="no_urut">Nomor urut</label>
                    </div>



                    <button class="btn btn-info float-right" style="margin-top:-1rem">SIMPAN</button>
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

    @include('admin.js.caleg-ii.show-partai')
    @include('admin.js.caleg-ii.show-caleg')
    @include('admin.js.caleg-ii.store-caleg')
    @include('admin.js.caleg-ii.update-caleg')
    @include('admin.js.caleg-ii.delete-caleg')
    {{-- @include('admin.js.caleg-ri.store-caleg')
    @include('admin.js.caleg-ri.update-caleg')
    @include('admin.js.caleg-ri.delete-caleg') --}}



    <script>
        //--------------------------------------------------------FOCUS INPUT MODAL + RESET VALUE IF NOT CHANGED
        $('#modal-caleg').on('shown.bs.modal', function() {
            $('#nama').focus();
        })

        $("#table-body-caleg").on("focus", "input", function(e) {
            $(this).data("previous-value", $(this).val());
        });

        $("#table-body-caleg").on("blur", "input", function(e) {
            $(this).val($(this).data("previous-value"));
        });

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
            addToolTip('#table-body-caleg input', 'bottom', 'focus', 'press enter to save');
        });

    </script>

    <script>
        //--------------------------------------------------------FILTER TABEL
        function filterRows() {
            let query = $.trim($('#cari_partai').val().toUpperCase());
            $('#table-body tr').each(function() {
                let val1 = $(this).closest('tr').find('.nama').val().trim().toUpperCase();
                let val2 = $(this).closest('tr').find('.count').val().trim().toUpperCase();
                let val3 = $(this).closest('tr').find('.urut').val().trim().toUpperCase();

                if (val1.indexOf(query) !== -1 || val2.indexOf(query) !== -1 || val3.indexOf(query) !== -1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_partai').on('input', filterRows);

    </script>
    <script>
        //--------------------------------------------------------FILTER TABEL
        function filterRows() {
            let query = $.trim($('#cari_caleg').val().toUpperCase());
            $('#table-body-caleg tr').each(function() {
                let animal1 = $(this).closest('tr').find('.nama').val().trim().toUpperCase();
                let animal3 = $(this).closest('tr').find('.urut').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1 || animal3.indexOf(query) !== -1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_caleg').on('input', filterRows);

    </script>

    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
