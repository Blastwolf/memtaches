<!doctype html>
<html lang="fr">
<head>
    <base href="<?= ROOTDIR ?>">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/style.css">
    <title>MemTaches</title>
</head>
<body>
<?php include $view ?>
<footer>
    <p>Créé par Blastwolf.</p>
</footer>
<script src="public/js/jquery.js"></script>
<script src="public/js/moment-with-locales.js"></script>
<script src="public/js/calendar_v2.js"></script>
<script src="public/js/ajax-requests.js"></script>
<script src="public/js/calendar-component-events.js"></script>
<script>
        let date = '<?php echo($date) ?>';
        const calendar = new Calendar_v2(date);
        let calendarComponent = $('#calendar-component');
        let ajaxRequestsObj = new AjaxRequests(calendar,calendarComponent);
        let calendarComponentEvents = new CalendarComponentEvents(calendar);
</script>
</body>
</html>