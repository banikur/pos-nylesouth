<!DOCTYPE html>
<html class="no-js">
@include('template.landing_page.head.header')
@yield('css')

<body>
    <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
    <!-- Navigation & Logo-->
    <div class="mainmenu-wrapper">
        <div class="container">
            <div class="menuextras">
                <!-- <div class="extras">
                    <ul>
                        <li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="page-shopping-cart.html"><b>3 items</b></a></li>
                        <li>
                            <div class="dropdown choose-country">
                                <a class="#" data-toggle="dropdown" href="#"><img src="img/flags/gb.png" alt="Great Britain"> UK</a>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="menuitem"><a href="#"><img src="img/flags/us.png" alt="United States"> US</a></li>
                                    <li role="menuitem"><a href="#"><img src="img/flags/de.png" alt="Germany"> DE</a></li>
                                    <li role="menuitem"><a href="#"><img src="img/flags/es.png" alt="Spain"> ES</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="page-login.html">Login</a></li>
                    </ul>
                </div> -->
            </div>
            <nav id="mainmenu" class="mainmenu">
                <ul>
                    <li class="logo-wrapper"><a href="index.html"><img src="img/mPurpose-logo.png" alt="Logo"></a></li>
                    <li class="active">
                        <a href="{{route('/')}}">Home</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#">Pages +</a>
                        <div class="mainmenu-submenu">
                            <div class="mainmenu-submenu-inner">
                                <div>
                                    <h4>Homepage</h4>
                                    <ul>
                                        <li><a href="index.html">Homepage (Sample 1)</a></li>
                                        <li><a href="page-homepage-sample.html">Homepage (Sample 2)</a></li>
                                    </ul>
                                    <h4>Services & Pricing</h4>
                                    <ul>
                                        <li><a href="page-services-1-column.html">Services/Features (Rows)</a></li>
                                        <li><a href="page-services-3-columns.html">Services/Features (3 Columns)</a></li>
                                        <li><a href="page-services-4-columns.html">Services/Features (4 Columns)</a></li>
                                        <li><a href="page-pricing.html">Pricing Table</a></li>
                                    </ul>
                                    <h4>Team & Open Vacancies</h4>
                                    <ul>
                                        <li><a href="page-team.html">Our Team</a></li>
                                        <li><a href="page-vacancies.html">Open Vacancies (List)</a></li>
                                        <li><a href="page-job-details.html">Open Vacancies (Job Details)</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>Our Work (Portfolio)</h4>
                                    <ul>
                                        <li><a href="page-portfolio-2-columns-1.html">Portfolio (2 Columns, Option 1)</a></li>
                                        <li><a href="page-portfolio-2-columns-2.html">Portfolio (2 Columns, Option 2)</a></li>
                                        <li><a href="page-portfolio-3-columns-1.html">Portfolio (3 Columns, Option 1)</a></li>
                                        <li><a href="page-portfolio-3-columns-2.html">Portfolio (3 Columns, Option 2)</a></li>
                                        <li><a href="page-portfolio-item.html">Portfolio Item (Project) Description</a></li>
                                    </ul>
                                    <h4>General Pages</h4>
                                    <ul>
                                        <li><a href="page-about-us.html">About Us</a></li>
                                        <li><a href="page-contact-us.html">Contact Us</a></li>
                                        <li><a href="page-faq.html">Frequently Asked Questions</a></li>
                                        <li><a href="page-testimonials-clients.html">Testimonials & Clients</a></li>
                                        <li><a href="page-events.html">Events</a></li>
                                        <li><a href="page-404.html">404 Page</a></li>
                                        <li><a href="page-sitemap.html">Sitemap</a></li>
                                        <li><a href="page-login.html">Login</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-password-reset.html">Password Reset</a></li>
                                        <li><a href="page-terms-privacy.html">Terms & Privacy</a></li>
                                        <li><a href="page-coming-soon.html">Coming Soon</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <h4>eShop</h4>
                                    <ul>
                                        <li><a href="page-products-3-columns.html">Products listing (3 Columns)</a></li>
                                        <li><a href="page-products-4-columns.html">Products listing (4 Columns)</a></li>
                                        <li><a href="page-products-slider.html">Products Slider</a></li>
                                        <li><a href="page-product-details.html">Product Details</a></li>
                                        <li><a href="page-shopping-cart.html">Shopping Cart</a></li>
                                    </ul>
                                    <h4>Blog</h4>
                                    <ul>
                                        <li><a href="page-blog-posts.html">Blog Posts (List)</a></li>
                                        <li><a href="page-blog-post-right-sidebar.html">Blog Single Post (Right Sidebar)</a></li>
                                        <li><a href="page-blog-post-left-sidebar.html">Blog Single Post (Left Sidebar)</a></li>
                                        <li><a href="page-news.html">Latest & Featured News</a></li>
                                    </ul>
                                </div>
                            </div><!-- /mainmenu-submenu-inner -->
                        </div><!-- /mainmenu-submenu -->
                    </li>
                    @if (Route::has('login'))

                    @auth
                    <li class="pull-right">
                        <a href="{{route('home')}}">Cart</a>
                    </li>
                    <li class="pull-right">
                        <a href="{{ route('logout') }}" class="menu-link" data-toggle="tooltip" data-placement="right" title="Logout">
                            <span class="menu-icon fa fa-logout text-primary"></span>
                            <span class="menu-text">{{ __('Logout') }}</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </a>
                    </li>
                    @else
                    <li class="pull-right">
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="pull-right">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @endauth
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <!-- Homepage Slider -->
    <div class="homepage-slider">
        <div id="sequence">
            <ul class="sequence-canvas">
                <!-- Slide 1 -->
                <li class="bg4">
                    <!-- Slide Title -->
                    <h2 class="title">Responsive</h2>
                    <!-- Slide Text -->
                    <h3 class="subtitle">It looks great on desktops, laptops, tablets and smartphones</h3>
                    <!-- Slide Image -->
                    <img class="slide-img" src="img/homepage-slider/slide1.png" alt="Slide 1" />
                </li>
                <!-- End Slide 1 -->
                <!-- Slide 2 -->
                <li class="bg3">
                    <!-- Slide Title -->
                    <h2 class="title">Color Schemes</h2>
                    <!-- Slide Text -->
                    <h3 class="subtitle">Comes with 5 color schemes and it's easy to make your own!</h3>
                    <!-- Slide Image -->
                    <img class="slide-img" src="img/homepage-slider/slide2.png" alt="Slide 2" />
                </li>
                <!-- End Slide 2 -->
                <!-- Slide 3 -->
                <li class="bg1">
                    <!-- Slide Title -->
                    <h2 class="title">Feature Rich</h2>
                    <!-- Slide Text -->
                    <h3 class="subtitle">Huge amount of components and over 30 sample pages!</h3>
                    <!-- Slide Image -->
                    <img class="slide-img" src="img/homepage-slider/slide3.png" alt="Slide 3" />
                </li>
                <!-- End Slide 3 -->
            </ul>
            <div class="sequence-pagination-wrapper">
                <ul class="sequence-pagination">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Homepage Slider -->
    <div class="section">
        <div class="container">
            @yield('content')
        </div>
    </div>


</body>
@yield('javascripts')
<script>

</script>
@include('template.landing_page.foot.footer')
@include('template.landing_page.foot.footer_script')

</html>