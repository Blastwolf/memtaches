<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <link rel="stylesheet" href="public/css/bootstrap.css" type="text/css">-->
    <link rel="stylesheet" href="public/css/export.css" type="text/css">
    <title>Période export</title>
</head>
<body>
<h1><?=$title?></h1>

<?php foreach($tasks as $task):?>
<div class="task-container">
    <div class="test" style="width:<?= $task['%']?>%"><div class="test-text"></div></div>
    <div class="progress-container">
        <div class="progress-bar" style="width:<?= $task['%']?>%;"><span class="days"><?= $task['nOfDays']?>j</span></div>
    </div>
    <small class="datedebut"><?=$task['datedebut']?></small><small class="datefin"><?=$task['datefin']?></small>
    <p class="task"><?= $task['task']?></p>
</div>
<?php endforeach;?>
</body>
</html>

