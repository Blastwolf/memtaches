<?php
require "app/models/Calendar.php";

class Calendar_controller
{
    public function __construct()
    {

    }

    public function index(){

        if(isset($_GET['year'])){
            echo(new Calendar($_GET["year"]))->getJsonCalendar();
            exit();
        }

        require "app/views/templates/header.php";
        $calendar = (new Calendar(2019))->getJsonCalendar();
        require "app/views/components/calendar/calendar.php";
        require "app/views/templates/footer.php";

    }
}
