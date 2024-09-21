<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar') }}
        </h2>
    </x-slot>
    <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <div class="py-12">



        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Agregar adquisición</h3>
                @if(session()->get('alert_adq') == "Success")
                     <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                    Se envió correctamente.
                    </div>
                @endif
                @if( $errors->any())
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                    Hay algunos errores:
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>

                    @endforeach
                    </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('registrar.storeadq')}}">
                @csrf
                <div class="form-group">
                <label>Catalogo: </label>
                <select class="form-control select2" style="width: 100%;" name="cat_item_id">
                @foreach($elementos as $elemento)
                <option value="{{$elemento->id}}">{{$elemento->descripcion_compra}}</option>
                @endforeach
                </select>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">#</span>
                    </div>
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
                <button type="submit" class="btn btn-primary float-right">Enviar</button>
                </form>

            </div>

        </div>
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Agregar elemento</h3>
                @if(session()->get('alert_element') == "Success")
                     <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                    Se envió correctamente.
                    </div>
                @endif
                @if( $errors->any())
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                    Hay algunos errores:
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>

                    @endforeach
                    </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('registrar.storelem')}}">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" name="id" value="{{ old('id') }}" hidden>
                        <input type="text" class="form-control" placeholder="AT" name="at" value="{{ old('at') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Inventario" name="inv_no" value="{{ old('inv_no') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">D</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Descripción compra" name="descrpcion" value="{{ old('descrpcion') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">T</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Tipo" name="type" value="{{ old('type') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">#</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Cantidad máxima" name="max" value="{{ old('max') }}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">R</span>
                        </div>
                        <select name="responsable" class="form-control">
                            <option value="" disabled selected>Responsable</option>
                            <option name="Emerit">Emerit</option>
                            <option name="TecPluss">TecPluss</option>
                            <option name="Qplus">Qplus</option>
                            <option name="Novitech">Novitech</option>
                        </select>
                        
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary float-right">Enviar</button>
                </form>

            </div>

        </div>
        <!--Fin de registro componentes-->
        <!--Registro de bodegas-->
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Agregar Bodega</h3>
                @if(session()->get('alert_bodega') == "Success")
                     <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Correcto!</h5>
                    Se envió correctamente.
                    </div>
                @endif
                @if( $errors->any())
                    <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alerta!</h5>
                    Hay algunos errores:
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>

                    @endforeach
                    </ul>
                    </div>
                @endif
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('registrar.bodega')}}">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">N</span>
                        </div>
                        <input type="text" name="id" value="{{ old('id') }}" hidden>
                        <input type="text" class="form-control" placeholder="Nombre Bodega" name="nombre" value="{{ old('nombre') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">D</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Dirección Bodega" name="direccion" value="{{ old('direccion') }}">
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary float-right">Enviar</button>
                </form>

            </div>

        </div>
        <!--Fin registro bodegas-->

    </div>
    <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="/assets/plugins/moment/moment.min.js"></script>
    <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
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
        $('.select2').select2();
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

    </script>
</x-app-layout>