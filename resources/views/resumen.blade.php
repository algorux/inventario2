<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Resumen') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Resumen por componente</h3>
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
                            @foreach($compras as $key => $compra)
                                @if(!$key%3 )
                                </div>
                                <div class="row">
                                @endif
                                <div class="col-6 col-md-3 text-center">
                                    <div style="display:inline;width:120px;height:120px;"><canvas width="120" height="120"></canvas><input type="text" class="knob" value="{{round($compra->cantidad_ocupada*100/$compra->max_cap)}}" data-width="120" data-height="120" data-fgcolor="{{$compra->color}}" data-readonly="true" readonly="readonly" style="width: 49px; height: 30px; position: absolute; vertical-align: middle; margin-top: 30px; margin-left: -69px; border: 0px; background: none; font: bold 18px Arial; text-align: center; color: #0000; padding: 0px; appearance: none;"></div>
                                    <div class="knob-label"><a href="{{ route('componente_ver', ['id' => $compra->id]) }}">{{$compra->descripcion_compra}}: {{$compra->cantidad_ocupada}} de {{$compra->max_cap}} </a></div>
                                </div>



                            
                            @endforeach
                            </div>
                        </div>

                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Tabla por componente</h3>
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
                                <div class="col-12 col-md-12">
                            <table class="table table-bordered table-hover dataTable dtr-inline" id="dataTable">
                                <thead>
                                    <tr>
                                        <td>AT</td>
                                        <td>No. Inv.</td>
                                        <td>Componente</td>
                                        <td>Tipo</td>
                                        <td>Responsable</td>
                                        <td>Total a comprar</td>
                                        <td>Entregado</td>
                                        <td>Acciones</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($compras as $key => $compra)
                                
                                    <tr>
                                        <td>{{$compra->at}}</td>
                                        <td>{{$compra->inv_no}}</td>
                                        <td>{{$compra->descripcion_compra}}</td>
                                        <td>{{$compra->tipo}}</td>
                                        <td>{{$compra->responsable}}</td>
                                        <td>{{$compra->max_cap}}</td>
                                        <td>{{$compra->cantidad_ocupada}}</td>
                                        <td>
                                            <a class="btn btn-success fa fa-eye eliminar" href="{{ route('componente_ver', ['id' => $compra->id]) }}"></a><button type="button" class="btn btn-primary fa fa-edit editar" data-toggle="modal" data-target="#modal-default" target="{{$compra->id}}"> </td>
                                    </tr>
                            
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--modal-->
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
                        <form method="POST" action="{{route('registrar.storelem')}}" id="modal-form">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" name="id" value="{{ old('id') }}" hidden id="mod_it_id">
                        <input type="text" class="form-control" placeholder="AT" name="at" value="{{ old('at') }}" id="mod_it_at">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Inventario" name="inv_no" value="{{ old('inv_no') }}" id="mod_it_in">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">D</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Descripción compra" name="descrpcion" value="{{ old('descrpcion') }}" id="mod_it_des">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">T</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tipo" name="type" value="{{ old('type') }}" id="mod_it_typ">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Cantidad máxima" name="max" value="{{ old('max') }}" id="mod_it_max">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R</span>
                        </div>
                        <select name="responsable" class="form-control" id="mod_it_res">
                            <option value="" disabled selected>Responsable</option>
                            <option name="Emerit">Emerit</option>
                            <option name="TecPluss">TecPluss</option>
                            <option name="Qplus">Qplus</option>
                            <option name="Novitech">Novitech</option>
                        </select>
                        
                    </div>
                </div>
                
                
                </form>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="modal-send">Enviar</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    <!--fin modal-->

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


    <script>
      $(function () {
    /* jQueryKnob */

        $('.knob').knob({
      /*change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },*/
          draw: function () {

        // "tron" case
            if (this.$.data('skin') == 'tron') {

          var a   = this.angle(this.cv)  // Angle
          ,
              sa  = this.startAngle          // Previous start angle
              ,
              sat = this.startAngle         // Start angle
              ,
              ea                            // Previous end angle
              ,
              eat = sat + a                 // End angle
              ,
              r   = true

              this.g.lineWidth = this.lineWidth

              this.o.cursor
              && (sat = eat - 0.3)
              && (eat = eat + 0.3)

              if (this.o.displayPrevious) {
                ea = this.startAngle + this.angle(this.value)
                this.o.cursor
                && (sa = ea - 0.3)
                && (ea = ea + 0.3)
                this.g.beginPath()
                this.g.strokeStyle = this.previousColor
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false)
                this.g.stroke()
            }

            this.g.beginPath()
            this.g.strokeStyle = r ? this.o.fgColor : this.fgColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false)
            this.g.stroke()

            this.g.lineWidth = 2
            this.g.beginPath()
            this.g.strokeStyle = this.o.fgColor
            this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false)
            this.g.stroke()

            return false
        }
    }
})
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
        //var sparkline1 = new Sparkline($('#sparkline-1')[0], { width: 240, height: 70, lineColor: '#92c1dc', endColor: '#92c1dc' })
        //var sparkline2 = new Sparkline($('#sparkline-2')[0], { width: 240, height: 70, lineColor: '#f56954', endColor: '#f56954' })
        //var sparkline3 = new Sparkline($('#sparkline-3')[0], { width: 240, height: 70, lineColor: '#3af221', endColor: '#3af221' })

        //sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021])
        //sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921])
        //sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21])

    })
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
    $(document).ready(function(){
        $(".editar").on('click', function(){
                    var boton = $(this);
                    $.ajax({
                      type: "GET",
                      "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                      url: "/componente/"+boton.attr("target"),
                  //data: data,
                      success: function(result){
                    //console.log(result)
                        var res= JSON.parse(result)
                        
                        $("#mod_it_id").val(res.id);
                        $("#mod_it_res").val(res.responsable);

                        $("#mod_it_max").val(res.max_cap);

                        $("#mod_it_typ").val(res.descripcion)
                        $("#mod_it_des").val(res.descripcion_compra)
                        $("#mod_it_in").val(res.inv_no)
                        $("#mod_it_at").val(res.at_no)
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
                      url: "{{route('registrar.storelem')}}",
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
                    
                });//fin modal send
    });
</script>
</x-app-layout>
