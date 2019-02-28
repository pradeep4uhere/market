<div id="mobile_top_menu_wrapper" class="hidden-lg-up" style="display: none">
    <div class="list-group" style="font-size: 14px;display:">
      <button type="button" class="list-group-item list-group-item-action active"  style="background-color: #78a206; border-color: #78a206; font-family:cursive;">
        <div style="width:100px; float: left; font-size: 24px;padding-top: 15px;">Go4Shop</div>
        <div style="width:50px; float: right;">
            <div id="top_menu_closer"><span class="badge badge-primary badge-pill"><i class="material-icons"></i></span></div>
        </div>
        
      </button>
         <div class="js-top-menu mobile" id="_mobile_top_menu">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><i class="fa fa-home"></i>&nbsp;<a href="{{route('home')}}" id="customer_login_link">Home</a></li>
              <li class="list-group-item"><i class="fa fa-shopping-cart"></i>&nbsp;<a href="{{route('cart')}}">Shopping Cart -</a>
                <span class="badge badge-primary badge-pill">{{session('countItem')}}</span>
              </li>
              @if(Auth::user())
              <li class="list-group-item"><i class="fa fa-user"></i>&nbsp;<a href="{{route('dashboard')}}" id="customer_login_link">Profile</a></li>
              <li class="list-group-item"><i class="fa fa-bank"></i>&nbsp;<a href="{{route('seller')}}" id="customer_login_link">Seller Profile</a></li>
              <li class="list-group-item"><i class="fa fa-first-order"></i>&nbsp;<a href="{{route('dashboard')}}" id="customer_login_link">My Orders</a></li>
              <li class="list-group-item"><i class="fa fa-sign-out"></i>&nbsp;<a href="{{route('logout')}}" id="customer_register_link">Logout</a></li>
              @else
              <li class="list-group-item"><i class="fa fa-sign-in"></i>&nbsp;<a href="{{route('login')}}" id="customer_login_link">Log In</a></li>
              <li class="list-group-item"><i class="fa fa-user-plus"></i>&nbsp;<a href="{{route('create')}}" id="customer_register_link">Create Account</a></li>
              <li class="list-group-item"><i class="fa fa-user-plus"></i>&nbsp;<a href="{{route('becomeseller')}}" id="customer_register_link">Become Seller</a></li>
              @endif
            </ul>
    </div>
      
    </div>
 
</div>
