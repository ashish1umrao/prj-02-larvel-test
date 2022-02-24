<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/home" class="simple-text logo-normal">
      {{ __('Shop Far East') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ Request::path() == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <?php
          $currentURL = Request::url();
          $url_array =  explode('/', $currentURL) ;
          $CurrentMenu  = $url_array['3'];
      ?>
     <li class="nav-item {{ ($CurrentMenu == 'profile' || $CurrentMenu == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('User Details') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $CurrentMenu == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $CurrentMenu == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('users.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <?php //echo "<pre>"; print_r(Request::path()); //die; ?>
     <?php /*?><li class="nav-item{{ $CurrentMenu == 'users' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
          <i class="material-icons">people</i>
            <p>{{ __('User Management') }}</p>
        </a>
      </li><?php */?>
      <li class="nav-item{{ $CurrentMenu == 'category' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('CategoryIndex') }}">
          <i class="material-icons">category</i>
            <p>{{ __('Manage Category') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $CurrentMenu == 'cars' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cars') }}">
          <i class="material-icons">directions_car</i>
          <p>{{ __('Car') }}</p>
        </a>
      </li>
       <li class="nav-item{{ $CurrentMenu == 'cars_model' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('modelIndex') }}">
          <i class="material-icons">directions_car</i>
            <p>{{ __('Car Model') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $CurrentMenu == 'faq' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('faqIndex') }}">
          <i class="material-icons">quiz</i>
            <p>{{ __('FAQ') }}</p>
        </a>
      </li>
       <li class="nav-item{{ $CurrentMenu == 'cms' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cmsIndex') }}">
          <i class="material-icons">quiz</i>
            <p>{{ __('CMS Pages') }}</p>
        </a>
      </li>
      <?php /*?><li class="nav-item{{ $CurrentMenu == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $CurrentMenu == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $CurrentMenu == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>
      <li class="nav-item active-pro{{ $CurrentMenu == 'upgrade' ? ' active' : '' }}">
        <a class="nav-link text-white bg-danger" href="{{ route('upgrade') }}">
          <i class="material-icons text-white">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> <?php */?>
    </ul>
  </div>
</div>
