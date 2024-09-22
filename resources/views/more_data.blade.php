<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="/assets/plugins/fullcalendar/main.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tablas por estatus</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        

                        <div class="card-body">
                            <!-- Tabla de comprados -->
                            <br>
                            <h3>Comprados</h3>
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>Componente</td>
                                        <td>Inv.</td>
                                        <td>AT</td>
                                        <td>Responsable</td>
                                        <td>Cantidad</td>
                                        <td>Fecha Compra</td>
                                        <td>Fecha Est. Entrega</td>
                                        <td>Fecha Efec. Entrega</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($t_compras as $item)
                                    <tr>
                                        <td>{{$item->item->descripcion_compra}}</td>
                                        <td>{{$item->item->inv_no}}</td>
                                        <td>{{$item->item->at_no}}</td>
                                        <td>{{$item->item->responsable}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->f_compra}}</td>
                                        <td>{{$item->f_estimada_ent}}</td>
                                        <td>{{$item->f_ent}}</td>
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <!-- Tabla de tránsito -->
                            <br>
                            <h3>En tránsito</h3>
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="dataTable2">
                                <thead>
                                    <tr>
                                        <td>Componente</td>
                                        <td>Inv.</td>
                                        <td>AT</td>
                                        <td>Responsable</td>
                                        <td>Cantidad</td>
                                        <td>Fecha Compra</td>
                                        <td>Fecha Est. Entrega</td>
                                        <td>Fecha Efec. Entrega</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($t_transito as $item)
                                    <tr>
                                        <td>{{$item->item->descripcion_compra}}</td>
                                        <td>{{$item->item->inv_no}}</td>
                                        <td>{{$item->item->at_no}}</td>
                                        <td>{{$item->item->responsable}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->f_compra}}</td>
                                        <td>{{$item->f_estimada_ent}}</td>
                                        <td>{{$item->f_ent}}</td>
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>
                            <!-- Tabla de entregados -->
                            <br>
                            <h3>Entregados</h3>
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="dataTable3">
                                <thead>
                                    <tr>
                                        <td>Componente</td>
                                        <td>Inv.</td>
                                        <td>AT</td>
                                        <td>Responsable</td>
                                        <td>Cantidad</td>
                                        <td>Fecha Compra</td>
                                        <td>Fecha Est. Entrega</td>
                                        <td>Fecha Efec. Entrega</td>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach($t_entregado as $item)
                                    <tr>
                                        <td>{{$item->item->descripcion_compra}}</td>
                                        <td>{{$item->item->inv_no}}</td>
                                        <td>{{$item->item->at_no}}</td>
                                        <td>{{$item->item->responsable}}</td>
                                        <td>{{$item->cantidad}}</td>
                                        <td>{{$item->f_compra}}</td>
                                        <td>{{$item->f_estimada_ent}}</td>
                                        <td>{{$item->f_ent}}</td>
                                    </tr>
                                        @endforeach
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

<!--Calendar-->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/fullcalendar/main.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Datatables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/plugins/jszip/jszip.min.js"></script>
<script src="/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>

  $('#dataTable').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

  $('#dataTable2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  }).buttons().container().appendTo('#dataTable2_wrapper .col-md-6:eq(0)');

$('#dataTable3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
  }).buttons().container().appendTo('#dataTable3_wrapper .col-md-6:eq(0)');
</script>
<script>
    $(function () {
        //--------------
        //- AREA CHART -
        //--------------

        // Get context with jQuery - using jQuery's .get() method.
        

        var areaChartData = {
          labels  : ['Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          datasets: [
            {
              label               : 'Comprados',
              backgroundColor     : 'rgba(60,141,188,0.9)',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : [{{implode(", ", $b_comprados)}}]
            },
            {
              label               : 'En tránsito',
              backgroundColor     : 'rgba(210, 214, 222, 1)',
              borderColor         : 'rgba(210, 214, 222, 1)',
              pointRadius         : false,
              pointColor          : 'rgba(210, 214, 222, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [{{implode(", ", $b_transito)}}]
            },

            {
              label               : 'Entregados',
              backgroundColor     : 'rgba(100, 120, 50, 1)',
              borderColor         : 'rgba(100, 120, 50, 1)',
              pointRadius         : false,
              pointColor          : 'rgba(100, 120, 50, 1)',
              pointStrokeColor    : '#c1c7d1',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(220,220,220,1)',
              data                : [{{implode(", ", $b_entregados)}}]
            },
          ]
        }
        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = $.extend(true, {}, areaChartData)
        var temp0 = areaChartData.datasets[0]
        var temp1 = areaChartData.datasets[1]
        barChartData.datasets[0] = temp1
        barChartData.datasets[1] = temp0

        var barChartOptions = {
          responsive              : true,
          maintainAspectRatio     : false,
          datasetFill             : false
        }

        new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })
        //-------------
        //- DONUT CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
        var donutData        = {
          labels: [
              'Comprados',
              'En tránsito',
              'Entregados',
              'Faltantes',
          ],
          datasets: [
            {
              data: [{{implode(", ",$status_data)}}],
              backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
            }
          ]
        }
        var donutOptions     = {
          maintainAspectRatio : false,
          responsive : true,
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        new Chart(donutChartCanvas, {
          type: 'doughnut',
          data: donutData,
          options: donutOptions
        })
    });
</script>
</x-app-layout>
