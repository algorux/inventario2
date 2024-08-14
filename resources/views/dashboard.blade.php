<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Navegar</h3>
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
                                <a href="{{route('resumen')}}" class="btn btn-primary btn-lg">Resumen</a>
                            </div>
                            <br>
                            <div class="row">
                                <a href="{{route('registrar.view')}}" class="btn btn-primary btn-lg">Registro</a>
                                
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
