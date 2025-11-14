<?php
set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
include_once "db/conn.php";
include_once "components/chat/chat.php";
include_once "components/chat/user.php";
session_start();
Db::connect();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    $chat = new Chat();
    $user = new User("Hosua");
    $message = $_POST["message"];
    if (!empty(trim($message))) {
        $chat->addLog($user, trim($message));
    }
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>

<!doctype html>
<html lang="en">
    <?php include_once "header.php" ?>
    <body>
        <div class="container mt-3">
            <?php include_once "components/chat/chat.php"; getChat(); ?>
            <form method="post" class="d-flex">
                <input type="text" class="form-control" id="input-text" name="message" required>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>

<?php
?>
