<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <x-s-link class="navbar-brand" :href="route('dashboard')">
        <x-nav-logo class="brand-image img-circle elevation-3" style="opacity: .8"/>
        
        <span class="brand-text font-weight-light">Inventario</span>
      </x-s-link>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <x-s-link :href="route('dashboard')" class="nav-link">Home</x-s-link>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Búsqueda</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
              <li><x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">{{ __('Resumen') }}</x-nav-link></li>
              <li><x-nav-link :href="route('registrar.view')" :active="request()->routeIs('registrar.view')">{{ __('Registrar') }}</x-nav-link></li>

            </ul>
          </li>
          <li class="nav-item">
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-s-link :href="route('logout')" class="nav-link" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Salir</x-s-link>
            </form>
          </li>
         
        </ul>

        

      
    </div>
  </nav>

