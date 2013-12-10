<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include("lib_php/source.php");
    ?>
</head>
<body>        
    <div id="wrapper" class="screen_wide sidebar_off">       
        <div id="layout">
            <div id="content">                        
                <div class="wrap nm">            
                    
                    <div class="signin_block">
                        <div class="row-fluid">
                            <?php
                            $res = "";
                            if(isset($_GET['res'])){
                                $res = $_GET['res'];
                            }
                            if($res == "failed"){
                            ?>
                            <div class="alert alert-error">
                                <strong>Gagal melakukan login!</strong>
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="block">
                                <div class="head">
                                    <h2>Form Login</h2>
                                </div>
                                <form action="lib_php/validate.php" method="post">
                                <div class="content np">
                                    <div class="controls-row">
                                        <div class="span3">Username:</div>
                                        <div class="span9"><input type="text" name="username" class="input-block-level" value="" placeholder="Username"/></div>
                                    </div>
                                    <div class="controls-row">
                                        <div class="span3">Password:</div>
                                        <div class="span9"><input type="password" name="password" class="input-block-level" value="" placeholder="Password"/></div>
                                    </div>                                
                                </div>
                                <div class="footer">
                                    <div class="side fl">
                                        <label class="checkbox">
                                            <input type="checkbox" name="keeplogin"/> Biarkan saya masuk
                                        </label>
                                    </div>
                                    <div class="side fr">
                                        <button class="btn btn-primary">Masuk</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>               
        
    </div>
    
</body>
</html>
