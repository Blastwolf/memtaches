<?php

use Dompdf\Dompdf;

class Calendar_controller extends Controller
{
    private $_calendar_model;

    public function __construct()
    {

        $this->_calendar_model = new Calendar_model();
    }

    public function index()
    {


        $data['date'] = date('Y-m-d');
        $data['view'] = "components/calendar/calendar.php";

        $this->render('templates/template.php', $data);

    }

    public function searchPeriod()
    {
        if (isset($_POST['datedebut']) && isset($_POST['datefin'])) {
            $tasks = $this->_calendar_model->searchPeriod($_POST);

            $dateDebut = date('d-m-Y', strtotime($_POST['datedebut']));
            $dateFin = date('d-m-Y', strtotime($_POST['datefin']));
            $title = "Pour la période du $dateDebut au $dateFin";

            $dateExport = new DateExport_model($tasks);

            $dompdf = new Dompdf();
            ob_start();
            include "components/export/export.php";
            $content = ob_get_clean();
            $dompdf->loadHtml($content);
            $dompdf->setPaper('A4','portrait');
            $dompdf->render();
            $dompdf->stream("export_{$dateDebut}_{$dateFin}.pdf",['Attachment'=>false]);
        }
    }
}
