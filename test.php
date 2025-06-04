<?php include 'db.php'; ?>
    <form method="post">
        <input type="text" name="pokemon" placeholder="Zoek op naam">
        <button type="submit">Zoeken</button>
    </form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['pokemon'])) {
        $name = $_POST['pokemon'];
        $stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ?");
        $stmt->execute(["%$name%"]);
    }
} else {
    $stmt = $pdo->query("SELECT * FROM pokemon");
}

while ($row = $stmt->fetch()) {
    echo "<li>{$row['name']} ({$row['type']})</li>";
}
