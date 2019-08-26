<?php

class Api_controller{

    public function __construct()
    {
        $this->_calendar_model = new Calendar_model();
    }


    public function insertTask()
    {
        if (!empty($_POST) ) {

            if ($this->_calendar_model->addTask($_POST)) {
                $tasks = $this->_calendar_model->taskInMonth($_POST['date']);
                header('Content-Type: application/json');
                echo json_encode($tasks);
            }
        }
    }

    public function taskInMonth(){
        if(isset($_POST['date'])){
            $tasks = $this->_calendar_model->taskInMonth($_POST['date']);
            header('Content-Type: application/json');
            echo json_encode($tasks);
        }
    }

    public function extandDatePeriod(){
        if(isset($_POST['date'])){
            $tasks = $this->_calendar_model->extandDatePeriod($_POST['date'],$_POST['id']);
            header('Content-Type: application/json');
            echo json_encode($tasks);
        }
    }

    public function deleteTask(){
        if(isset($_POST['id'])){
            $task = $this->_calendar_model->deleteTask($_POST['id']);
            header('Content-Type: application/json');
            echo json_encode($task);
        }
    }
    public function editTask(){
        if(isset($_POST['id']) && isset($_POST['task'])){
            $task=  $this->_calendar_model->editTask($_POST);
            header('Content-Type: application/json');
            echo json_encode('efzefzefzef');
        }
    }



}