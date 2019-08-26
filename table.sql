CREATE DATABASE IF NOT EXISTS calendar;
USE calendar;

DROP TABLE IF EXISTS calendar_tasks;
CREATE TABLE IF NOT EXISTS calendar_tasks (
  id int(11) NOT NULL AUTO_INCREMENT,
  task text NULL,
  datedebut date NULL,
  datefin date NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=uft8;