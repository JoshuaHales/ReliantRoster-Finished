<?php

class EmployeeTableGateway {

    //connection object
    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    //--query to get all employees from db and order them in desired way according to parametor--
    public function getEmployees($sortOrder) {
        $sqlQuery = "SELECT * FROM employee ORDER BY " . $sortOrder;    //the query
        $statement = $this->connection->prepare($sqlQuery);             //getting statement reaady
        $status = $statement->execute();                                //executing the query

        if (!$status) {                                                 //if no response theres an error
            die("Could not retrieve employee");
        }
        return $statement;
    }

    //--query to get specific employee from db by their id--
    public function getEmployeeByID($id) {
        $sqlQuery = "SELECT * FROM employee WHERE id = :id";            //the query
        $statement = $this->connection->prepare($sqlQuery);             //getting statement reaady
        $params = array(
            "id" => $id                                                 //setting value of placeholder
        );
        $status = $statement->execute($params);                         //executing the query

        if (!$status) {                                                 //if no response theres an error
            die("Could not retrieve employee");
        }
        return $statement;
    }

    //--query to get specific employee from db by their username--
    public function getEmployeeByUsername($username) {
        $sqlQuery = 'SELECT * FROM employee WHERE username = "' . $username . '"'; //the query
        $statement = $this->connection->query($sqlQuery);                         //getting statement reaady
        if (!$statement) {
            die('Could not retrieve employee details');                           //if no response theres an error
        }
        return $statement;
    }
    //--query to insert an employee into db--
    public function insertEmployee($n, $e, $u, $p) {
        $sqlQuery = "INSERT INTO employee " .                          //the query
                "(name, email, username, password) " .
                "VALUES (:name, :email , :username, :password)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(                                               //setting values of placeholders
            "name" => $n,
            "email" => $e,
            "username" => $u,
            "password" => $p
        );
        
        $status = $statement->execute($params);                        //executing the query

        if (!$status) {                                                //if no response theres an error
            die("Could not insert employee");
        }

        $id = $this->connection->lastInsertId();
        // need to add in event id 
        return $id;
    }
    //--query to delete an employee from the db--
    public function deleteEmployee($id) {
        $sqlQuery = "DELETE FROM employee WHERE id = :id";            //the query

        $statement = $this->connection->prepare($sqlQuery);           //getting statement reaady
        $params = array(                                              //setting value of placeholder
            "id" => $id 
        );

        $status = $statement->execute($params);                       //executing the query

        if (!$status) {
            die("Could not delete employee");
        }

        return ($statement->rowCount() == 1);
    }
    //--query to update an employee--
    public function updateEmployees($eID, $n, $e, $u, $p) {
        $sqlQuery = "UPDATE employee SET " .                        //the query
                "name = :name, " .
                "email = :email, " .
                "username = :username, " .
                "password = :password " .
                " WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);         //getting statement reaady
        $params = array(                                            //setting value of placeholder
            "id" => $eID,
            "name" => $n,
            "email" => $e,
            "username" => $u,
            "password" => $p
        );
        
        $status = $statement->execute($params);                     //executing the query

        if (!$status) {                                             //if no response theres an error
            die("Could not update employee");
        }
        return ($statement->rowCount() == 1);
    }
}