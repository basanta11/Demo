<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="">
  <div class="c-sidebar-brand d-md-down-none">
    <img src="{{ env('APP_URL', '') }}/assets/brand/coreui-base.svg" width="118" height="46"></img>
    
    <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
    <use xlink:href="assets/brand/coreui-pro.svg#signet"></use>
    </svg>
    </div>
  <ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="index.html">
        <svg class="c-sidebar-nav-icon">
          <use xlink:href="node_modules/@coreui/icons/sprites/free.svg#cil-speedometer"></use>
        </svg> Dashboard<span class="badge badge-info">NEW</span></a></li>
   {{-- Category --}}
        <li class="c-sidebar-nav-item">
          <router-link :to="{ name: 'category' }" class="c-sidebar-nav-link">
            <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
            Category<span class="badge badge-info">
            </span></router-link>
        </li>
{{-- Settings --}}
    <li class="c-sidebar-nav-item">
      <router-link :to="{ name: 'settings' }" class="c-sidebar-nav-link">
        <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
        Settings<span class="badge badge-info">
        </span></router-link>
    </li>
    <li class="c-sidebar-nav-item">
      <router-link :to="{ name: 'area' }" class="c-sidebar-nav-link">
        <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
        Area<span class="badge badge-info">
        </span></router-link>
    </li>
  </li>
     <li class="c-sidebar-nav-item">
      <router-link :to="{ name: 'packages' }" class="c-sidebar-nav-link">
        <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
        Packages<span class="badge badge-info">
        </span></router-link>
    </li>
  </li>
  <li class="c-sidebar-nav-item">
    <router-link :to="{ name: 'add.feild' }" class="c-sidebar-nav-link">
      <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
      Add Feild<span class="badge badge-info">
      </span></router-link>
  </li>
  <li class="c-sidebar-nav-item">
    <router-link :to="{ name: 'users' }" class="c-sidebar-nav-link">
      <img class="c-sidebar-nav-icon" src="{{ env('APP_URL', '') }}/assets/icons/applications.svg" width="118" height="46"></img>
      Users<span class="badge badge-info">
      </span></router-link>
  </li>
  
    <li class="c-sidebar-nav-item"><a href="/logout" class="c-sidebar-nav-link"><i class="sl sl-icon-power"></i> Logout</a></li>

   
  </ul>
  <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
    data-class="c-sidebar-minimized"></button>
</div>