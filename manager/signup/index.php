<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
		<title>Marketino</title>
		<meta charset="utf-8" />
		<meta name="description" content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask &amp; Laravel versions. Grab your copy now and get life-time updates for free." />
		<meta name="keywords" content="Marketino, Bootstrap, Bootstrap 5, Angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask &amp; Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<link rel="shortcut icon" href="../assets/media/logos/logo-small1.ico" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
		<link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	</head>
	<body data-kt-name="Marketino" id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
		<div class="d-flex flex-column flex-root" id="kt_app_root">
			<style>body { background-image: url('../assets/media/auth/bg4.jpg'); } [data-theme="dark"] body { background-image: url('./manager/assets/media/auth/bg4-dark.jpg'); }</style>
			<div class="d-flex flex-column flex-column-fluid flex-lg-row">
				<div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
					<div class="d-flex flex-column align-items-center">
						<a href="./index.php" class="mb-7">
							<img alt="Logo" src="../assets/media/logos/logo-small1.png" width="80%" style="display: table; margin: 0 auto;" />
						</a>
						<h2 class="text-white fw-normal m-0">TurboCharge Your Productivity</h2>
					</div>
				</div>
				<div class="d-flex flex-center w-lg-50 p-10">
					<div class="card rounded-3 w-md-550px">
						<div class="card-body p-10 p-lg-20">
							<form class="form w-100" id="signin" method="POST" action="signup.php" autocomplete="off">
								<div class="text-center mb-11">
									<h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
								</div>
								<div class="fv-row mb-8">
									<input type="text" placeholder="Username" name="username" autocomplete="off" class="form-control bg-transparent" />
								</div>
								<div class="fv-row mb-8">
									<input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" />
								</div>
								<div class="fv-row mb-8">
									<input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control bg-transparent" />
								</div>
								<div class="d-grid">
									<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
										<span class="indicator-label">Sign Up</span>
										<span class="indicator-progress">Please wait... 
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
        </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
        </div>
	</body>
	<script type="text/javascript">
	if ( document.documentElement ) 
	{
		const defaultThemeMode = "system"; 
	    const name = document.body.getAttribute("data-kt-name"); 
		let themeMode = localStorage.getItem("kt_" + ( name !== null ? name + "_" : "" ) + "theme_mode_value"); 
		if ( themeMode === null ) { if ( defaultThemeMode === "system" ) { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } else { themeMode = defaultThemeMode; } } document.documentElement.setAttribute("data-theme", themeMode); 
	}
	</script>
	<script src="../assets/plugins/global/plugins.bundle.js"></script>
	<script src="../assets/js/scripts.bundle.js"></script>
	<script src="../assets/js/custom/authentication/sign-in/general.js"></script>
</html>