    <?php 
    $routeName = \Request::route()->getName();
    $userRoutes = ['administrator.users.index','administrator.users.create','administrator.users.edit','administrator.roles.index','administrator.roles.create','administrator.roles.edit'];
    $adRoutes = ['administrator.ads.index','administrator.terms.index'];
    $clientRoutes = ['administrator.clients.index','administrator.clients.create','administrator.clients.edit'];
   
    ?>
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="br-logo"><a href="">
       <img src="{{asset('img/logo-ams.png')}}">
    </a></div>
    <div class="br-sideleft sideleft-scrollbar">
      <label class="sidebar-label">Navigation</label>
      <ul class="br-sideleft-menu">
        <li class="br-menu-item">
          <a href="{{route('administrator.index')}}" class="br-menu-link @if($routeName == 'administrator.index') active @endif">
            <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
            <span class="menu-item-label">Dashboard</span>
          </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->


        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub @if(in_array($routeName,$userRoutes)) active @endif">
            <i class="menu-item-icon icon ion-ios-people-outline tx-20"></i>
            <span class="menu-item-label">Users</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('administrator.users.index')}}" class="sub-link  @if($routeName == 'administrator.users.index') active @endif">All Users</a></li>
            <li class="sub-item"><a href="{{route('administrator.users.create')}}" class="sub-link @if($routeName == 'administrator.users.create') active @endif">Add New</a></li>
            <li class="sub-item"><a href="{{route('administrator.roles.index')}}" class="sub-link @if($routeName == 'administrator.roles.index') active @endif">Roles</a></li>
          </ul>
        </li>
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub @if(in_array($routeName,$clientRoutes)) active @endif">
            <i class="menu-item-icon icon ion-ios-briefcase-outline tx-22"></i>
            <span class="menu-item-label">Clients</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('administrator.clients.index')}}" class="sub-link  @if($routeName == 'administrator.clients.index') active @endif">All Clients</a></li>
            <li class="sub-item"><a href="{{route('administrator.clients.create')}}" class="sub-link @if($routeName == 'administrator.clients.create') active @endif">Add New</a></li>
           
          </ul>
        </li>
        <li class="br-menu-item">
          <a href="#" class="br-menu-link with-sub @if(in_array($routeName,$adRoutes)) active @endif">
            <i class="menu-item-icon icon ion-ios-list-outline tx-22"></i>
            <span class="menu-item-label">Ads</span>
          </a><!-- br-menu-link -->
          <ul class="br-menu-sub">
            <li class="sub-item"><a href="{{route('administrator.ads.index')}}" class="sub-link @if($routeName == 'administrator.ads.index') active @endif">All Ads</a></li>
             <li class="sub-item"><a href="{{route('administrator.ads.create')}}" class="sub-link @if($routeName == 'administrator.ads.create') active @endif">Add New</a></li>
            <li class="sub-item"><a href="{{route('administrator.terms.index',['ad-type'])}}" class="sub-link @if($routeName == 'administrator.terms.index') active @endif">Ad types</a></li>
            <li class="sub-item"><a href="{{route('administrator.terms.index',['ad-category'])}}" class="sub-link @if($routeName == 'administrator.terms.index') active @endif">Ad categories</a></li>
          </ul>
        </li>
      
      </ul><!-- br-sideleft-menu -->
    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->
