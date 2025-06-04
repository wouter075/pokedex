<?php
include "db.php";
include "function.php";

$stmt = $pdo->query("SELECT * FROM pokemon");
?>
<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pokedex - by Wouter</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <?php
        while ($row = $stmt->fetch()) {
            //echo "<li>{$row['name']} ({$row['type']})</li>";
        //}
            $img_src = strtolower($row['name']);
            //echo $img_src;
            // 250 = 100%
            $hp_width = $row['hp'] / 2.5;
        ?>
        <div class="col-md-3">
            <div class="card">
                <img src="img/<?= $img_src ?>.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $row['name'] ?>
                        <span class="badge text-bg-secondary">
                            <?= $row['type'] ?>
                        </span>
                    </h5>
                    <p class="card-text">
                    <div class="progress" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar text-bg-success" style="width: <?= $hp_width ?>%"><?= $row['hp'] ?></div>
                    </div>
                    </p>
<!--                    <a href="#" class="btn btn-primary">Go somewhere</a>-->
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
