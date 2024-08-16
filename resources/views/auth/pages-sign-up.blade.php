<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="../img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-up.html" />

	<title>Creer un compte | Webcinq Facturation </title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<img src="{{ asset('/webcinq_logo.png') }}" height="70" alt="webcinq" loading="lazy" />

							<h1 class="h2">Créer un compte pour un utilisateur</h1>
							<p class="lead">
								En tant qu'admin, vous pouvez créer un compte pour un nouveau utilisateur/client.
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method ="POST" action="{{ route('sign_up') }}">
										@csrf
										<div class="mb-3">
											<label class="form-label">Nom complet</label>
											<input class="form-control form-control-lg" type="text" name="name" placeholder="Entrer votre nom complet" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="Entrer votre email" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Mot de passe</label>
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Entrer le mot de passe" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Confirmer Mot de passe</label>
											<input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Type de compte</label>
											<div class="form-check">
												<input class="form-check-input" type="radio"  name="usertype" value="admin" required>
												<label class="form-check-label" for="admin">
													Admin
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="usertype" value="user" checked required>
												<label class="form-check-label" for="user">
													Client
												</label>
											</div>
										</div>
										<div class="mb-3">
											<label class="form-label">Validation du compte</label>
											<div class="form-check">
												<input class="form-check-input" type="radio"  name="uservalid" value="v" required>
												<label class="form-check-label" for="admin">
													Validé
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="uservalid" value="nv" checked required>
												<label class="form-check-label" for="user">
													Non validé
												</label>
											</div>
										</div>
										<div class="d-grid gap-2 mt-3">
											<button class="btn btn-lg btn-primary">Creer le nouveau compte</button>
										</div>
									</form>
									@if ($errors->any())
    								<div class="alert alert-danger">
        							<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
									</ul>
									</div>
@endif

								</div>
							</div>
						</div>
						<div class="text-center mb-3">
							Vous n'avez pas de compte? <a href="{{ route('login') }}">Se connecter</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>