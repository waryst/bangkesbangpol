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
                <legend class="scheduler-border">Perolehan Suara Sah Calon Bupati dan Wakil Bupati</legend>
                <div class="card">
                    <h2 class="card-title mx-auto font-weight-bold mt-3">--- DAERAH PEMILIHAN ----</h2>
                    <h2 class="card-title mx-auto font-weight-bold">{!! $daerah_pemilihan !!}</h2>
                    <div class="card-body">
                        <div class="col-md-5 mx-auto">
                            <canvas id="pieChart" width=200 height=200></canvas>
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
                            <table id="example1" class="table table-head-fixed table-bordered table-hover text-wrap">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle" style="width: 30%;">Wilayah</th>
                                        @foreach ($data_cabub as $cabub)
                                            <th class=" text-center">0{{ $cabub->no_urut }}<p>
                                                    {{ $cabub->nama_cabub }}<br>{{ $cabub->nama_cawabub }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>
                                                @if ($ket == 'kab')
                                                    <a href="{{ url('rekapcabub/kec/' . $data->id) }}">
                                                        {{ $data->title }}
                                                    </a>
                                                @elseif($ket == 'kec')
                                                    <a href="{{ url('rekapcabub/desa/' . $data->id) }}">
                                                        {{ $data->title }}
                                                    </a>
                                                @else
                                                    TPS {{ $data->title }}
                                                @endif
                                            </td>
                                            @foreach ($data_cabub as $detail_cabub)
                                                @if ($data->suaracabub->where('cabub_id', $detail_cabub->id)->groupBy('cabub_id')->count() === 0)
                                                    <td class="text-center"> 0</td>
                                                @else
                                                    @foreach ($data->suaracabub->where('cabub_id', $detail_cabub->id)->groupBy('cabub_id') as $hasil)
                                                        <td class="text-center">
                                                            {{ $hasil->sum('jumlah') }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </tr>
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
        var data = {
            datasets: [{
                data: [
                    @foreach ($data_cabub as $suara_cabub)
                        "{{ $suara_cabub->suaracabub->sum('jumlah') }}",
                    @endforeach
                ],
                backgroundColor: [
                    "#FF6384",
                    "#4BC0C0",
                    "#FFCE56",
                    "#E7E9ED",
                    "#36A2EB"
                ],
                label: 'My dataset' // for legend
            }],
            labels: [
                @foreach ($data_cabub as $label_cabub)
                    '{{ $label_cabub->nama_cabub }} - {{ $label_cabub->nama_cawabub }}',
                @endforeach
            ]
        };

        var pieOptions = {
            events: false,
            animation: {
                duration: 500,
                easing: "easeOutQuart",
                onComplete: function() {
                    var ctx = this.chart.ctx;
                    ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart
                        .defaults.global.defaultFontFamily);
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function(dataset) {

                        for (var i = 0; i < dataset.data.length; i++) {
                            var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
                                total = dataset._meta[Object.keys(dataset._meta)[0]].total,
                                mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius) /
                                2,
                                start_angle = model.startAngle,
                                end_angle = model.endAngle,
                                mid_angle = start_angle + (end_angle - start_angle) / 2;

                            var x = mid_radius * Math.cos(mid_angle);
                            var y = mid_radius * Math.sin(mid_angle);

                            ctx.fillStyle = '#fff';
                            if (i == 3) { // Darker text color for lighter background
                                ctx.fillStyle = '#444';
                            }
                            var percent = String(Math.round(dataset.data[i] / total * 100));
                            if (percent != 0) {
                                ctx.fillText("Jumlah Suara", model.x + x, model.y + y);
                                ctx.fillText(dataset.data[i] + " (" + percent + "%" + ")", model.x + x,
                                    model.y + y + 15);
                            }

                        }
                    });
                }
            }
        };

        var pieChartCanvas = $("#pieChart");
        var pieChart = new Chart(pieChartCanvas, {
            type: 'pie', // or doughnut
            data: data,
            options: pieOptions
        });


        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["excel", "pdf"],
                "lengthMenu": [
                    [25, 50, -1],
                    [25, 50, "All"]
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

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
