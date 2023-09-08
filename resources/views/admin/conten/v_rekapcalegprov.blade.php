@extends('admin.layout.main')

@section('title', 'Calon bubernur')
@push('mycss')
    <style>
        fieldset.scheduler-border {
            border: 1px groove #ddd !important;
            padding: 0 1.4em 1.4em 1.4em !important;
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
        }

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
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('asset') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
@endpush
<script src="{{ asset('asset') }}/grafik/js/Chart.js"></script>

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <section class="content">
        <div class="container-fluid">
            <fieldset class="scheduler-border">
                <legend class="scheduler-border">Perolehan Suara Sah Calon DPR Provinsi</legend>
                <div class="card">
                    <h2 class="card-title mx-auto font-weight-bold mt-3">--- DAERAH PEMILIHAN ----</h2>
                    <h2 class="card-title mx-auto font-weight-bold">{!! $daerah_pemilihan !!}</h2>
                    <div class="card-body">
                        <div class="col-md-12 mx-auto">
                            <canvas id="my_Chart" width=250 height=100></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 my-5">
                    <div class="card">
                        <h2 class="card-title mx-auto font-weight-bold mt-3">--- DAERAH PEMILIHAN ----</h2>
                        <h2 class="card-title mx-auto font-weight-bold">{!! $daerah_pemilihan !!}</h2>
                        <h2 class="card-title mx-auto">{{ $tabel_pemilihan ?? '' }}</h2>
                        <div class="card-header ">
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-bordered table-hover display nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" style="width: 5%;">No</th>
                                        <th class="text-center align-middle" style="width: 160px;">Nama Calon
                                            DPR Provinsi</th>
                                        @foreach ($headers as $header)
                                            <th class="text-center" style="width: 160px;">
                                                @if ($ket == 'kab')
                                                    <a href="{{ url('rekapcalegprov/kec/' . $header->id) }}">
                                                        {{ $header->title }}
                                                    </a>
                                                @elseif($ket == 'kec')
                                                    <a href="{{ url('rekapcalegprov/desa/' . $header->id) }}">
                                                        {{ $header->title }}
                                                    </a>
                                                @elseif($ket == 'desa')
                                                    TPS {{ $header->title }}
                                                @endif
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $partai)
                                        <tr>
                                            <td class="text-center">
                                                {{ sprintf('%02d', $partai->no_urut) }}
                                            </td>
                                            <td>
                                                <span class="d-none">{{ $partai->singkatan }}</span> {{ $partai->nama }}
                                            </td>
                                            @foreach ($headers as $header)
                                                <td class="text-center">
                                                    @if ($ket == 'kab')
                                                        {{ $partai->suarapartaiprov->where('kecamatan_id', $header->id)->first()->jumlah ?? 0 > 0 ? $partai->suarapartaiprov->where('kecamatan_id', $header->id)->first()->jumlah : '-' }}
                                                    @elseif($ket == 'kec')
                                                        {{ $partai->suarapartaiprov->where('desa_id', $header->id)->first()->jumlah ?? 0 > 0 ? $partai->suarapartaiprov->where('desa_id', $header->id)->first()->jumlah : '-' }}
                                                    @elseif($ket == 'desa')
                                                        {{ $partai->suarapartaiprov->where('tps_id', $header->id)->first()->jumlah ?? 0 > 0 ? $partai->suarapartaiprov->where('tps_id', $header->id)->first()->jumlah : '-' }}
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                        @foreach ($partai->caleg as $caleg)
                                            <tr>
                                                <td><span class="d-none">{{ sprintf('%02d', $partai->no_urut) }}</span>
                                                </td>
                                                <td class="text-muted">
                                                    <span class="m-2"></span>{{ $caleg->nama }}
                                                </td>
                                                @foreach ($headers as $header)
                                                    <td class="text-center text-muted">
                                                        @if ($ket == 'kab')
                                                            {{ $caleg->suaracalegprov->where('kecamatan_id', $header->id)->sum('jumlah') ?? 0 > 0 ? $caleg->suaracalegprov->where('kecamatan_id', $header->id)->sum('jumlah') : '-' }}
                                                        @elseif ($ket == 'kec')
                                                            {{ $caleg->suaracalegprov->where('desa_id', $header->id)->sum('jumlah') ?? 0 > 0 ? $caleg->suaracalegprov->where('desa_id', $header->id)->sum('jumlah') : '-' }}
                                                        @elseif($ket == 'desa')
                                                            {{ $caleg->suaracalegprov->where('tps_id', $header->id)->first()->jumlah ?? '-' }}
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </fieldset>
        </div>
    </section>
@endsection
@push('java')
    <script src="{{ asset('asset') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('asset') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script type="text/javascript">
        var myData = {
            labels: [
                @foreach ($data as $grafik)
                    '{{ $grafik->singkatan }}',
                @endforeach
            ],
            datasets: [{
                label: "Jumlah Suara ",
                fill: false,
                backgroundColor: ['#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00', '#bfff00',
                    '#80ff00', '#40ff00', '#00ff00', '#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00',
                    '#bfff00',
                    '#80ff00', '#40ff00', '#00ff00', '#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00',
                    '#bfff00',
                    '#80ff00', '#40ff00', '#00ff00', '#ff0000', '#ff4000', '#ff8000', '#ffbf00', '#ffff00',
                    '#bfff00',
                    '#80ff00', '#40ff00', '#00ff00'
                ],
                borderColor: 'black',
                data: [
                    @foreach ($data as $grafik)
                        "{{ $grafik->suaracalegprov[0]->total ?? 0 }}",
                    @endforeach
                ],
            }]
        };
        var myoption = {
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
            hover: {
                animationDuration: 1
            },
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function() {
                    var chartInstance = this.chart,
                        ctx = chartInstance.ctx;
                    ctx.textAlign = 'center';
                    ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function(bar, index) {
                            var data = dataset.data[index];
                            ctx.fillText(data, bar._model.x, bar._model.y - 5);

                        });
                    });
                }
            }
        };
        var ctx = document.getElementById('my_Chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Define chart type
            data: myData, // Chart data
            options: myoption // Chart Options [This is optional paramenter use to add some extra things in the chart].
        });
        $(function() {

            $("#example").DataTable({
                "scrollX": true,
                "buttons": ["excel", "pdf"],
                "lengthMenu": [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
            }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

        });

        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td_no = tr[i].getElementsByTagName("td")[0];
                td_name = tr[i].getElementsByTagName("td")[1];
                if (td_no || td_name) {
                    txtValue_no = td_no.textContent || td_no.innerText;
                    txtValue_name = td_name.textContent || td_name.innerText;
                    console.log(txtValue_no.toUpperCase().indexOf(filter));
                    if (txtValue_no.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });
        });
    </script>
@endpush
