<?php 
     require "./Component/Header.php";
    require "./Component/nav.php";


    //    session_start();
       if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']=true)
       {
        session_unset();
        session_destroy();
       }



        $showAlertSuccess=false;
        $showAlertError=false;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //connect to database
        require "./Component/db_connect.php";

        $userName=$_POST["userName"] ;
        $userName=strtolower($userName);
        $password=$_POST["password"];
        // echo($userName);
        // echo($password);
        // echo($cPassword);



            // $sql="SELECT `userName` FROM `users` WHERE `userName`='$userName' AND `password`='$password'";
             $sql="SELECT * FROM `users` WHERE `userName`='$userName' ";
            $result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);
            if($count>0){
                while ($row=mysqli_fetch_assoc($result)){
                    if(password_verify($password, $row['password'])){
                        $showAlertSuccess=true;
                        session_start();
                        $_SESSION['loggedin']=true;
                        $_SESSION['userName']=$userName;
                        header("location:welcome.php");
                    }
                    else{
                        $showAlertError=true;
                     } 
                }
            }
            else{
                $showAlertError=true;
             }    
             
    }
?>

<?php

if($showAlertSuccess){
    echo '
    <div class="alert alert-success" role="alert">
      Account Created Successfuly ;
    </div>
    <br><br>
    ';
}

if($showAlertError){
    echo'
    <div class="alert alert-danger" role="alert">
     User name or Password not match. does not have account <a href="#" class="alert-link"> Sign Up here </a>.
    </div>
    <br><br>
    ';
}
  
?>

<div style=" margin:auto; margin-top:50px; width:50%; " class="border border-primary p-5 rounded-lg">
<h1 class="text-primary text-center"> Login Here</h1>
<br><br>
<form action="login.php" method="post">
  <div class="form-group">
    <label for="userName">User Name</label>
    <input type="text" class="form-control" id="userName" name="userName"  required aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<?php 
 require "./Component/footer.php";
 ?>