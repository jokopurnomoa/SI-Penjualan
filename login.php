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
                            <div class="block">
                                <div class="head">
                                    <h2>Form Login</h2>
                                    <ul class="buttons">                                        
                                        <li><a href="#" class="tip" title="Contact administrator"><i class="i-warning"></i></a></li>
                                        <li><a href="#" class="tip" title="Forget your password?"><i class="i-locked"></i></a></li>
                                    </ul>                                     
                                </div>
                                <form action="index.php" method="post">
                                <div class="content np">
                                    <div class="controls-row">
                                        <div class="span3">Username:</div>
                                        <div class="span9"><input type="text" name="login" class="input-block-level" value="root"/></div>
                                    </div>
                                    <div class="controls-row">
                                        <div class="span3">Password:</div>
                                        <div class="span9"><input type="password" name="password" class="input-block-level" value="root"/></div>
                                    </div>                                
                                </div>
                                <div class="footer">
                                    <div class="side fl">
                                        <label class="checkbox">
                                            <input type="checkbox" name="kmsi"/> Biarkan saya masuk
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
