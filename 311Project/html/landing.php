<!DOCTYPE html>
<html>
<?php  require_once 'login.php';
session_start();
$conn = new mysqli($hn, $un, $pw, $db);
 if ($conn->connect_error)
     die($conn->connect_error);
     echo <<<_END
     <head>
     <style>

    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
  <body class="text-center" style="background-color:#FBFCFC;">
    	<img class="mb-4" src="../image/icon.png" alt="" width="72" height="72">
_END;
  if (isset($_POST['email'])){
       $email    = get_post($conn, 'email');
       $query   = 'SELECT user_name,user_code, user_id FROM `user_info` WHERE user_email="'.$email.'"';
       $result   = $conn->query($query);
       if (!$result) die($conn->error);
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $name=$row['user_name'].'<a href="signin.php">,  Log out</a></div>';
       $usercode=$row['user_code'];
       echo $name.'</br></div>';
       $_SESSION["u_id"] = $row['user_id'];
  }
  else if ($_SESSION["u_id"] != ""){
    $query   = 'SELECT user_name,user_code FROM `user_info` WHERE user_id="'.$_SESSION["g_id"].'"';
    $result   = $conn->query($query);
       if (!$result) die($conn->error);
       $row = $result->fetch_array(MYSQLI_ASSOC);
       $name=$row['fname']." ".$row['lname'].'<a href="http://wang1lx.myweb.cs.uwindsor.ca/60311/html/signin.php">,  Log out</a></div>';
       $usercode=$row['user_code'];
       echo $name.'</br></div>';
     }
else echo '<a href="signin.php">sign in</a></div>';
echo <<<_END
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#contact">Contact</a>
  <input type="text" placeholder="Search..">
</div>
_END;
echo <<<_END

_END;
echo <<<_END

</body>
_END;
  $result->close();
  $conn->close();

  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
 ?>
 </html>
