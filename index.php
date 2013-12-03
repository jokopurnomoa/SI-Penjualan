<?php
include("lib_php/connection.php");
include("lib_php/modul-controller.php");

$hak_akses = "admin";
if(isset($_SESSION['hak_akses'])){
    $hak_akses = $_SESSION['hak_akses'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("lib_php/source.php");
    ?>
</head>
<body>
    <div id="wrapper">
        <!-- Header here -->
        <?php
        include("lib_php/header.php");
        ?>

        <div id="layout">
            <!-- Sidebar here -->
            <?php
            include("lib_php/sidebar.php");
            ?>

            <div id="content">
                <div class="wrap">
                    <?php
                    show_modul($modul, $submodul);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
