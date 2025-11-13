<?php
set_include_path(__DIR__ . PATH_SEPARATOR . get_include_path());
include_once "db/conn.php";
include_once "components/chat/chat.php";
include_once "components/chat/user.php";
session_start();
Db::connect();
?>

<!doctype html>
<html lang="en">
    <?php include_once "header.php" ?>
    <body>
        <?php
        Db::query("SELECT id, name, age FROM people");
$chat = new Chat();
$user = new User("Hosua");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    $message = $_POST["message"];
    if (!empty(trim($message))) {
        $chat->addLog($user, trim($message));
    }
}

$chat_logs = $chat->getLogs();
echo $chat_logs;
?>
        <form method="post" class="d-flex">
            <input type="text" class="form-control" id="input-text" name="message" required>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </body>
</html>

<?php
?>
