<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-icons.css"/>
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/dataTables.dateTime.min.css" />
    <link rel="stylesheet" href="css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- <link rel="stylesheet" href="js/dataTables.bootstrap5.min.js"/>
    <link rel="stylesheet" href="js/jquery.dataTables.min.js"/> -->
    <script src="js/jszip.min.js"></script>
    <link rel="icon" href="images/Logo.png">
    <title>SALES AND INVENTORY SYSTEM</title>

    <style>
        .aligned {
            display: flex;
            align-items: center;
        }
           
        span {
            padding: 30px;
        }
    </style>
</head>
<body>
    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">Karesma Trading</a>
      </div>
    </nav>
        <!-- top navigation bar -->


    <main class="mt-5 pt-5 overflow-hidden">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-secondary"><center><img src="images/Logo.png" alt="" class="img-thumbnail" width="100" height="100"></center></div>
                                <div class="col-lg-6 bg-light">
                                    <div class="aligned bg-success">
                                        <img src="images/Admin1.png" alt="" class="img-thumbnail" width="100" height="100">
                                        <h1><span class="text-uppercase fw-bold text-light"> SIGN IN </span></h1>
                                    </div>
                                    <div class="p-5 bg-light">
                                        <form class="user" action="" method="POST" >
                                            <div class="form-group mb-4">
                                                <div class="input-group"><span class="input-group-text"><i class="bi bi-key-fill"></i></span><input type="text" class="form-control form-control-user" name="username" id="username" placeholder="Enter Username"></div>
                                            </div>
                                            <div class="form-group mb-5">
                                                <div class="input-group"><span class="input-group-text"><i class="bi bi-key-fill"></i></span><input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Enter Password"></div>
                                            </div>
                                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                                <button type="submit" name="signin" id="signin" class="btn btn-primary"><i class="bi bi-box-arrow-right"></i> Sign In</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <?php include('templates/footer.php'); ?>

  </body>
</html>

