        <!-- left side start-->
        <div class="left-side sticky-left-side">

            <!--logo and iconic logo start-->
            <div class="logo">
                <h1><a href="#" style="font-size:14px">Welcome back, {{Auth::user()->first_name}}</span></a></h1>
            </div>
            <div class="logo-icon text-center">
                <a href="{{route('dashboard')}}"><i class="fa fa-home"></i> </a>
            </div>

            <!--logo and iconic logo end-->
            <div class="left-side-inner">

                <!--sidebar nav start-->
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li class="menu-list">
                        <a href="#"><i class="fa  fa-asterisk"></i>
                            <span>Dashboard</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('dashboard') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;User Profile</a> </li>
                            <li><a href="{{ route('sellerdashboard') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Seller Profile</a> </li>
                        </ul>
                    </li>
                   <li class="menu-list">
                        <a href="#"><i class="fa fa-shopping-cart"></i>
                            <span>My Orders</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Order</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-truck"></i><span>Delivery</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Add New</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Address List</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-cubes"></i>
                            <span>Products</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Add New Product</a> </li>
                            <li><a href="{{ route('allproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Product</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-user"></i>
                            <span>Seller Profile</span></a>
							
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('seller',['id'=>'2']) }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Profile</a> </li>
                            <li><a href="{{ route('sellerimggallery',['id'=>'2']) }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Image Gallery</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-users"></i>
                            <span>Customers</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Customer</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-bars"></i>
                            <span>Store Order</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Orders</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;New Orders</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Cancel Orders</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Retrun Orders</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-inr"></i>
                            <span>Payment</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Payments</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-line-chart"></i><span>Report</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Payments</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="lnr lnr-store"></i>
                            <span>Seller Setting</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Store Details</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;KYC Details</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Bank Details</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;GST Details</a> </li>
                            <li><a href="{{ route('addproduct') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Stop Selling</a> </li>
                        </ul>
                    </li>


                    
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-ticket"></i>
                            <span>Master List</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('allcategory') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;All Category</a> </li>
                            <li><a href="{{ route('getbrands') }}"> <i class="lnr lnr-chevron-right"></i>&nbsp;All Brands</a> </li>
                            <li><a href="{{ route('allunits') }}"> <i class="lnr lnr-chevron-right"></i>&nbsp;All Units</a> </li>
                        </ul>
                    </li> 
               
                    <?php if(Auth::user()->user_type==1001){ ?>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-pencil"></i>
                            <span>Content</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ url('admin/page/aboutus') }}"> <i class="lnr lnr-chevron-right"></i>&nbsp;Page List</a> </li>
                            <li><a href="{{ url('admin/p/faq/faqlist') }}"> <i class="lnr lnr-chevron-right"></i>&nbsp;FAQ List</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-envelope"></i>
                            <span>Contact Us</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('ContactUsList') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Contact Us</a> </li>
                            <li><a href="{{ route('addproduct') }}"> <i class="lnr lnr-chevron-right"></i>&nbsp;Feedbacks</a> </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-life-ring"></i>
                            <span>Help</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('dashboard') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Support Team</a> </li>
                        </ul>
                    </li>
                    <li class="menu-list">
                        <a href="#"><i class="fa fa-wrench"></i>
                            <span>Setting</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="{{ route('dashboard') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Change Password</a> </li>
                            <li><a href="{{ route('sellerdashboard') }}"><i class="lnr lnr-chevron-right"></i>&nbsp;Sign Out</a> </li>
                        </ul>
                    </li>

					<!-- <li><a href="forms.html"><i class="lnr lnr-spell-check"></i> <span>Forms</span></a></li>
                    <li><a href="tables.html"><i class="lnr lnr-menu"></i> <span>Tables</span></a></li>              
                    <li class="menu-list"><a href="#"><i class="lnr lnr-envelope"></i> <span>MailBox</span></a>
                        <ul class="sub-menu-list">
                            <li><a href="inbox.html">Inbox</a> </li>
                            <li><a href="compose-mail.html">Compose Mail</a></li>
                        </ul>
                    </li>      
                    <li class="menu-list"><a href="#"><i class="lnr lnr-indent-increase"></i> <span>Menu Levels</span></a>  
                        <ul class="sub-menu-list">
                            <li><a href="charts.html">Basic Charts</a> </li>
                        </ul>
                    </li>
                    <li><a href="codes.html"><i class="lnr lnr-pencil"></i> <span>Typography</span></a></li>
                    <li><a href="media.html"><i class="lnr lnr-select"></i> <span>Media Css</span></a></li>
                    <li class="menu-list"><a href="#"><i class="lnr lnr-book"></i>  <span>Pages</span></a> 
                        <ul class="sub-menu-list">
                            <li><a href="sign-in.html">Sign In</a> </li>
                            <li><a href="sign-up.html">Sign Up</a></li>
                            <li><a href="blank_page.html">Blank Page</a></li>
                        </ul>
                    </li> -->
                </ul>
                <!--sidebar nav end-->
            </div>
        </div>
        <!-- left side end-->