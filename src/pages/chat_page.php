<?php
include_once "db/conn.php";
include_once "components/chat/chat.php";
include_once "components/chat/user.php";
Db::connect();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["message"])) {
    $chat = new Chat();
    $user = new User("Hosua");
    $message = $_POST["message"];
    if (!empty(trim($message))) {
        $chat->addLog($user, trim($message));
    }
    ob_end_clean();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}
?>

<div class="container mt-3">
    <?php include_once "components/chat/chat.php"; getChat(); ?>
    <form method="post" class="d-flex">
        <input type="text" class="form-control" id="input-text" name="message" required>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
