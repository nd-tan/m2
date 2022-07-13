<?php
include './dp.php';
// global $conn;
$sql = "SELECT * FROM customers";
$stmt = $conn->query($sql);
$stmt->setFetchMode(PDO::FETCH_OBJ);
$rows = $stmt->fetchAll();
// $name=$price=$quantity=$description=null;
if($_SERVER['REQUEST_METHOD']=='POST'){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmpassword=$_POST['confirmpassword'];
    $errors = [];
    if ($name==''){
        $errors['name']="You need to enter your name";
    }if ($email==''){
        $errors['email']="you need to enter your email";
    }if ($address==''){
        $errors['address']="you need to enter your address";
    }if ($phone==''){
        $errors['phone']="you need to enter your phone";
    }if ($password==''){
        $errors['password']="you need to enter your password";
    }if ($confirmpassword==''){
        $errors['confirmpassword']="you need to enter your confirmpassword";
    }
    if($password != $confirmpassword){
        $errors['pw']="confirmpassword is incorrect";
    }
    foreach($rows as $item){//////xử lý trùng email thì k đăng kí được
        if($item->email==$email){
            $errors['mail'] = 'Email already exist';
        }
    }
    if (empty($errors)) {
        $sql ="INSERT INTO `customers` (`name`, `phone`, `address`, `email`, `password`) VALUES ( '$name', '$phone', '$address', '$email', '$password')";
        $conn->query($sql);
        // $_SESSION['flash_message'] = "Thêm thành công";
        header('location:login.php');
    }
}
?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="../admin/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            span {
                color: red;
                }
        </style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="" type="text" placeholder="" name="name"/>
                                                    <label for="inputEmail">User Name</label>
                                                    <span><?php if (isset($errors['name'])) {
                                                         echo $errors['name'];
                                                            }  ?></span>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="" type="text" placeholder="" name="phone"/>
                                                    <label for="inputEmail">Phone</label>
                                                    <span><?php if (isset($errors['phone'])) {
                                                         echo $errors['phone'];
                                                            }  ?></span>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <input class="form-control" id="" type="text" placeholder="" name="address"/>
                                                    <label for="inputEmail">Address</label>
                                                    <span><?php if (isset($errors['address'])) {
                                                         echo $errors['address'];
                                                            }  ?></span>
                                                </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="" type="email" placeholder="" name="email"/>
                                                <label for="inputEmail">Email</label>
                                                <span><?php if (isset($errors['email'])) {
                                                         echo $errors['email'];
                                                            }  ?></span>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="" type="password" placeholder="" name="password"/>
                                                        <label for="inputPassword">Password</label>
                                                        <span><?php if (isset($errors['password'])) {
                                                         echo $errors['password'];
                                                            }  ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="" name="confirmpassword"/>
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                        <span><?php if (isset($errors['confirmpassword'])) {
                                                                        echo $errors['confirmpassword'];
                                                                    } if (isset($errors['pw'])) {
                                                                        echo $errors['pw'];
                                                                    } ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><button  class="btn btn-primary btn-block">Create Account</button></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../admin/js/scripts.js"></script>
    </body>
</html>
