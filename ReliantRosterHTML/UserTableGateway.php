<?php

class UserTableGateway {
    private $connection;
    //connection object
    public function __construct($c) {
        $this->connection = $c;
    }

    //--query to get all users from db--
    public function getUser() {
        $sqlQuery = 'SELECT * FROM user';
        $statement = $this->connection->query($sqlQuery);
        if (!$statement) {
            die('iiii Could not retrieve user details');
        }
        return $statement;
    }

    //--query to get user by employee username--
    public function getUserByUsername($username) {
        $sqlQuery = 'SELECT * FROM user WHERE username = "' . $username . '"';
        $statement = $this->connection->query($sqlQuery);
        if (!$statement) {
            die('iiii Could not retrieve user details');
        }
        return $statement;
    }

    //--query to get user by id--
    public function getUserByID($id) {
        $sqlQuery = 'SELECT * FROM user WHERE id = "' . $id . '"';
        $statement = $this->connection->query($sqlQuery);
        if (!$statement) {
            die('iiii Could not retrieve user details');
        }
        return $statement;
    }

    //--query to get the user's ID by their username--
    public function getUserIDByUsername($username) {
        // execute a query to see if username is in the database
        $sqlQuery = 'SELECT id FROM user WHERE username = "' . $username . '"';
        $statement = $this->connection->query($sqlQuery);
        if (!$statement) {
            die('Could not retrieve user details');
        }
        return $statement;
    }

    //--query to insert a user into db--
    public function insertUser($username, $password, $fullname, $emailaddress, $customTime) {
        $sqlInsert = "INSERT INTO user(username, password, fullname, emailaddress, customTime) "
                . "VALUES (:username, :password, :fullname, :emailaddress, :customTime)";
        $statement = $this->connection->prepare($sqlInsert);
        $params = array(
            "username" => $username,
            "password" => $password,
            "fullname" => $fullname,
            "emailaddress" => $emailaddress,
            "customTime" => $customTime
        );
        $status = $statement->execute($params);
        if (!$status) {
            die('Could not store user details');
        }
    }

    //--query to update a user--
    public function updateUsers($uID, $ct) {
        $sqlQuery = "UPDATE user SET " .
                "customTime = :customTime " .
                " WHERE id = :id";
        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $uID,
            "customTime" => $ct
        );
        $status = $statement->execute($params);
        if (!$status) {
            die("Could not update employee");
        }
        return ($statement->rowCount() == 1);
    }
}
