<?php include 'includes/header-links.php';?>

	<section class="auth-sec">
		<div class="container-fluid p-0">
			<div class="row">
				<div class="form-col">
					<div class="auth-form-wrap sign-up-form">
						<div class="auth-logo">
							<img src="assets/images/auth-logo.svg" alt="logo" class="img-fluid">
						</div>
						<div class="auth-text">
							<h1 class="auth-title">Enter your email & choose you password</h1>
							<p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit.</p>
						</div>
						<div>
							<form class="auth-form">
								<div class="form-group">
									<input type="text" placeholder="Email">
								</div>
								<div class="form-group password-group">
									<input type="password" placeholder="Password">
									<a href="#!"><img src="assets/images/password-hide.png" alt="icon" class="img-fluid"></a>
								</div>
								
								<div class="sign-in-checks">
									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="" id="remember-pass">
									  <label class="form-check-label" for="remember-pass">
									    Remember me
									  </label>
									</div>
									<a href="#!" class="forget-pass">Forget your password?</a>
								</div>

								<div class="form-group">
									<button type="button" class="submit-btn" onclick="location.href='http://bidfeed.dsk.solar/landing-user.php';">Sign In</button>
								</div>
								<div class="alternate-login">
									<p>or continue with</p>
									<div class="login-opts">
										<a href="#!">
											<img src="assets/images/icon-google.png" alt="icon" class="img-fluid">
										</a>
										<a href="#!">
											<img src="assets/images/icon-fb.png" alt="icon" class="img-fluid">
										</a>
										<a href="#!">
											<img src="assets/images/icon-apple.png" alt="icon" class="img-fluid">
										</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="gallery-col">
					<img src="assets/images/auth-gallery-img.png" alt="img" class="img-fluid">
				</div>
			</div>
		</div>	
	</section>

<?php include 'includes/footer-links.php';?>
