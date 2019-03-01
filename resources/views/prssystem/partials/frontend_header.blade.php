<div style="background-color: #FFF; width: 100%;">
         <div id="shopify-section-header-top" class="shopify-section">
            <div id="header" data-section-id="header-top" data-section-type="header-section">
               <header class="site-header" role="banner">
                  <div class="header-nav">
                     <div class="page-width">
                        <div class="row">
                           <div class="col-xs-12 col-sm-12 col-md-8 left-nav">
                              <div id="ishiheaderblock" class="ishiheaderblockTop">
                                 <span>BECOME SELLER CALL US +(91) 9015446567</span>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-12 col-md-4 right-nav rowInner" >
                              <div class="follow-us">
                                 <div id="social-icon-container" class="social-icon-inner">
                                    <div class="social-media-blocks">
                                       <div class="social-icon-inner">
                                          <div class="header-social">
                                             <ul class="list--inline site-footer__social-icons social-icons">
                                                <li class="facebook">
                                                   <a class="social-icons__link" href="https://www.facebook.com/Go4shop-328846894387347" title="smartshop.ishi on Facebook" target="_blank">
                                                   <i class="fa fa-facebook" aria-hidden="true"></i>
                                                   <span class="icon__-text">Facebook</span>
                                                   </a>
                                                </li>
                                                <li class="twitter">
                                                   <a class="social-icons__link" href="https://twitter.com/go4shoponline" title="smartshop.ishi on Twitter" target="_blank">
                                                   <i class="fa fa-twitter" aria-hidden="true"></i>
                                                   <span class="icon__-text">Twitter</span>
                                                   </a>
                                                </li>
                                                <li class="pinterest">
                                                   <a class="social-icons__link" href="#" title="smartshop.ishi on Pinterest" target="_blank">
                                                   <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                                                   <span class="icon__-text">Pinterest</span>
                                                   </a>
                                                </li>
                                                <li class="instagram">
                                                   <a class="social-icons__link" href="#" title="smartshop.ishi on Instagram" target="_blank">
                                                   <i class="fa fa-instagram" aria-hidden="true"></i>
                                                   <span class="icon__-text">Instagram</span>
                                                   </a>
                                                </li>
                                                <li class="youtube">
                                                   <a class="social-icons__link" href="https://plus.google.com/u/0/116367403319178553544" title="smartshop.ishi on YouTube" target="_blank">
                                                   <i class="fa fa-youtube-play" aria-hidden="true"></i>
                                                   <span class="icon__-text">YouTube</span>
                                                   </a>
                                                </li>
                                             </ul>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="header-top site-header-inner rowInner">
                     <div class="page-width">
                        <div class="row">
                           <div class="header-logo-section header-top-left col-md-1">
                              <h1 class="h2 header__logo" itemscope="" itemtype="http://schema.org/Organization">
                                 <a href="{{env('APP_URL')}}" itemprop="url" class="header__logo-image">
                                 <img src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/rsz_go4shoponline.jpg" alt="discover" class="logo-bar__image" height="80" style="border-radius: 15%">
                                 </a>
                              </h1>
                           </div>
                           <div id="_desktop_search" class="site-header__search  hidden-lg-down col-md-4">
                              <div class="search-title clearfix collapsed" data-target="#search-container-full" data-toggle="collapse">
                                 <span class="search-toggle"></span>
                              </div>
                           </div>

                           <div class="header-top-right-corner col-md-6">
                              <div id="_desktop_cart" class="hidden-lg-down">
                                 <div class="cart-display">
                                    <!-- <div class="cart-title clearfix collapsed" data-target="#cart-container" data-toggle="collapse"> -->
                                    <div class="cart-title clearfix collapsed">
                                       <div class="site-header__cart expand-more">
                                          <div class="cart-img">
                                             <span class="cart-logo"></span>
                                             <span class="cart-qty hidden-lg-up">{{session('countItem')}}</span>
                                          </div>
                                          <a href="{{route('cart')}}">
                                          <div class="cart-price text-content hidden-lg-down">
                                             <span class="cart-count main-title">
                                             <span class="cart-title">Shopping Cart - 
                                             <span class="cart-qty">{{session('countItem')}}</span>
                                             </span>
                                             </span>
                                          </div>
                                       </a>
                                       </div>
                                    </div>
                                   <!--  <div id="cart-container" class="cart-dropdown-inner cart-dropdown collapse">
                                       <div class="cart-container-inner" data-section-id="header-top" data-section-type="cart-template">
                                          <div class="product-list hide"></div>
                                          <div class="cart__footer hide">
                                             <div class="grid">
                                                <div class="grid__item ">
                                                   <div>
                                                      <span class="cart__subtotal-title">Subtotal</span>
                                                      <span class="cart__subtotal">$0.00</span>          
                                                   </div>
                                                   <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                                                   <div class="cart-links">
                                                      <a class="btn checkout-btn" href="#checkout">checkout</a>
                                                      <a class="view-cart btn" href="#cart">Your cart</a>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="cart__empty">
                                             <span class="cart--empty-message">Your cart is currently empty.</span>
                                             <div class="cookie-message">
                                                <p>Enable cookies to use the shopping cart</p>
                                             </div>
                                          </div>
                                       </div>
                                    </div> -->
                                 </div>
                              </div>
                              
                              <div id="_desktop_user_info" class="user_info full-width hidden-lg-down">
                                 <div class="userinfo-title clearfix collapsed" data-target="#userinfo-container" data-toggle="collapse">
                                    <span class="userinfo-toggle"></span>
                                    <span class="user-content text-content">
                                    <span class="user-title main-title">
                                    Account
                                    </span>
                                    </span>
                                 </div>
                                 <div id="userinfo-container" class="userinfo-inner collapse">
                                    <ul class="header-bar__module header-bar__module--list">
                                       @if(Auth::user())
                                          <li class="log-in">
                                            <a href="{{route('dashboard')}}" id="customer_login_link">Profile</a>
                                          </li>
                                          <li class="logout">
                                            <a href="{{route('logout')}}" id="customer_register_link">Logout</a>
                                          </li>
                                       @else
                                          <li class="log-in">
                                            <a href="{{route('login')}}" id="customer_login_link">Log In</a>
                                          </li>

                                          <li class="create_account">
                                            <a href="{{route('create')}}" id="customer_register_link">Create Account</a>
                                          </li>

                                          <li class="create_account" style="border-top: 0px;">
                                            <a href="{{route('becomeseller')}}" id="customer_register_link">Become Seller</a>
                                          </li>
                                          
                                          <li class="wishlist"><a href="/pages/wishlist">Wishlist</a></li>
                                       @endif
                                    </ul>
                                    
                                 </div>
                              </div>


                              <div id="ishiheadercontactblock">
                                 <div class="call-img"></div>
                                 <div class="call-num">+91-9015446567</div>
                              </div>
                           </div>
                              
                        </div>
                     </div>
                  </div>
                  <div class="mobile-width hidden-lg-up">
                     <div class="page-width">
                        <!--Mobile Menu Start Here-->
                              @include('prssystem.partials.mobilemenu')
                              <!--Mobile Menu Ends Here-->
                        <div class="row">
                           <div class="mobile-width-left col-xs-12">
                              <div style="width: 100px; float: left;">
                                 <div id="menu-icon" class="menu-icon hidden-lg-up">
                                   <i class="fa fa-bars" aria-hidden="true"></i>
                                   <a href="{{env('APP_URL')}}" itemprop="url" class="header__logo-image">
                                   <span style="color: #FFF;font-size: 18px;font-weight: bold; font-family:cursive;display: block;position: relative;top:-13px;left: 40%">Go4Shop</span></a>
                                </div>
                              </div>
                              <div style="width:200px;float: right; text-align: right;">
                                 <div id="menu-icon" class="menu-icon hidden-lg-up collapsed" data-target="#userinfo-container-m" data-toggle="collapse">
                                    <i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                 </div>
                                 
                              </div>
                           </div>
                           <div id="userinfo-container-m" class="userinfo-inner collapse" style="background-color: #FFF; width: 100%; padding:5px 5px 10px 5px; font-size: 14px;">
                              <ul class="header-bar__module header-bar__module--list">
                                 @if(Auth::user())
                                    <li class="log-in" style="margin-bottom:5px;">
                                      <a href="{{route('dashboard')}}" id="customer_login_link">Profile</a>
                                    </li>
                                    <li class="logout" style="margin-bottom:5px;">
                                      <a href="{{route('logout')}}" id="customer_register_link">Logout</a>
                                    </li>
                                 @else
                                    <li class="log-in" style="margin-bottom:5px;">
                                      <a href="/account/login" id="customer_login_link">Log In</a>
                                    </li>

                                    <li class="create_account" style="margin-bottom:5px;">
                                      <a href="/account/register" id="customer_register_link">Create Account</a>
                                    </li>
                                 @endif
                              </ul>
                              
                           </div>
                        </div>

                     </div>
                  </div>
               </header>
            </div>
         </div>
         <div class="wrapper-nav hidden-lg-down">
            <div class="navfullwidth">
               <div class="page-width">
                  <div class="row">
                     <div id="shopify-section-Ishi_megamenu" class="shopify-section">
                        <div data-section-id="Ishi_megamenu" data-section-type="megamenu-section" class="megamenu-section hidden-lg-down">
                           <div id="_desktop_top_menu" class="menu js-top-menu hidden-sm-down" role="navigation">
                              <ul class="top-menu" id="top-menu">
                                 <li class="category">
                                    <span class="float-xs-right hidden-lg-up">
                                    <span data-target="#_n_child-one1" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                    <i class="material-icons add"></i>
                                    <i class="material-icons remove"></i>
                                    </span>
                                    </span>
                                    <a href="#" class="dropdown-item">
                                       <h3 class="title">Grocery</h3>
                                    </a>
                                    <div class="popover sub-menu js-sub-menu collapse" id="_n_child-one1" style="width: 630px;">
                                       <ul class="top-menu mainmenu-dropdown">
                                          <li class="sub-category">
                                             <span class="float-xs-right hidden-lg-up">
                                             <span data-target="#_n_grand-child-one1" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                             <i class="material-icons add"></i>
                                             <i class="material-icons remove"></i>
                                             </span>
                                             </span>
                                             <a href="#" class="dropdown-item dropdown-submenu">
                                                <h3 class="inner-title">Fruits</h3>
                                             </a>
                                             <div class="top-menu collapse" id="_n_grand-child-one1">
                                                <ul class="top-menu">
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">peach</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">kiwi</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">apple</a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </li>
                                          <li class="sub-category">
                                             <span class="float-xs-right hidden-lg-up">
                                             <span data-target="#_n_grand-child-two1" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                             <i class="material-icons add"></i>
                                             <i class="material-icons remove"></i>
                                             </span>
                                             </span>
                                             <a href="#" class="dropdown-item dropdown-submenu">
                                                <h3 class="inner-title">Furniture</h3>
                                             </a>
                                             <div class="top-menu collapse" id="_n_grand-child-two1">
                                                <ul class="top-menu">
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Sofa</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Beds</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Tables</a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </li>
                                          <li class="sub-category">
                                             <span class="float-xs-right hidden-lg-up">
                                             <span data-target="#_n_grand-child-three1" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                             <i class="material-icons add"></i>
                                             <i class="material-icons remove"></i>
                                             </span>
                                             </span>
                                             <a href="#" class="dropdown-item dropdown-submenu">
                                                <h3 class="inner-title">Grocery Products</h3>
                                             </a>
                                             <div class="top-menu collapse" id="_n_grand-child-three1">
                                                <ul class="top-menu">
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Dry Fruits</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Dairy Products</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#" class="dropdown-item">Beverages</a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </li>
                                       </ul>
                                       <div class="img-container row">
                                          <div class="col-xs-12 imagecontainer1">
                                             <a href="#" class="link">
                                             	<img class="grid-view-item__image" src="{{ Config('global.THEME_URL_FRONT_IMAGE') }}/banner/5_b97214ba-0c43-4d43-b1ab-2220c8efc1d2_640x350.jpg" data-src="" data-widths="[640]" data-sizes="auto" alt="IMAGE" style="max-width: 0.0px;">
                                             <img class="feature-row__image lazyautosizes lazyloaded" src="./smartshop.ishi_files/Category_600x150.jpg" data-widths="[180, 360, 540, 720, 900, 1080, 1296, 1512, 1728, 2048]" data-aspectratio="4.2" data-sizes="auto" alt="" sizes="600px">
                                             </a>
                                          </div>
                                          <div class="col-xs-6 imagecontainer2">
                                          </div>
                                       </div>
                                    </div>
                                 </li>
                                 
                                <!--  <li class="category">
                                    <span class="float-xs-right hidden-lg-up">
                                    </span>
                                    <a href="#blogs/organics" class="dropdown-item">
                                       <h3 class="title">BLOG</h3>
                                    </a>
                                 </li> -->
                                 <li class="category">
                                    <span class="float-xs-right hidden-lg-up">
                                    <span data-target="#_n_child-one4" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                    <i class="material-icons add"></i>
                                    <i class="material-icons remove"></i>
                                    </span>
                                    </span>
                                    <a href="#collections/organic-products" class="dropdown-item">
                                       <h3 class="title">BEST SELLERS</h3>
                                    </a>
                                    <div class="popover sub-menu js-sub-menu collapse" id="_n_child-one4" style="width: 230px;">
                                       <ul class="top-menu mainmenu-dropdown">
                                          <li class="sub-category">
                                             <span class="float-xs-right hidden-lg-up">
                                             <span data-target="#_n_grand-child-one4" data-toggle="collapse" class="navbar-toggler collapse-icons clearfix collapsed">
                                             <i class="material-icons add"></i>
                                             <i class="material-icons remove"></i>
                                             </span>
                                             </span>
                                             <a href="#collections/organics" class="dropdown-item dropdown-submenu">
                                                <h3 class="inner-title">Furniture Shop</h3>
                                             </a>
                                             <div class="top-menu collapse" id="_n_grand-child-one4">
                                                <ul class="top-menu">
                                                   <li class="category">
                                                      <a href="#collections/vegetables" class="dropdown-item">Sofa</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#collections/fruits" class="dropdown-item">Bed</a>
                                                   </li>
                                                   <li class="category">
                                                      <a href="#collections/organic-products" class="dropdown-item">Tables</a>
                                                   </li>
                                                </ul>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                 </li>
                                 <li class="category">
                                    <span class="float-xs-right hidden-lg-up">
                                    </span>
                                    <a href="{{route('register')}}" class="dropdown-item">
                                       <h3 class="title">BECOME SELLER</h3>
                                    </a>
                                 </li>
                                 <li class="category">
                                    <span class="float-xs-right hidden-lg-up">
                                    </span>
                                    <a href="{{route('contactuspage')}}" class="dropdown-item">
                                       <h3 class="title">CONTACT</h3>
                                    </a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                    <!--  <div id="shopify-section-Ishi_offer" class="shopify-section shopify-section" style="display: none;">
                        <div id="ishioffersblock">
                           <div class="offer-title"> 
                              SPECIAL OFFER !
                           </div>
                           <div class="typed"><a href="#">
                              <span>FLAT 30% OFF ALL PURCHASE</span>
                              </a>
                           </div>
                        </div>
                        
                     </div> -->
                  </div>
               </div>
            </div>
         </div>

         
      </div>
<div class="clearfix"></div>