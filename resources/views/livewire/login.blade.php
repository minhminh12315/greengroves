<div class="loginRegister">
	<div class="login-container" id="container">
		<div class="form-container sign-up">
			<form>
				<h2>Create Account</h2>
				<div class="social-icons">
					<a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>
				<span>or use your email for registeration</span>
				<div class="userbox">
					<input type="text" name="username" required>
					<label for="username">Username</label>
				</div>
				<div class="userbox">
					<input type="text" name="email" required>
					<label for="email">Email</label>
				</div>
				<div class="userbox">
					<input type="password" name="password" required>
					<label for="password">Password</label>
				</div>
				<button class="btn-register">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in">
			<form>
				<h2>Sign In</h2>
				<div class="social-icons">
					<a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
					<a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
				</div>
				<span>or use your account</span>
				<div class="userbox">
					<input type="text" name="username" required>
					<label for="username">Username</label>
				</div>
				<div class="userbox">
					<input type="password" name="password" required>
					<label for="password">Password</label>
				</div>
				<a href="#">Forget Your Password?</a>
				<button class="btn-login">Sign In</button>
			</form>
		</div>
		<div class="toggle-container">
			<div class="toggle">
				<div class="toggle-panel toggle-left">
					<h1>Welcome Back!</h1>
					<p>Enter your personal details to use all of site features</p>
					<button class="btn-login hidden" id="login">Sign In</button>
				</div>
				<div class="toggle-panel toggle-right">
					<h1>Hello, Friend!</h1>
					<p>Register with your personal details to use all of site features</p>
					<button class="btn-register hidden" id="register">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	const container = document.getElementById('container');
	const registerBtn = document.getElementById('register');
	const loginBtn = document.getElementById('login');

	registerBtn.addEventListener('click', () => {
		container.classList.add("active");
	});

	loginBtn.addEventListener('click', () => {
		container.classList.remove("active");
	});
</script>