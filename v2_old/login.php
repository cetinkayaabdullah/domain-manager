<?php
      require_once  "config.php";
      
      
      if (
          (isset($_POST['usernmail']) and !empty($_POST['usernmail'])) And
          (isset($_POST['password']) and !empty($_POST['password']))
        ){

            $usermail     =   strip_tags($_POST['usernmail']);
            $userpass     =   md5(strip_tags($_POST['password']));

            $row  = $db->get_row("SELECT * FROM user WHERE user_mail = '{$usermail}' and user_pass = '{$userpass}' ");
            if ( $db->num_rows == '1'){

                $_SESSION["name"]       = $row->user_name;
                $_SESSION["surname"]    = $row->user_surname;
                $_SESSION['ok']         = "998574";
                
                header("Location:index.php");
                die;

            }else{

 
            }

        }
        
        if ((isset($_SESSION['ok'])) and (!empty($_SESSION['ok'])) and ($_SESSION['ok'] == '998574') ){
                                        header("Location:index.php");
                                        die;
        }
        
      
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $_title;?></title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" name="usernmail" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
              <div>
                <button type="submit">Log in</button>
                <a class="reset_pass" href="#"></a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />
                <div>
                  <h1><i class="fa fa-link"></i> Domain Manager</h1>
                  <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>