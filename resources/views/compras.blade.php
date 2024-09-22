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
                                                <td>Fecha est. Entrega</td>
                                                <td>Fecha ef. Entrega</td>
                                                <td>Status</td>
                                                <td>Bodega</td>
                                                <td>Acciones</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($item->compras as $key => $compra)

                                            <tr>
                                                <td>{{$compra->cantidad}}</td>
                                                <td>{{$compra->f_compra}}</td>
                                                <td>{{$compra->f_estimada_ent}}</td>
                                                <td>{{$compra->f_entrega}}</td>
                                                <td>{{$compra->status}}</td>
                                                <td>
                                                @foreach($bodegas as $bodega)
                                                @if($bodega->id == $compra->bodega_id)
                                                {{$bodega->nombre}}
                                                @endif
                                                @endforeach
                                                </td>

                                                <td><button type="button" class="btn btn-danger fa fa-trash eliminar" target="{{$compra->id}}">
                                                    <button type="button" class="btn btn-primary fa fa-edit editar" data-toggle="modal" data-target="#modal-default" target="{{$compra->id}}"> 
                                                    </td>
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
                                        <div class="form-group">
                                            <label>Fecha estimada de entrega:</label>
                                            <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                                <div class="input-group-prepend" data-target="#reservationdate2" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2" name="f_estimada_ent">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Fecha efectiva de entrega:</label>
                                            <div class="input-group date" id="reservationdate3" data-target-input="nearest">
                                                <div class="input-group-prepend" data-target="#reservationdate3" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate3" name="f_entrega">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Estatus:</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text"><i class="fa fa-check"></i></div>
                                                </div>
                                                <select class="form-control" name="status">
                                                    <option value="Comprado">Comprado</option>
                                                    <option value="En tránsito">En tránsito</option>
                                                    <option value="Entregado">Entregado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Bodega:</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend" >
                                                    <div class="input-group-text"><i class="fa fa-check"></i></div>
                                                </div>
                                                <select class="form-control" name="bodega_id" >
                                                    <option selected disabled>Seleccione...</option>
                                                    @foreach($bodegas as $bodega)
                                                    <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                                    @endforeach
                                                </select>
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

        <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar elemento</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="body-replace">
                        <!--Formulario edición-->
                        <form method="POST" action="{{route('registrar.storeadq')}}" id="modal-form">
                            @csrf
                            <div class="form-group">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">#</span>
                                </div>
                                <input type="number" name="cat_item_id" value="{{$item->id}}" hidden>
                                <input type="number" id="mod_it_cant" class="form-control" placeholder="Compras" name="cantidad">
                            </div>
                            <div class="form-group">
                                <input type="text" name="id" id="mod_it_id" value="{{ old('id') }}" hidden>
                                <label>Fecha compra:</label>
                                <div class="input-group date" id="reservationdate4" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#reservationdate4" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate4" name="f_compra" id="mod_it_f_comp">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha estimada de entrega:</label>
                                <div class="input-group date" id="reservationdate5" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#reservationdate5" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate5" name="f_estimada_ent" id="mod_it_f_es_en">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha efectiva de entrega:</label>
                                <div class="input-group date" id="reservationdate6" data-target-input="nearest">
                                    <div class="input-group-prepend" data-target="#reservationdate6" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                    <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate6" name="f_entrega" id="mod_it_f_ef_en">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Estatus:</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend" >
                                        <div class="input-group-text"><i class="fa fa-check"></i></div>
                                    </div>
                                    <select class="form-control" name="status" id="mod_it_stat">
                                        <option value="Comprado">Comprado</option>
                                        <option value="En tránsito">En tránsito</option>
                                        <option value="Entregado">Entregado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Bodega:</label>
                                <div class="input-group date">
                                    <div class="input-group-prepend" >
                                        <div class="input-group-text"><i class="fa fa-check"></i></div>
                                    </div>
                                    <select class="form-control" name="bodega_id" id="mod_it_bod">
                                        <option selected disabled>Seleccione...</option>
                                        @foreach($bodegas as $bodega)
                                        <option value="{{$bodega->id}}">{{$bodega->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--<button type="submit" class="btn btn-primary float-right">Enviar</button>-->
                            

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-send">Enviar</button>
                        </form>
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
        $('#reservationdate2').datetimepicker({
            format: 'L',
            locale: 'es'
        });
        $('#reservationdate3').datetimepicker({
            format: 'L',
            locale: 'es'
        });
        $('#reservationdate4').datetimepicker({
            format: 'L',
            locale: 'es'
        });
        $('#reservationdate5').datetimepicker({
            format: 'L',
            locale: 'es'
        });
        $('#reservationdate6').datetimepicker({
            format: 'L',
            locale: 'es'
        });
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
                $(".editar").on('click', function(){
                    var boton = $(this);
                    $.ajax({
                      type: "GET",
                      "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                      url: "/compra/"+boton.attr("target"),
                  //data: data,
                      success: function(result){
                    //console.log(result)
                        var res= JSON.parse(result)
                        $("#mod_it_stat").val(res.status)
                        $("#mod_it_bod").val(res.bodega_id)
                        var parts = res.f_compra.split("-");
                        var date = new Date(parts[0],parts[1],parts[2]);
                        var formattedDate = `${date.getMonth()}/${date.getDate()}/${date.getFullYear()}`;
                        $("#mod_it_cant").val(res.cantidad);
                        $("#mod_it_id").val(res.id);
                        $("#mod_it_f_comp").val(formattedDate);
                        parts = res.f_estimada_ent.split("-");
                        date = new Date(parts[0],parts[1],parts[2]);
                        formattedDate = `${date.getMonth()}/${date.getDate()}/${date.getFullYear()}`;
                        $("#mod_it_f_es_en").val(formattedDate);
                        parts = res.f_entrega.split("-");
                        date = new Date(parts[0],parts[1],parts[2]);
                        formattedDate = `${date.getMonth()}/${date.getDate()}/${date.getFullYear()}`;
                        $("#mod_it_f_ef_en").val(formattedDate);
                        
                    },
                    error: function(request, status, error){
                        alert(request.responseText)
                    }
                  //dataType: dataType
                });

            });//fin editar
                $("#modal-send").on('click', function(){
                    $.ajax({
                      type: "POST",
                      "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                      url: "{{route('registrar.storeadq')}}",
                      data: $("#modal-form").serialize(),
                      success: function(result){
                    //boton.closest("tr").remove();
                        alert("Guardado")
                        location.reload();
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
