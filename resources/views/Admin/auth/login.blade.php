<!doctype html>
<html lang="en" dir="rtl">

	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Yoha –  HTML5 Bootstrap Admin Template">
		<meta name="author" content="Spruko Technologies Private Limited">
		<meta name="keywords" content="admin dashboard html template, admin dashboard template bootstrap 4, analytics dashboard templates, best admin template bootstrap 4, best bootstrap admin template, bootstrap 4 template admin, bootstrap admin template premium, bootstrap admin ui, bootstrap basic admin template, cool admin template, dark admin dashboard, dark admin template, dark dashboard template, dashboard template bootstrap 4, ecommerce dashboard template, html5 admin template, light bootstrap dashboard, sales dashboard template, simple dashboard bootstrap 4, template bootstrap 4 admin">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{setting()->fav_icon}}" />

		<!-- TITLE -->
		<title>Geetcom –  تسجيل الدخول</title>

		<!-- BOOTSTRAP CSS -->
		<link href="{{url('Admin')}}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{url('Admin')}}/assets/css-rtl/style.css" rel="stylesheet"/>
		<link href="{{url('Admin')}}/assets/css-rtl/skin-modes.css" rel="stylesheet"/>
		<link href="{{url('Admin')}}/assets/css-rtl/dark-style.css" rel="stylesheet"/>

		<!-- CUSTOM SCROLL BAR CSS-->
		<link href="{{url('Admin')}}/assets/plugins/scroll-bar/jquery.mCustomScrollbar.css" rel="stylesheet"/>

		<!--- FONT-ICONS CSS -->
		<link href="{{url('Admin')}}/assets/css/icons.css" rel="stylesheet"/>

				<!-- INTERNAL SINGLE-PAGE CSS -->
		<link href="{{url('Admin')}}/assets/plugins/single-page/css/main.css" rel="stylesheet" type="text/css">

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('Admin')}}/assets/colors/color1.css" />

        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    </head>

	<body class="app sidebar-mini">

		<!-- BACKGROUND-IMAGE -->
		<div class="login-img">

			<!-- GLOABAL LOADER -->
            <div id="global-loader">
                <img src="{{url('Admin')}}/assets/images/loader.svg" class="loader-img" alt="Loader">
            </div>
			<!-- End GLOABAL LOADER -->

			<!-- PAGE -->
			<div class="page">
				<div class="">
					<div class="col col-login mx-auto">
						<div class="text-center">
							<img src="{{setting()->logo}}" class="header-brand-img" alt="">
						</div>
					</div>
									    <!-- CONTAINER OPEN -->
					<div class="container-login100">
						<div class="wrap-login100 p-6">
                            <form id="login_form" class="login100-form validate-form" action="{{route('post_login')}}" enctype="application/x-www-form-urlencoded" method="post">
                                @csrf
                                <span class="login100-form-title">
									تسجيل الدخول
								</span>
								<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<input class="input100" type="text" placeholder="البريد الإلكترونى" name="email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M20 8l-8 5-8-5v10h16zm0-2H4l8 4.99z" opacity=".3"/><path d="M4 20h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2zM20 6l-8 4.99L4 6h16zM4 8l8 5 8-5v10H4V8z"/></svg>
									</span>
								</div>
								<div class="wrap-input100 validate-input" data-validate = "Password is required">
									<input class="input100 password" type="password" placeholder="كلمة السر" name="password" >
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><g fill="none"><path d="M0 0h24v24H0V0z"/><path d="M0 0h24v24H0V0z" opacity=".87"/></g><path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>
									</span>
								</div>
								<div class="container-login100-form-btn">
									<button type="submit" href="#" class="login100-form-btn btn-primary">
										دخول
									</button>
								</div>

							</form>
						</div>
					</div>
                    <!-- CONTAINER CLOSED -->
					<!-- CONTAINER CLOSED -->
				</div>
			</div>
			<!-- END PAGE -->
		</div>
		<!-- BACKGROUND-IMAGE CLOSED -->
		<!-- JQUERY JS -->
		<script src="{{url('Admin')}}/assets/js/jquery-3.4.1.min.js"></script>

		<!-- BOOTSTRAP JS -->
		<script src="{{url('Admin')}}/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="{{url('Admin')}}/assets/plugins/bootstrap/js/popper.min.js"></script>

		<!-- SPARKLINE JS-->
		<script src="{{url('Admin')}}/assets/js/jquery.sparkline.min.js"></script>

		<!-- CHART-CIRCLE JS-->
		<script src="{{url('Admin')}}/assets/js/circle-progress.min.js"></script>

		<!-- RATING STARJS -->
		<script src="{{url('Admin')}}/assets/plugins/rating/jquery.rating-stars.js"></script>

		<!-- EVA-ICONS JS -->
		<script src="{{url('Admin')}}/assets/iconfonts/eva.min.js"></script>

		<!-- CUSTOM SCROLLBAR JS-->
		<script src="{{url('Admin')}}/assets/plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js"></script>


		<!-- CUSTOM JS -->
		<script src="{{url('Admin')}}/assets/js/custom.js"></script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        @include('layouts.admin.inc.toaster')
{{--    //////////////////////////////////////////////////////--}}
        {{--    #############################  Store  ###########################--}}
        <script>
            $(document).on('submit', '#login_form', function (event) {
                event.preventDefault();
                var form_data = new FormData(document.getElementById("login_form"));
                var url = $('#login_form').attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function(){
                        $('#global-loader').show()
                    },
                    success: function (data) {
                        window.setTimeout(function() {
                            $('#global-loader').hide()
                            if (data.success == 'true') {
                                location.href = 'login';
                                var messages = Object.values(data.messages);
                                $( messages ).each(function(index, message ) {
                                    my_toaster(message)
                                });
                            }
                            if (data.success == 'false') {
                                var messages = Object.values(data.messages);
                                $( messages ).each(function(index, message ) {
                                    my_toaster(message,'error')
                                });
                            }
                        }, 1000);
                    }, error: function (data) {
                        $('#global-loader').hide()
                        var error = Object.values(data.responseJSON.errors);
                        $( error ).each(function(index, message ) {
                            my_toaster(message,'error')
                        });
                    }
                });
            });
        </script>
	</body>

</html>
