<?php 
     require "./Component/Header.php";
    require "./Component/nav.php";

    // session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true)
    {
        header("location:login.php");
        exit;
    }
    echo "<h1> Welcome Home Page</h1>";

?>

<?php echo $_SESSION['userName'];?>
<?php
require "./Component/footer.php";
?>
