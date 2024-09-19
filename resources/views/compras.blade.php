<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resumen') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Descripción de compras</h3>
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
                            <div class="row">
                                <h1>Historial para: {{$item->descripcion_compra}}</h1>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>Cantidad comprada</td>
                                        <td>Fecha de compra</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item->compras as $key => $compra)
                                
                                    <tr>
                                        <td>{{$compra->cantidad}}</td>
                                        <td>{{$compra->f_compra}}</td>
                                        <td><button type="button" class="btn btn-danger fa fa-trash eliminar" target="{{$compra->id}}"> </td>
                                    </tr>
                            
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>

                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Agregar entrada para este componente</h3>
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
                            <div class="row">
                                

                            <form method="POST" action="{{route('registrar.storeadq')}}">
                            @csrf
                            <div class="form-group">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">#</span>
                                </div>
                                <input type="number" name="cat_item_id" value="{{$item->id}}" hidden>
                                <input type="number" class="form-control" placeholder="Compras" name="cantidad">
                            </div>
                            <div class="form-group">
                                <input type="text" name="id" value="{{ old('id') }}" hidden>
                                <label>Fecha:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="f_compra">
                                    
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary float-right">Enviar</button>
                            </form>




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="/assets/plugins/sparklines/sparkline.js"></script>
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

    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

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

</script>
<script type="text/javascript">
        $('#reservationdate').datetimepicker({
            format: 'L',
            locale: 'es'
        });
        //$('.select2').select2();
        //$('.select2bs4').select2({
        //  theme: 'bootstrap4'
        //})
        $(document).ready(
            
        function (){
            $(".eliminar").on('click', function(){
                var boton = $(this);
                $.ajax({
                  type: "DELETE",
                   "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                  url: "/compra/"+boton.attr("target"),
                  //data: data,
                  success: function(result){
                    boton.closest("tr").remove();
                  },
                  error: function(request, status, error){
                    alert(request.responseText)
                  }
                  //dataType: dataType
                });
            });

        });

    </script>
</x-app-layout>
