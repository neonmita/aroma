<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
	<div class="container h-100">
		<div class="blog-banner">
			<div class="text-center">
				<h1>Войти / Зарегистрироваться</h1>
				<nav aria-label="breadcrumb" class="banner-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Главная</a></li>
						<li class="breadcrumb-item active" aria-current="page">Войти / Зарегистрироваться</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="login_box_img">
					<div class="hover">
						<h4>Вы еще не зарегестрированы?</h4>
						<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
						<a class="button button-account" href="/register">Создать аккаунт</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="login_form_inner">
					<h3>Вход в личный кабинет</h3>
					<form class="row login_form" onsubmit="sendForm(this); return false;" id="contactForm">
						<div class="col-md-12 form-group">
							<input type="email" class="form-control" id="name" name="email" placeholder="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'email'">
						</div>
						<div class="col-md-12 form-group">
							<input type="password" class="form-control" name="pass" placeholder="Введите пароль" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Введите пароль'">
						</div>

						<p id="info"></p>

						<div class="col-md-12 form-group">
							<button type="submit" class="button button-login w-100">Войти</button>
							<!-- <a href="#">Forgot Password?</a> -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Login Box Area =================-->

<!-- Modal start -->
<div class="modal fade" id="modalAuth" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">

		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Авторизация прошла успешно</h5>
			</div>
			<div class="modal-body">вы будете направлены на страницу</div>
			<div class="modal-footer">Личного кабинетф</div>
		</div>
	</div>
</div>
<!-- Modal end -->

<script>
	async function sendForm(form) {
		let formData = new FormData(form);

		let response = await fetch("authUser", {
			method: "POST",
			body: formData,
		});

		let res = await response.json();
		// let modalAuth = document.getElementById("modalAuth");

		if (res.result == "success") {

			$("#modalAuth").modal("show");
			setTimeout(() => {
				location.href = "users/profile";
			}, 1000);
		} else if (res.result == "notok") {
			info.innerText = "Неверный логин / пароль";
		} else {
			alert("Неизвестная ошбка");
		}
	}
</script>