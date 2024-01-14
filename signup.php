<?php 

     require "./Component/Header.php";
    require "./Component/nav.php";
        $allset=true;
        $showAlertSuccess=false;
        $showAlertError=false;
        $passNotMatch=false;
        $userPresent=false;

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //connect to database
        require "./Component/db_connect.php";

        $userName=$_POST["userName"] ;
        $userName=strtolower($userName);
        $password=$_POST["password"];
        $cPassword=$_POST["cPassword"];

        if($userName==""){
            $allset=false;
        }
        // echo($userName);
        // echo($password);
        // echo($cPassword);



        if($password==$cPassword && $allset){
            $password=password_hash($password,PASSWORD_DEFAULT);
            $sql="SELECT `userName` FROM `users` WHERE `userName`='$userName'";
            $result=mysqli_query($conn,$sql);
            $count=mysqli_num_rows($result);

            if($count>0){
                // echo($count);
                $userPresent=true;
            }
            else{

                $sql="INSERT INTO `users` ( `userName`, `password`, `date`)
                     VALUES ( '$userName' , '$password', 'current_timestamp()');";

                 $result=mysqli_query($conn,$sql);
                if($result){
                   $showAlertSuccess=true;
                 }
                 else{
                    $showAlertError=true;
                }
             }            
     }
     else{
        $passNotMatch=true;
   }

}
?>

<?php

if($showAlertSuccess){
    echo '
    <div class="alert alert-success" role="alert">
      Account Created Successfuly <a href="#" class="alert-link">Login Now</a>.
    </div>
    <br><br>
    ';
}

if($showAlertError){
    echo'
    <div class="alert alert-danger" role="alert">
     Something Went Wrong Try again or <a href="#" class="alert-link">Login by another acount</a>.
    </div>
    <br><br>
    ';
}

if($userPresent){
    echo'
    <div class="alert alert-danger" role="alert">
     This User Name present already <a href="#" class="alert-link"> Sign By another user name </a>.
    </div>
    <br><br>
    ';
}


if($passNotMatch){
    echo'
    <div class="alert alert-danger" role="alert">
    Password not Match Enter valid password 
    </div>
    <br><br>
    ';
}
  
?>

<div style=" margin:auto; margin-top:50px; width:50%; " class="border border-primary p-5 rounded-lg">
<h1 class="text-primary text-center"> SignUp Here</h1>
<br><br>
<form action="signup.php" method="post">
  <div class="form-group">
    <label for="userName">User Name</label>
    <input type="text" maxlength="11" class="form-control" id="userName" name="userName"  required aria-describedby="emailHelp">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" maxlength="11" class="form-control" id="password" name="password" required>
  </div>
  <div class="form-group">
    <label for="cPassword">Comfirm Password</label>
    <input type="password" maxlength="11"  class="form-control" id="cPassword" name="cPassword" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>


<?php 
 require "./Component/footer.php";
 ?>