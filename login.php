<?php include('signin.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- <link rel="stylesheet" href="js/dataTables.bootstrap5.min.js"/>
    <link rel="stylesheet" href="js/jquery.dataTables.min.js"/> -->
    <script src="js/sweetalert.min.js"></script>
    <link rel="icon" href="images/Logo.png">
    <title>SALES AND INVENTORY SYSTEM</title>
</head>
<body>


<div class="wrapper">
    <div class="left">  
        <img src="images/Logo.png" alt="logo">
    </div>

    <div class="right">
        <div class="tabs bg-success">
            <ul>
                <img src="images/Admin1.png" alt="" class="img-thumbnail mb-2" width="80" height="80">
                <span><li class="login_li">SIGN IN</li></span>
            </ul>
        </div>
        <form class="user" action="" method="POST">
        <?php include('errors.php'); ?>
            <div class="login">
                <input type="hidden" id="account_id" name="account_id"/>
				<input type="hidden" id="position" name="position"/>
                <div class="input_field form-group mb-4">
                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-user"></i></span><input type="text" placeholder="Username" name="username" id="username" class="form-control"></div>
                </div>
                <div class="input_field form-group mb-5">
                    <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-key"></i></span><input type="password" placeholder="Password" name="password" id="password" class="form-control"><span class="input-group-text"><i class="fa-solid fa-eye" name="togglePassword" id="togglePassword"></i></span></div>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mx-2">
                    <button type="submit" name="signin" id="signin" class="btn btn-primary fw-bold"><i class="fa-solid fa-right-from-bracket"></i> Sign In</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});
</script>
</body>
</html>


