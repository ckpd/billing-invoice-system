<?php
    session_start();
    require_once('config.php');
    $obj= new DB_Query();
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_REQUEST["mUsername"]) && isset($_REQUEST["mPassword"])){
            $username = $_REQUEST["mUsername"];
            $password = $_REQUEST["mPassword"];
            
            
            $onny = $obj->login($username, $password);
            
            if($onny == true ){
               $_SESSION["username"] = $username;
                header("location: createinvoice.php");
            }else{
               $error =  "sorry your login and password has an error";
            }
            
        }
    }


?>
<?php
    include("views/header-login.php");        
?>
<body id="main">
    <?php 
        if(isset($error)){
            print "<p class='error'>Error: Please Check Your username or password</p>";
        } 
    ?>
    <section id="form">
        <div class="wrapper">
            <div class="action">
                <h1>Authorized Access Only</h1>
            </div>
            <div class="content">
                <h2>Invoice / billing system</h2>                
                <form method="post" action="#">
                    <input type="text" name="mUsername" placeholder="Enter username" required="true" /><br>
                    <input type="password" name="mPassword" placeholder="Password" required="true" /><br>
                    <input type="submit" name="submit" value="Login" id="btn-login"/>
                </form>
            </div>
        </div>
    </section>

</body>
