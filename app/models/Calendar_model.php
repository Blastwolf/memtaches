<?php

class Calendar_model{

    private $_db;

    public function __construct()
    {
            $this->_db = new PDO("mysql:host=localhost;dbname=calendar","root","");
            $this->_db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }


    public function addTask(array $data){


        $query = $this->_db->prepare("INSERT INTO calendar_tasks (datedebut, task ,datefin) VALUES(:datedebut, :task, :datefin)");
        $query->bindParam(':datedebut',$data['date']);
        $query->bindParam(':datefin',$data['date']);
        $query->bindParam(':task',$data['task']);

        return $query->execute();

    }

    public function taskInMonth($date){
            $query = $this->_db->prepare("SELECT * FROM calendar_tasks WHERE MONTH(datedebut) = MONTH(DATE_ADD(:date,INTERVAL -1 MONTH)) AND YEAR(datedebut) = YEAR(:date)
                                                  UNION
                                                  SELECT * FROM calendar_tasks WHERE MONTH(datedebut) = MONTH(:date) AND YEAR(datedebut) = YEAR(:year)");
            $query->bindParam(':date',$date);
            $query->bindParam(':year',$date);

            $query->execute();

            $result = $query->fetchAll();

            return $result;
    }
    public function extandDatePeriod($date,$id){
        $query = $this->_db->prepare("UPDATE calendar_tasks SET datefin = :date WHERE id = :id");
        $query->bindParam(':date',$date);
        $query->bindParam(':id',$id);
        return $query->execute();
    }
    public function deleteTask($id){
        $query = $this->_db->prepare("DELETE FROM calendar_tasks WHERE id = :id");
        $query->bindParam(':id',$id);

        return $query->execute();
    }

    public function searchPeriod($date){
        $query = $this->_db->prepare("SELECT * FROM calendar_tasks WHERE datedebut BETWEEN :datedebut AND :datefin ORDER BY datedebut");
        $query->bindParam(':datedebut',$date['datedebut']);
        $query->bindParam(':datefin',$date['datefin']);

        $query->execute();

        $result = $query->fetchAll();
        return $result;
    }

    public function editTask($data){
        $query = $this->_db->prepare("UPDATE calendar_tasks SET task = :task WHERE id = :id");

      $query->bindParam(':task',$data['task']);
      $query->bindParam(':id',$data['id']);

        return $query->execute();
    }
    public function reducTaskPeriod($date,$id){
        $query = $this->_db->prepare("UPDATE calendar_tasks SET datefin = :date WHERE id = :id AND datedebut < datefin");
        $query->bindParam(':date',$date);
        $query->bindParam(':id',$id);

        return $query->execute();

    }
}