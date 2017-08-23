<?php
   
    session_start();
    require('config.php');
    $obj= new DB_Query();
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_REQUEST["mUsername"]) && isset($_REQUEST["mPassword"])){
            $username = trim($_REQUEST["mUsername"]);
            $password = trim($_REQUEST["mPassword"]);
            
            
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
<html>
<head>
    <title></title>
    
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.css" style="text.css"> <link href="styles.css" type="text/css" rel="stylesheet">

    
</head>
<body>

    <section id="form">
        <div class="wrapper">
            <div class="action">
                <h1>Authorized Access Only</h1>
            </div>
            <div class="content">
                <h2>Invoice / billing system</h2>
               <?php if(isset($error)){
                     print "<p class='error'>Error: Please Check Your username or password</p>";
                    } ?>
                
                <form method="post" action="#">
                    <input type="text" name="mUsername" placeholder="Enter username" required="true" /><br>
                    <input type="password" name="mPassword" placeholder="Password" required="true" /><br>
                    <input type="submit" name="submit" value="Login"/>
                </form>
            </div>
        </div>
    </section>

</body>

</html>