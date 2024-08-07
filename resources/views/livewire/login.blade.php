<div class="loginRegister">
	<div class="login-container" wire:ignore.self id="container">
		<div class="form-container sign-up">
			<form wire:submit.prevent="register" >
				<h2 class="pb-5">Create Account</h2>
				<div class="userbox">
					<input type="text" wire:model.live="name" placeholder="Username">
					<label for="username">Username</label>
					@error('name') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>
				<div class="userbox">
					<input type="text" class="form-control" wire:model.live="email" placeholder="Email">
					<label for="email">Email</label>
					@error('email') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>
				<div class="userbox">
					<input class="input-password" type="password" wire:model.live="password" placeholder="Password">
					<i class="fa-regular fa-eye login-eye icon-eye"></i>
					<label for="password">Password</label>
					@error('password') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>
				<div class="userbox">
					<input class="input-password" type="password" wire:model.live="password_confirmation" placeholder="Confirm Password">
					<i class="fa-regular fa-eye login-eye icon-eye"></i>
					<label for="password">Confirm Password</label>
					@error('password_confirmation') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>

				@if (session()->has('success'))
				<div class="alert alert-success">
					{{ session('success') }}
				</div>
				@endif

				@if (session()->has('error'))
				<div class="alert alert-danger">
					{{ session('error') }}
				</div>
				@endif
				<button class="btn-register" id="btn-register" wire:loading.attr="false">
					<div wire:loading.class="d-none" class="text-light">
						Sign Up
					</div>
					<div wire:loading wire:target="register" class="loginRegisterLoading">
						<span class="material-symbols-outlined">
							potted_plant
						</span>
					</div>
				</button>
			</form>
			<div class="switcher">
				<button>You already have an account? Sign In</button>
			</div>
		</div>
		<div class="form-container sign-in" wire:ignore.self>
			<form wire:submit.prevent="login" >
				<h2 class="pb-5">Sign In</h2>
				<div class="userbox">
					<input type="text" wire:model.live="login_username" required placeholder="Username">
					<label for="login_username">Username</label>
					@error('login_username') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>
				<div class="userbox">
					<input class="input-password" type="password" wire:model.live="login_password" required placeholder="Password">
					<i class="fa-regular fa-eye login-eye icon-eye"></i>
					<label for="login_password">Password</label>
					@error('login_password') <span class="error text-danger">{{ $message }}</span> @enderror
				</div>
				@error('login_failed') <span class="error text-danger">{{ $message }}</span> @enderror
				<div class="d-flex flex-row gap-2 align-items-center justify-content-start w-75 small">
					<input wire:model.defer="rememberMe" type="checkbox">Remember Me
				</div>
				<button class="btn-login" id="btn-login">
					<div wire:loading.class="d-none" class="text-light">
						Sign In
					</div>
					<div wire:loading wire:target="register" class="loginRegisterLoading">
						<span class="material-symbols-outlined">
							potted_plant
						</span>
					</div>
				</button>
			</form>
			<div class="switcher">
				<button>Don't have an account? Sign Up</button>
			</div>
		</div>
		<div class="toggle-container">
			<div class="toggle">
				<div class="toggle-panel toggle-left">
					<h1 class="text-light">Welcome Back!</h1>
					<p class="text-light">Enter your personal details to use all of site features</p>
					<button class="btn-login login changeColor">Sign In</button>
				</div>
				<div class="toggle-panel toggle-right">
					<h1 class="text-light">Hello, Friend!</h1>
					<p class="text-light">Register with your personal details to use all of site features</p>
					<button class="btn-register register changeColor">Sign Up</button>
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

		$registerBtn.on('click', function(e) {
			e.preventDefault();
			toggleForms();
		});

		$loginBtn.on('click', function(e) {
			e.preventDefault();
			toggleForms();
		});


		$switchers.on('click', function(e) {
			e.preventDefault();
			switchForms();
		});

	});
</script>