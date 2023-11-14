@extends('admin.layout.main')

@section('title', 'User Admin')
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
                        <legend class="scheduler-border" id="nama_kecamatan">DATA USER OPERATOR DESA</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <select class="form-control select2" id="kecamatan">
                                        <option selected="selected" disabled="disabled">Pilih
                                            Kecamatan
                                        </option>

                                        @foreach ($kecamatan as $d)
                                            <option class="opt" value="{{ $d->id }}">{{ $d->title }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-5 mb-2 text-left">
                                    <button class="btn btn-info btn-sm pr-2" data-toggle="modal" data-target="#modal-new"
                                        id="exportxls">
                                        <i class="mdi mdi-microsoft-excel"></i> Export Excel</button>
                                </div>
                                <div class="col-md-4 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian User..." id="cari_partai">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table normal table2excel" data-tableName="Test Table 3">
                                    <thead>
                                        <tr>
                                            <th width="20%">Kecamatan</th>
                                            <th width="20%" class="normal">Desa</th>
                                            <th width="20%" class="normal">Nama</th>
                                            <th width="20%" class="normal">No. HP</th>
                                            <th width="20%" class="normal">Username</th>
                                            <th width="10%" class="text-center px-2">Password</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($desa as $d)
                                            <tr id="{{ $d->user->id }}">
                                                <td class="kecamatan">{{ $d->kecamatan->title }}</td>
                                                <td class="desa">{{ $d->title }}</td>
                                                <td class="name">{{ $d->user->name ?? '-' }}</td>
                                                <td class="name">{{ $d->user->hp }}</td>
                                                <td class="username">{{ $d->user->email ?? '-' }}</td>
                                                <td class="text-center px-2">
                                                    <div class="btn-group">
                                                        <span class="d-none">
                                                            {{ str_replace(' ', '', strtolower($d->kecamatan->title) . '.' . strtolower($d->title)) }}
                                                        </span>
                                                        <button class="btn btn-xs btn-secondary pass"
                                                            data-id="{{ $d->user->id }}"
                                                            data-user="{{ $d->user->email }}" data-toggle="modal"
                                                            data-target="#modal-pass">
                                                            <i class="ri-key-2-line  px-1"></i>
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

    <div class="modal fade" id="modal-pass">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">GANTI PASSWORD</label>
                </div>
                <div class="modal-body">

                    <div class="form-group floating">
                        <input type="text" class="form-control floating bg-white" style="color:#888 !important;"
                            id="xmail" readonly disabled>
                        <label for="password">Username</label>
                    </div>
                    <div class="form-group floating">
                        <div class="input-group">
                            <input type="password" class="form-control floating" id="new_password" name="new_password"
                                autocomplete="off">
                            <span class="input-group-append align-middle">
                                <button tabindex="-1" class="btn btn-default eye" data-input="new_password">
                                    <i class="mdi mdi-eye-outline"></i>
                                </button>
                            </span>
                        </div>
                        <label for="new_password">Password Baru</label>
                    </div>
                    <div class="form-group floating">
                        <div class="input-group">
                            <input type="password" class="form-control floating" id="confirm_password"
                                name="confirm_password" autocomplete="off">
                            <span class="input-group-append">
                                <button tabindex="-1" class="btn btn-default eye" data-input="confirm_password">
                                    <i class="mdi mdi-eye-outline"></i>
                                </button>
                            </span>
                        </div>
                        <label for="confirm_password">Ulangi Password</label>
                    </div>



                    <button class="btn btn-info float-right" id="simpan-password">SIMPAN</button>

                </div>
            </div>
        </div>
    </div>


@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.no.title.plugin.js"></script>
    <script src="{{ asset('asset') }}/plugins/jquery-table2excel/jquery.table2excel.js"></script>
    <script>
        $(function() {
            $('.select2').select2({
                selectionTitleAttribute: false
            })

        })
    </script>
    @include('admin.js.user-desa.show-user')
    @include('admin.js.user-desa.update-password')


    <script>
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
    </script>

    <script>
        //--------------------------------------------------------FOCUS INPUT MODAL + RESET VALUE IF NOT CHANGED
        $('#modal-new').on('shown.bs.modal', function() {
            $('#name').focus();
        })

        $('#modal-pass').on('shown.bs.modal', function() {
            $('#new_password').focus();
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
                let val1 = $(this).closest('tr').find('.kecamatan').html().trim().toUpperCase();
                let val2 = $(this).closest('tr').find('.desa').html().trim().toUpperCase();
                let val3 = $(this).closest('tr').find('.name').html().trim().toUpperCase();
                let val4 = $(this).closest('tr').find('.username').html().trim().toUpperCase();
                if (val1.indexOf(query) !== -1 || val2.indexOf(query) !== -1 || val3.indexOf(query) !== -1 || val4
                    .indexOf(query) !== -1) {
                    $(this).closest('tr').show(); //Show
                } else {
                    $(this).closest('tr').hide(); //Hide
                }
            });
        }
        $('#cari_partai').on('input', filterRows);
    </script>

    <script>
        $(function() {
            $("#exportxls").click(function(e) {
                var table = $(".table2excel");
                var doc_name = $("#nama_kecamatan").html();
                if (table && table.length) {
                    var preserveColors = (table.hasClass('table2excel_with_colors') ? true : false);
                    $(table).table2excel({
                        exclude: ".noExl",
                        name: "Excel Document Name",
                        filename: doc_name + "-" + new Date().toISOString().replace(/[\-\:\.]/g,
                            "") + ".xls",
                        fileext: ".xls",
                        exclude_img: true,
                        exclude_links: true,
                        exclude_inputs: true,
                        preserveColors: preserveColors
                    });
                }
            });

        });
    </script>

    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
