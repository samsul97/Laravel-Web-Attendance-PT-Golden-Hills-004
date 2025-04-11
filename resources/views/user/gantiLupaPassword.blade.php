<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ganti Password | Abdul</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="/img/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/res_user_login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/res_user_login/css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30">
				<form autocomplete="off" class="login100-form validate-form" method="POST" action="/user/lupaPassword/gantiPassword">

                    {{ csrf_field() }}

                    <div class="wrap-input100 m-b-16">
                        <img width="60px" src="/img/logo.png" style="display: inline">
                        <h3 style="display: inline"><b>abdul</b><h3>
					</div>

                    <div class="wrap-input100 m-b-16">
                        <h5 style="display: block">Ganti Password</h5>
					</div>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert" style="width: 100%">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session()->has('alert-success'))
                        <div class="alert alert-success" role="alert" style="width: 100%">
                            {{session()->get('alert-success')}}
                        </div>
                    @endif

                    @if (session()->has('alert-danger'))
                        <div class="alert alert-danger" role="alert" style="width: 100%">
                            {{session()->get('alert-danger')}}
                        </div>
                    @endif

                    @if (session()->has('alert-warning'))
                        <div class="alert alert-warning" role="alert" style="width: 100%">
                            {{session()->get('alert-warning')}}
                        </div>
                    @endif

					<div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz" hidden>
                        <input class="input100" type="email" name="email" placeholder="Email" value="{{$email}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" hidden>
						<input class="input100" type="text" name="nip" placeholder="NIP" value="{{$nip}}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-envelope"></span>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="pass_baru" placeholder="Password Baru">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
						<input class="input100" type="password" name="pass_baru_konf" placeholder="Konfirmasi Password Baru">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<span class="lnr lnr-lock"></span>
						</span>
					</div>

					<div class="container-login100-form-btn p-t-25">
						<button class="login100-form-btn">
							Submit
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="/res_user_login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/res_user_login/vendor/bootstrap/js/popper.js"></script>
	<script src="/res_user_login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/res_user_login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/res_user_login/js/main.js"></script>

</body>
</html>
