<?php

include_once 'conn.php';

Db::connect();

$sql = "SELECT id, name, age FROM people";
$result = Db::query($sql);

if ($result && pg_num_rows($result) > 0) {
    echo "<div class='container mt-4'>";
    echo "<h4>People:</h4>";
    echo "<ul class='list-group'>";
    while ($row = pg_fetch_assoc($result)) {
        echo "<li class='list-group-item'>ID: " . htmlspecialchars($row["id"]) .
             " - Name: " . htmlspecialchars($row["name"]) .
             " - Age: " . htmlspecialchars($row["age"]) . "</li>";
    }
    echo "</ul>";
    echo "</div>";
} else {
    echo "<div class='container mt-4'><p>0 results</p></div>";
}
