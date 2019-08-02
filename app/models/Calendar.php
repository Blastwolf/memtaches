<?php

class Calendar{
    private $_months =["","Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"];
    private $_year;
    private $_calendar=[];

    public function __construct(?int $year=null)
    {
            if($year===null){
                $this->_year = date('Y');
            }elseif ($year >= 1970){
                $this->_year = $year;
            }else{
                throw new Exception("Il y a eu une erreur avec l'année");
            }

        for($month=1;$month<=12;$month++){
            $nbDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
            for($i=1;$i<=$nbDays;$i++){
                $time = strtotime("$i.$month.$year");
//                echo date('Y-M-D-d',$time)."<br/>";
//                echo strftime("%A-%d",$time)."<br/>";
                $this->_calendar[$this->_months[$month]][]=strftime("%A-%d-%Y",$time);
            }
        }
//        echo '<pre>';
//        print_r($this->_calendar);
//        echo '<pre>';
//        echo json_encode($this->_calendar,JSON_UNESCAPED_UNICODE);
    }

    public function getJsonCalendar(){
        return json_encode($this->_calendar,JSON_UNESCAPED_UNICODE);
    }

}