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
<h1><?= $title ?></h1>
<table>
    <?php foreach ($tasks as $task): ?>
        <tr>
            <td>
                <div class="task-container">
                    <h4 class="task-app"><?= $task['app']?></h4>

                    <div class="progress-container">
                        <div class="progress-bar" data-app="<?= $task['type'] ?>" style="width:<?= $task['%'] ?>%;background-color: <?= progressBarBackgroundColor($task['type'])?>"><span class="days"><?= $task['nOfDays'] ?>j</span></div>
                    </div>
                    <small class="datedebut"><?= $task['datedebut'] ?></small>
                    <small class="datefin"><?= $task['datefin'] ?></small>
                    <p class="task"><?= $task['task'] ?></p>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>

