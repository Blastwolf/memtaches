<?php

use Dompdf\Dompdf;


class Calendar_controller extends Controller
{
    private $_calendar_model;
    public function __construct()
    {

            $this->_calendar_model = new Calendar_model();
    }

    public function index(){


        $data['date'] = date('Y-m-d');
        $data['view'] = "components/calendar/calendar.php";

        $this->render('templates/template.php',$data);

    }

    public function searchPeriod(){


        if(isset($_POST['datedebut']) && isset($_POST['datefin'])){
            $dompdf = new Dompdf();

            $tasks= $this->_calendar_model->searchPeriod($_POST);
        }

        $data['tasks'] = $tasks;
        $data['view'] = "components/export/export.php";
        ob_start();
        $this->render('templates/template.php',$data);
        $content = ob_get_clean();
        $dompdf->loadHtml($content);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream();

    }

}
