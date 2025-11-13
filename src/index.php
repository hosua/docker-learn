<?php
set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
include_once "db/conn.php";
session_start();
Db::connect();
?>

<!doctype html>
<html lang="en">
    <?php include_once "header.php" ?>
    <body>
    <h3>click me</h3>
    <form method="post">
        <input class="btn btn-primary" type="submit" name="increment" value="<?php echo $_SESSION['counter'] ?>">
        </form>
        <?php
        Db::query("SELECT id, name, age FROM people");
while ($data = Db::fetch_next_object()) {
    echo "{$data->id}. {$data->name}<br>";
}
?>
  </body>
</html>

<?php
?>
