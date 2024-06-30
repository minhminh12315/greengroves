<div class="loginRegister">
	<div class="login-container" id="container">
		<div class="form-container switch-right sign-up">
			<form>
				<h2 class="pb-5">Create Account</h2>
				<div class="userbox">
					<input type="text" name="username" required>
					<label for="username">Username</label>
				</div>
				<div class="userbox">
					<input type="text" name="email" required>
					<label for="email">Email</label>
				</div>
				<div class="userbox">
					<input class="input-password" type="password" name="password" required>
					<i class="fa-regular fa-eye login-eye icon-eye"></i>
					<label for="password">Password</label>
				</div>
				<button class="btn-register">Sign Up</button>
			</form>
			<div class="switcher">
				<button>You already have an account? Sign In</button>
			</div>
		</div>
		<div class="form-container sign-in">
			<form>
				<h2 class="pb-5">Sign In</h2>
				<div class="userbox">
					<input type="text" name="username" required>
					<label for="username">Username</label>
				</div>
				<div class="userbox">
					<input class="input-password" type="password" name="password" required>
					<i class="fa-regular fa-eye login-eye icon-eye"></i>
					<label for="password">Password</label>
				</div>
				<a href="#">Forget Your Password?</a>
				<button class="btn-login">Sign In</button>
			</form>
			<div class="switcher">
				<button>Don't have an account? Sign Up</button>
			</div>
		</div>
		<div class="toggle-container">
			<div class="toggle">
				<div class="toggle-panel toggle-left">
					<h1>Welcome Back!</h1>
					<p>Enter your personal details to use all of site features</p>
					<button class="btn-login login">Sign In</button>
				</div>
				<div class="toggle-panel toggle-right">
					<h1>Hello, Friend!</h1>
					<p>Register with your personal details to use all of site features</p>
					<button class="btn-register register">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		const $container = $('#container');
		const $registerBtn = $('.register');
		const $loginBtn = $('.login');
		const $switchers = $('.switcher');


		function toggleForms() {
			$container.toggleClass("active");
		}

		function switchForms() {
			$container.toggleClass("active");
			$(".sign-in, .sign-up").toggleClass("active");
		}

		const showHiddenPassword = (inputPasswordClass, inputIconClass) => {
			const $input = $(`.${inputPasswordClass}`);
			const $iconEye = $(`.${inputIconClass}`);


			$iconEye.on('click', () => {
				const isPassword = $input.attr('type') === 'password';
				$input.attr('type', isPassword ? 'text' : 'password');
				$iconEye.toggleClass('fa-eye fa-eye-slash');
			});
		};
		showHiddenPassword('input-password', 'icon-eye');

		$registerBtn.on('click', toggleForms);
		$loginBtn.on('click', toggleForms);
		$switchers.on('click', switchForms);

	});
</script>