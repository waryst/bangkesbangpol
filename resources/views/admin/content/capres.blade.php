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
                        <legend class="scheduler-border">DATA PASANGAN CALON PRESIDEN</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-8 mb-2">
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-capres">
                                        <i class="mdi mdi-plus"></i> Tambah Capres</button>

                                </div>
                                <div class="col-md-4 mb-2 text-right">
                                    <input class="form-control form-control-sm form-control-yellow" type="text"
                                        placeholder="Pencarian Capres..." id="cari_partai">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="100px">No. Urut</th>
                                            <th>Nama Calon Presiden</th>
                                            <th>Nama Calon Wakil Presiden</th>
                                            <th class="text-center px-2" width="8%">Foto</th>
                                            <th class="text-center px-2" width="8%">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($data as $d)
                                            <tr id="{{ $d->id }}">
                                                <td class="text-center">
                                                    <input type="number" value="{{ $d->no_urut }}"
                                                        class="form-control form-control-under border-0 ml-0 text-center d-inline urut" name="no_urut" autocomplete="off"
                                                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="{{ $d->nama_capres }}"
                                                        class="form-control form-control-under border-0 ml-0 nama_capres"
                                                        name="nama_capres" autocomplete="off">
                                                </td>
                                                <td class="td">
                                                    <input type="text" value="{{ $d->nama_cawapres }}"
                                                        class="form-control form-control-under border-0 ml-0 nama_cawapres" name="nama_cawapres" autocomplete="off">
                                                </td>
                                                <td class="text-center px-2">
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs btn-secondary img-eye"
                                                            data-foto="{{ $d->foto }}" data-nomor="{{ $d->no_urut }}">
                                                            <i class="ri-eye-line px-1"></i>
                                                        </button>
                                                        <button class="btn btn-xs btn-secondary img-edit" data-id="{{ $d->id }}" data-toggle="modal"
                                                            data-target="#modal-foto">
                                                            <i class="ri-image-add-line px-1"></i>
                                                        </button>
                                                    </div>
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


    <div class="modal fade" id="modal-capres">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">TAMBAH PASANGAN CALON PRESIDEN</label>
                </div>
                <div class="modal-body">
                    <form id="new" enctype="multipart/form-data">


                        <div class="form-group floating">
                            <input type="text" class="form-control floating" id="nama_capres" name="nama_capres" autocomplete="off">
                            <label for="nama_capres">Nama Calon Presiden</label>
                        </div>

                        <div class="form-group floating">
                            <input type="text" class="form-control floating" id="nama_cawapres" name="nama_cawapres" autocomplete="off">
                            <label for="nama_cawapres">Nama Calon Wakil Presiden</label>
                        </div>

                        <div class="form-group floating">
                            <input type="number" min="0" autocomplete="off"
                                oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null" class="form-control floating"
                                id="no_urut" name="no_urut">
                            <label for="no_urut">Nomor Urut</label>
                        </div>

                        <div class="form-group floating">
                            <input type="file" class="form-control floating" id="foto" name="foto" accept="image/png, image/jpeg"
                                style="padding-top:10px;padding-bottom:34px;">
                            <label for="foto">Foto pasangan capres </label>
                        </div>
                        <div class="row p-2 mb-2" style="margin-top: -30px;">
                            File gambar yang dapat diupload adalah file .png atau .jpg
                        </div>
                        <button class="btn btn-info float-right" style="">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-foto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <label class="mb-0">UPLOAD FOTO PASANGAN CALON PRESIDEN</label>
                </div>
                <div class="modal-body">
                    <form id="edit" enctype="multipart/form-data">
                        <div class="form-group floating">

                            <input type="file" name="foto" class="form-control floating" id="customFile" accept="image/png, image/jpeg"
                                style="padding-top:10px;padding-bottom:34px;">
                            <label for="customFile">Foto pasangan capres </label>
                        </div>
                        <div class="row mb-2 p-2" style="margin-top: -30px;">
                            File gambar yang dapat diupload adalah file .png atau .jpg
                        </div>
                        <button class="btn btn-info float-right mt-3">UPLOAD</button>
                    </form>
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
    @include('admin.js.capres.store-capres')
    @include('admin.js.capres.update-capres')
    @include('admin.js.capres.update-foto-capres')
    @include('admin.js.capres.delete-capres')
    <script>
        $("#table-body").on("click", ".img-eye", function(e) {
            e.preventDefault();
            let img = $(this).data("foto");
            let no = $(this).data("nomor");
            // alert(img);
            Swal.fire({
                imageUrl: 'foto/' + img,
                imageAlt: 'Capres No. ' + no,
                text: 'Capres Nomor Urut ' + no,
                showConfirmButton: false
            })
        });

    </script>


    <script>
        //--------------------------------------------------------FOCUS INPUT MODAL + RESET VALUE IF NOT CHANGED
        $('#modal-capres').on('shown.bs.modal', function() {
            $('#nama_capres').focus();
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
                let val1 = $(this).closest('tr').find('.nama_capres').val().trim().toUpperCase();
                let val2 = $(this).closest('tr').find('.nama_cawapres').val().trim().toUpperCase();
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
