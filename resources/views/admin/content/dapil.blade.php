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
                        <legend class="scheduler-border">DATA DAPIL</legend>
                        <div class="card-body p-0 mb-2 mt-1">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-dapil">
                                        <i class="mdi mdi-plus"></i> Tambah Dapil</button>

                                </div>
                                {{-- <div class="col-md-5 mb-2 text-right">
                                    <input class="form-control form-control-yellow" type="text"
                                        placeholder="Pencarian kecamatan..." id="cari_kecamatan">
                                </div> --}}
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Dapil</th>
                                            <th class="text-center px-1">Jumlah Kecamatan</th>
                                            <th class="text-center px-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($data as $d)
                                            <tr id="tr-{{ $d->id }}">
                                                <td class="td-i">
                                                    <input id="{{ $d->id }}" type="text"
                                                        value="Dapil {{ $d->title }}"
                                                        class="form-control bg-white border-0 ml-0" readonly>
                                                </td>
                                                <td class="text-center" id="kecamatan_count">{{ $d->kecamatan_count }}
                                                </td>
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
                        <legend class="scheduler-border">DATA KECAMATAN <span id="dapil_name"
                                class="text-dark"></span></legend>
                        <div class="card-body p-0 mb-2 mt-1 d-none " id="d-cari">
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modal-kecamatan">
                                        <i class="mdi mdi-plus"></i> Masukkan Kecamatan</button>
                                </div>
                            </div>
                        </div>
                        <div class="card d-none" id="d-list">
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Kecamatan</th>
                                            <th class="text-center px-1">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-kecamatan">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{--  --}}
                        <div class="card mt-1" id="default">
                            <div class="card-body">
                                Untuk memasukkan kecamatan ke dapil, klik tombol
                                <button class="btn btn-xs btn-secondary"><i
                                        class="mdi mdi mdi-eye-outline px-1"></i></button> pada
                                daftar dapil.
                            </div>
                        </div>
                        {{--  --}}
                    </fieldset>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-dapil">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="modal-body pb-4">
                    <label>TAMBAH DAPIL</label>
                    <input class="form-control mt-2 form-control-yellow mb-3" type="number" min="0"
                        oninput="this.value = !!this.value && Math.abs(this.value) >= 1 ? Math.abs(this.value) : null"
                        placeholder="Nama dapil..." id="dapil">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-kecamatan">
        <div class="modal-dialog">
            <div class="modal-content p-1">
                <div class="modal-body">
                    {{-- <form action="{{ route('dapil.store') }}" method="POST">
                        @csrf --}}
                    <div class="form-group">
                        <label>TAMBAH KECAMATAN</label>
                        <select class="select2" multiple="multiple"
                            data-placeholder="Pilih kecamatan, bisa lebih dari satu"
                            style="width: 100%;" id="kecamatan" name="kecamatan[]" data-quantity="">
                            @foreach ($kec as $k)
                                <option value="{{ $k->id }}">{{ $k->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-info">TAMBAH</button>
                    </div>
                    {{-- </form> --}}
                    {{-- <label>TAMBAH KECAMATAN</label>
                    <input class="form-control mt-2 form-control-yellow" type="text" placeholder="Nama kecamatan..."
                        id="desa"
                        data-quantity=""> --}}
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
            addToolTip('#dapil', 'bottom', 'focus', 'press enter to save');
        });

    </script>
    @include('admin.js.dapil.store-dapil')
    @include('admin.js.dapil.delete-dapil')
    @include('admin.js.dapil.show-kecamatan')
    @include('admin.js.dapil.update-kecamatan')
    @include('admin.js.dapil.delete-kecamatan')

    <script>
        $('#modal-dapil').on('shown.bs.modal', function() {
            $('#dapil').focus();
        })

        $('#modal-kecamatan').on('shown.bs.modal', function() {
            $('#kecamatan').focus();
        })

        $('#modal-dapil').on('hidden.bs.modal', function() {
            $('#dapil').val('');
        })

        $('#modal-kecamatan').on('hidden.bs.modal', function() {
            $('#kecamatan').val('');
            $('.select2-selection__rendered li:not(:last-child)').remove();
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
