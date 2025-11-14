<?php
ob_start();
set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
session_start();
?>

<!doctype html>
<html lang="en">
    <?php include_once "header.php" ?>
    <body>
        <?php include_once "pages/chat_page.php" ?>
    </body>
</html>
<?php
if (ob_get_level() > 0) {
    ob_end_flush();
}
?>
