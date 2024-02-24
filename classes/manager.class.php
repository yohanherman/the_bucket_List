<?php


abstract class abstractManager
{

    abstract public function addTask(string $_task);
    abstract public function displayTask();
    abstract public function deleteTask(int $id);
    abstract public function editTask();
}


class Manager extends abstractManager
{

    private $_task;
    private $_id;
    private $_status;
    private $_conn;
    public $errorMessage = "champs requis";


    public function setStatus(int $status)
    {
        $this->_status = $status;
    }


    public function getStatus()
    {

        return $this->_status;
    }


    public function setTask(string $task)
    {
        if (is_string($task) && strlen($task) > 0) {

            $this->_task = $task;
        } else {
            trigger_error("invalide");
        }
    }

    public function getTask()
    {
        return $this->_task;
    }

    public function setId($_id)
    {

        if (is_int($_id) && $_id > 0) {
            $this->_id = $_id;
        } else {

            trigger_error("id invalide");
        }
    }

    public function getId()
    {

        return $this->_id;
    }


    public function __construct()
    {
        $this->_conn = new Database;
    }



    public function addTask($_task)
    {



        if (isset($_task) && !empty($_task)) {

            $requete = "INSERT INTO task (taskName) VALUES (:taskName)";
            $stmt = $this->_conn->prepare($requete);

            $stmt->bindParam(':taskName', $_task);

            $stmt->execute();


            if ($stmt->rowCount() > 0) {
                echo '<script>alert(" votre tache a  ajoutée avec succes")</script>';
            }
        }
    }

    public function displayTask()
    {
        $requete = "SELECT id ,taskName, status FROM task";
        $stmt = $this->_conn->prepare($requete);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);


        $arrTasks = [];

        foreach ($results as $element) {

            $obj = new Manager();
            $obj->setId($element->id);
            $obj->setTask($element->taskName);
            $obj->setStatus($element->status);

            $arrTasks[] = $obj;
        }

        return $arrTasks;
    }


    public function changeStatusto0($id)
    {
        $requete = 'UPDATE task SET status = 0 WHERE id =:id';
        $stmt = $this->_conn->prepare($requete);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function changeStatusto1($id)
    {

        $requete1 = 'UPDATE task SET status = 1 WHERE id =:id';
        $stmt1 = $this->_conn->prepare($requete1);
        $stmt1->bindParam(':id', $id);
        $stmt1->execute();
    }



    // public function changeStatusto0($id)
    // {
    //     if ($this->getStatus() == 1) {

    //         $requete = 'UPDATE task SET status = 0 WHERE id =:id';
    //         $stmt = $this->_conn->prepare($requete);
    //         $stmt->bindParam(':id', $id);
    //         $stmt->execute();
    //     } elseif ($this->getStatus() == 0) {
    //         $requete1 = 'UPDATE task SET status = 1 WHERE id =:id';
    //         $stmt1 = $this->_conn->prepare($requete1);
    //         $stmt1->bindParam(':id', $id);
    //         $stmt1->execute();
    //     }
    // }



    public function deleteTask($id)
    {

        $request = "DELETE FROM task WHERE id =:id";
        $stmt = $this->_conn->prepare($request);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function editTask()
    {
    }
}
