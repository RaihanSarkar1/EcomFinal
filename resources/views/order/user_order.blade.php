<!DOCTYPE html>
<html lang="en">


<head>
    <!-- This line is added to provide access to the files in the public folders -->
    <base href="/public">
    @include('template.header_links')
    @yield('page_css')
</head>

<body>
    <div class="page-wrapper">
        @include('template.topnav')


        <main class="main">
            <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
                <div class="container">
                    <h1 class="page-title">My Order<span>Order ID: {{ $order->id }}</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->

            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container order">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order details</h5>

                            <hr>
                            <h6>Order Id: {{ $order->id }} </h6>
                            <h6>Ordered date: {{ $order->created_at }}</h6>
                            <h6>Payment mode: {{ $order->payment}}</h6>
                            <h6 class="border">Order status: <span class="text-uppercase {{ $order->status == 'cancelled'? 'text-danger': ($order->status == 'approved'? 'text-success': 'text-info')}}">{{$order->status}}</span> </h6>
                        </div>
                        <div class="col-md-6">
                            <h5>User details</h5>
                            <hr>
                            <h6>User ID: {{ $user->id}} </h6>
                            <h6>User Name: {{ $user->name }}</h6>
                            <h6>User Email: {{ $user->email }}</h6>
                            <h6>User address: {{ $order->address }}</h6>
                        </div>
                    </div>

                    <div class="row">
                        <br>
                        <h4>Order Items</h4>
                        <br>
                        @if ($errors->any())
                        <h1>{{ $errors->first() }}</h1>
                        @endif

                        <table id="example-1" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>


                            <tbody>
                                @php
                                $total_price = 0;
                                @endphp
                                @foreach($products as $product)
                                <tr>
                                    <td style="text-align: center; vertical-align:middle; padding-left:40px;">
                                        
                                        <img src="{{ asset('storage/'.$product->photo) }}" alt="" class="" style="height:50px ">
                                        
                                    </td>
                                    <td style="text-align: left;">
                                        {{$product->name}}
                                    </td>
                                    <td>৳{{$product->price}}</td>
                                    <td>{{$product->pivot->quantity}}</td>
                                    <td>৳{{$product->pivot->quantity * $product->price}}</td>
                                    @php
                                    $total_price += $product->pivot->quantity * $product->price;
                                    @endphp
                                </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <td colspan="4"><strong>Total Amount</strong></td>
                                    <td colspan="1"><strong>৳{{ $total_price }}</strong></td>
                                </tr>

                            </tfoot>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div><!-- End .page-content -->
        </main><!-- End .main -->



        @include('template.footer')

    </div><!-- End .page-wrapper -->


    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    @include('template.mobile_menu')

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="{{ url('login') }}" method="post">
                                        @csrf

                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="email" class="form-control" id="singin-email" name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="{{ url('register_user') }}" method="post">
                                        <div class="form-group">
                                            @csrf
                                            <label for="register-name">Your user name *</label>
                                            <input type="text" class="form-control" id="register-name" name="name" required>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div><!-- End .col-6 -->
                                            <div class="col-sm-6">
                                                <a href="#" class="btn btn-login  btn-f">
                                                    <i class="icon-facebook-f"></i>
                                                    Login With Facebook
                                                </a>
                                            </div><!-- End .col-6 -->
                                        </div><!-- End .row -->
                                    </div><!-- End .form-choice -->
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->


    <!-- Plugins JS File -->

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.hoverIntent.min.js"></script>
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/superfish.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/bootstrap-input-spinner.js"></script>
    <script src="assets/js/jquery.plugin.min.js"></script>
    <script src="assets/js/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/jquery.countdown.min.js"></script>
    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/demos/demo-4.js"></script>


</body>


</html>