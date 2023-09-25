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
                        <legend class="scheduler-border">DATA USER ADMIN</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-new">
                                        <i class="mdi mdi-plus"></i> Tambah User</button>

                                </div>
                                <div class="col-md-4 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian User..." id="cari_partai">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="100px">#</th>
                                            <th>Nama </th>
                                            <th>Username</th>
                                            <th class="text-center px-2" width="10%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($data as $d)
                                            <tr id="{{ $d->id }}">
                                                <td class="text-center">
                                                    <input type="number" value="{{ $x++ }}"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut bg-white"
                                                        name="no_urut" readonly disabled>
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="{{ $d->name }}"
                                                        class="form-control form-control-under border-0 ml-0 name"
                                                        name="name" autocomplete="off">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="{{ $d->email }}"
                                                        class="form-control form-control-under border-0 ml-0 email"
                                                        name="email" autocomplete="off">
                                                </td>

                                                <td class="text-center px-2">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary pass"
                                                            data-id="{{ $d->id }}" data-toggle="modal"
                                                            data-target="#modal-pass">
                                                            <i class="ri-key-2-line  px-1"></i>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        @if (auth()->user()->id != $d->id)
                                                            <button class="btn btn-xs btn-secondary delete-button ml-2">
                                                                <i class="ri-delete-bin-line px-1"></i>
                                                            </button>
                                                        @endif
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


    <div class="modal fade" id="modal-new">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH USER ADMIN</label>
                </div>
                <div class="modal-body">
                    <div class="form-group floating">
                        <input type="text" class="form-control floating" id="name" name="name"
                            autocomplete="off">
                        <label for="name">Nama</label>
                    </div>

                    <div class="form-group floating">
                        <input type="text" class="form-control floating" id="email" name="email"
                            autocomplete="off">
                        <label for="email">Username</label>
                    </div>

                    <div class="form-group floating">
                        <div class="input-group">
                            <input type="password" class="form-control floating" id="password" name="password"
                                autocomplete="off">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-default eye" data-input="password" tabindex="-1">
                                    <i class="mdi mdi-eye-outline"></i>
                                </button>
                            </span>
                        </div>
                        <label for="password">Password</label>
                    </div>
                    {{-- <div class="row p-2 mb-2" style="margin-top: -30px;">
                        Format username gunakan nama_desa.nama_kecamatan
                    </div> --}}
                    <button class="btn btn-info float-right" id="simpan">SIMPAN</button>
                </div>
            </div>
        </div>
    </div>

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
    <script src="{{ asset('asset') }}/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>

    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
    @include('admin.js.admin.store-admin')
    @include('admin.js.admin.update-admin')
    @include('admin.js.admin.update-password')
    @include('admin.js.admin.delete-admin')

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
                let val1 = $(this).closest('tr').find('.name').val().trim().toUpperCase();
                let val2 = $(this).closest('tr').find('.email').val().trim().toUpperCase();
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

    {{-- let token = $("meta[name='csrf-token']").attr("content"); --}}
@endpush
