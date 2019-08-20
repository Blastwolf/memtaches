<footer>
    <p>Créer par Blastwolf.</p>
</footer>
<script src="public/js/jquery.js"></script>
<script src="public/js/moment-with-locales.js"></script>
<script src="public/js/calendar_v2.js"></script>
<script>

    document.addEventListener("DOMContentLoaded", function(){
        let date = '<?php echo($date) ?>';
        const calendar = new Calendar_v2(date);

    });
</script>
</body>
</html>