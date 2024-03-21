<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
	<script src="plugins/jquery/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
 
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<style>
		.input {
			margin-top: 80px;
			margin-bottom: 80px;
		}
		#view_pass{
		float: right;
		margin-right: 10px;
		margin-top: -30px;
    	} 

	</style>
<?php if (isset($_SESSION['loggrobdesk'])) {
    header('Location: admin.php');
} ?>
</head>

<body>
	<div class="input">
		<div class="container">
			<div class="row justify-content-center mt-5">
				<div class="col-md-4">
					<div class="card">
						<div class="card-header mb-0 bg-dark text-white">
							<h5 class="text-center">Login <span class="font-weight-bold text-primary"></span></h5>
						</div>
						<div class="card-body">
							<form name="stmt" method="post" action="login_post.php">
								<div class="form-group">
									<label>Email</label></br>
									<input class="form-control" type="email" id="inputEmail" name="email" placeholder="Email" autofocus required="required">
								</div>
								<div class="form-group">
									<label>Password</label></br>
									<input class="form-control" type="password" id="inputPassword" name="password" placeholder="Password" required="required">
									<span class="" id="view_pass"></span>
								</div>
								<!-- <input type="checkbox" class="form-checkbox" id="inputPassword"> Show password -->
								<div class="form-group">
								</br><div class="g-recaptcha" data-sitekey="6LcwwVghAAAAALPN5Rqbk9ETks38BXPJFyDQGI8Z"></div></br>
								</div>
								<div class="form-group">
									<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button></br>
								</div>
							</form>
							<!-- <p class="small">Don't have an account? <a href="register.php">Register</a></p> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>

<script>
const password = document.getElementById('inputPassword'); // id dari input password
const showHide = document.getElementById('view_pass'); // id span showHide dalam input group password

password.type = 'password'; // set type input password menjadi password
showHide.innerHTML = '<i class="bi bi-eye"></i>'; // masukan icon eye dalam icon bootstrap 5
showHide.style.cursor = 'pointer'; // ubah cursor menjadi pointer
// jadi ketika span di hover maka cursornya berubah pointer

showHide.addEventListener('click', () => {
// ketika span diclick
    if (password.type === 'password') {
        // jika type inputnya password
        password.type = 'text'; // ubah type menjadi text
        showHide.innerHTML = '<i class="bi bi-eye-slash"></i>'; // ubah icon menjadi eye slash
    } else {
        // jika type bukan password (text)
        showHide.innerHTML = '<i class="bi bi-eye"></i>'; // ubah icon menjadi eye
        password.type = 'password'; // ubah type menjadi password
    }
});

</script>
	
	<!-- <script>
$(document).on('click', '#view_pass', function(e) {
     e.preventDefault();
     var password = $("#inputPassword").val();
     if($("#inputPassword").hasClass("active")) {
        $("#inputPassword").attr('type', 'text');
        $("#inputPassword").removeClass("active");
 
     } else {
        $("#inputPassword").attr('type', 'password');
        $("#inputPassword").addClass("active");
    }
});   
</script> -->
<!-- 
	<script type="text/javascript">
	$(document).ready(function(){		
		$('.form-checkbox').click(function(){
			if($(this).is(':checked')){
				$('#inputPassword').attr('type','text');
			}else{
				$('#inputPassword').attr('type','password');
			}
		});
	});
</script> -->

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>