<!DOCTYPE html>
<html lang="en">
<?php
    /*      session_start();
        if(!isset($_SESSION['i'])) {
            $_SESSION['i']= 0;
        }
    */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>login</title>
</head>
<body>
    <section class="sec1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="white" 
                fill-opacity="1" d="M0,64L26.7,90.7C53.3,117,107,171,160,186.7C213.3,203,267,181,
                320,170.7C373.3,160,427,160,480,144C533.3,128,587,96,640,122.7C693.3,149,747,
                235,800,261.3C853.3,288,907,256,960,224C1013.3,192,1067,160,1120,160C1173.3,
                160,1227,192,1280,192C1333.3,192,1387,160,1413,144L1440,128L1440,320L1413.3,
                320C1386.7,320,1333,320,1280,320C1226.7,320,1173,320,1120,320C1066.7,320,1013,
                320,960,320C906.7,320,853,320,800,320C746.7,320,693,320,640,320C586.7,320,533,
                320,480,320C426.7,320,373,320,320,320C266.7,320,213,320,160,320C106.7,320,53,
                320,27,320L0,320Z"></path></svg>
                
            <div class="container">
                <form action="traitement_index.php" method="post">
                    <h1 class="rs">RS_ANNONCE</h1>
                    <h4>LOGIN TO ACCOUNT</h4>
                        <?php
                            if (isset($_GET['msg'])) {
                                echo '<P style="color: white; background-color:red">'.$_GET['msg'];
                            }
                            if (isset($_GET['msg1'])) {
                                echo '<P style="color: white; background-color:red">'.$_GET['msg1'];
                            }
                            if (isset($_GET['msg2'])) {
                                echo '<P style="color: white; background-color:green">'.$_GET['msg2'];
                            }
                        ?>
                    <div class="info">
                        <?Php 
                            if (!isset($_GET['email']) and !isset($_GET['password'])){
                        ?>
                            <input type="email" class="name" name="email" id="email" placeholder="User Email">
                            <input type="password" class="password" name="password" placeholder="password">
                        <?php 
                           }
                            if(isset($_GET['email'])){
                        ?>
                            <input type="email" class="name" name="email" id="email" placeholder="User Email" value="<?php echo $_GET['email']?>">
                            <input type="password" class="password" name="password" placeholder="password">
                        <?php 
                            }
                            if(isset($_GET['password'])){
                        ?>
                            <input type="email" class="name" name="email" id="email" placeholder="User Email">
                            <input type="password" class="password" name="password" placeholder="password" value="<?php echo $_GET['password']?>">
                        <?php
                            }
                        /*     if ($_SESSION['i'] < 3){
                        */
                        ?>
                           <button type="submit" value="login" class="submit">log In</button>
                    </div>

                    <div class="suggestion">
                        <div class="options1">
                            <span><a href="register.php" style="text-decoration: underline; color:red; margin-left: 15px;">
                                Creer un compte
                            </a></span>
                        </div>
                        <div class="options2">
                            <span><a href="forgot.php" style="text-decoration: underline;">
                                Forgot password?
                            </a></span>
                        </div>
                        <?php
                          /*  }
                            else{
                              $_SESSION['i']=0;
                        ?>
                        <div class="options2">
                            <span><a href="forgot.php" style="background-color: red; text-transform: uppercase; cursor: pointer; font-size: 18px; color: white; padding: 5px 25px; border-radius: 60px; border: none; text-decoration:none;">
                                Forgot password
                            </a></span>
                        </div>
                        <?php */ ?>
                    </div>
                        <?php 
                           // }
                        ?>
                </form>
            </div>
        
        </section>
</body>
</html>
