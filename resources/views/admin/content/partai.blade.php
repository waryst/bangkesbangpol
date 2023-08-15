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
                <div class="col-md-12">
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border">DATA PARTAI</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-partai">
                                        <i class="mdi mdi-plus"></i> Tambah Partai</button>

                                </div>
                                <div class="col-md-4 mb-2 text-right">
                                    <input class="form-control form-control-yellow" type="text"
                                        placeholder="Pencarian Partai..." id="cari_partai">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="100px">No. Urut</th>
                                            <th class="" width="50%">Nama Partai</th>
                                            <th>Singkatan</th>
                                            <th class="text-center px-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($data as $d)
                                            <tr id="{{ $d->id }}">
                                                <td class="text-center">
                                                    <input type="number" value="{{ $d->no_urut }}"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut"
                                                        name="no_urut" autocomplete="off"
                                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="{{ $d->nama }}"
                                                        class="form-control form-control-under border-0 ml-0 nama"
                                                        name="nama" autocomplete="off">
                                                </td>
                                                <td>
                                                    <input type="text" value="{{ $d->singkatan }}"
                                                        class="form-control form-control-under border-0 ml-0 singkat"
                                                        name="singkatan" autocomplete="off">
                                                </td>
                                                <td class="text-center px-2">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary delete-button">
                                                            <i class="ri-delete-bin-line px-1"></i>
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
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-partai">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH PARTAI</label>
                </div>
                <div class="modal-body">

                    <div class="form-group floating">
                        <input type="text" class="form-control floating" id="nama" autocomplete="off">
                        <label for="nama">Nama partai</label>
                    </div>

                    <div class="form-group floating">
                        <input type="text" class="form-control floating" id="singkatan" autocomplete="off">
                        <label for="singkatan">Singkatan</label>
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

    @include('admin.js.partai.store-partai')
    @include('admin.js.partai.update-partai')
    @include('admin.js.partai.delete-partai')



    <script>
        //--------------------------------------------------------FOCUS INPUT MODAL + RESET VALUE IF NOT CHANGED
        $('#modal-partai').on('shown.bs.modal', function() {
            $('#nama').focus();
        })

        $("#table-body").on("focus", "input", function(e) {
            $(this).data("previous-value", $(this).val());
        });

        $("#table-body").on("blur", "input", function(e) {
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
            addToolTip('#table-body input', 'bottom', 'focus', 'press enter to save');
        });

    </script>

    <script>
        //--------------------------------------------------------FILTER TABEL
        function filterRows() {
            let query = $.trim($('#cari_partai').val().toUpperCase());
            $('#table-body tr').each(function() {
                let animal1 = $(this).closest('tr').find('.nama').val().trim().toUpperCase();
                let animal2 = $(this).closest('tr').find('.singkat').val().trim().toUpperCase();
                let animal3 = $(this).closest('tr').find('.urut').val().trim().toUpperCase();

                if (animal1.indexOf(query) !== -1 || animal2.indexOf(query) !== -1 || animal3.indexOf(query) !== -
                    1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_partai').on('input', filterRows);

    </script>

    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
