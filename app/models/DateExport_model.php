<?php

class DateExport_model
{
    public $_biggestPeriodInDays;
    public $_tasks;

    public function __construct(&$tasks){
        $this->_tasks = &$tasks;

        $this->findBiggestPeriodInDays();
        $this->addPcentDiffAndNumOfDayToTasks();
        $this->convertDateToFr();
    }

    public function findBiggestPeriodInDays()
    {
        $bigPeriod = 1;
        foreach ($this->_tasks as $task) {

            $datedebut =$task['datedebut'];
            $datefin = $task['datefin'];
//            $dateDiff = (date_diff($datedebut, $datefin)->days) + 1;
            $dateDiff = $this->workDays($datedebut,$datefin);

            $bigPeriod = $dateDiff > $bigPeriod ? $dateDiff : $bigPeriod;
        }
        $this->_biggestPeriodInDays = $bigPeriod;
    }

    public function addPcentDiffAndNumOfDayToTasks()
        {
            $bigPeriod = $this->_biggestPeriodInDays;

            foreach($this->_tasks as $key=>&$task){
                $datedebut =$task['datedebut'];
                $datefin = $task['datefin'];

//              $dateDiff = (date_diff($datedebut, $datefin)->days) + 1;
                $dateDiff= $this->workDays($datedebut,$datefin);
                $pourcent = ($dateDiff / $bigPeriod) * 100;
                $task['%'] = $pourcent;
                $task['nOfDays'] = $dateDiff;

            }
        }

    public function convertDateToFr(){
        foreach($this->_tasks as &$task){
            $task['datedebut'] = date('d-m-Y',strtotime($task['datedebut']));
            $task['datefin'] = date('d-m-Y',strtotime($task['datefin']));
        }
    }
    public function workDays($datedebut,$datefin){
        $interval = new DateInterval('P1D');

        $period = new DatePeriod(new DateTime($datedebut),$interval,new DateTime($datefin));
        $workDays =1;
        foreach($period as $day){
            if($day->format('D') != 'Sat' && $day->format('D') !='Sun'){
                $workDays++;
            }
        }
        return $workDays;
    }
}