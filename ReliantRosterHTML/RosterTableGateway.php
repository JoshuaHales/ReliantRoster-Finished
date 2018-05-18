<?php
class RosterTableGateway {
    //connection object
    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }
    //--query to get all rosters from db and order them in desired way according to parametor--
    public function getRosters($sortOrder, $sortByWeek) {
        $sqlQuery = "SELECT r.*, e.name FROM roster r
                LEFT JOIN employee e ON e.id = r.employeeID " .
                (($sortByWeek == NULL) ? "" : "WHERE r.title LIKE :sortByWeek") .
                ' ORDER BY ' . $sortOrder;

        $statement = $this->connection->prepare($sqlQuery);
        
        if ($sortByWeek != NULL) {
            $params = array(
                "sortByWeek" => "%" . $sortByWeek . "%"
            );
            $status = $statement->execute($params);
        } else {
            $status = $statement->execute();
        }
        if (!$status) {
            die("Could not retrieve RosterTableGateway");
        }
        return $statement;
    }

   //--query to get specific roster by employee id--
    public function getRostersByEmployeeID($employeeID) {
        // Execute A Query To Get All Buses:
        $sqlQuery = "SELECT * FROM roster
                     LEFT JOIN employee ON employee.id = roster.employeeID
                     WHERE roster.employeeID = :employeeID";

        $params = array(
            'employeeID' => $employeeID
        );
        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve Buses");
        }

        return $statement;
    }
    //--query to get specific roster by id--
    public function getRosterByID($rosterID) {
        // Execute A Query To Get The User With The Specified busID:
        $sqlQuery = "SELECT * FROM roster
                     LEFT JOIN employee ON employee.id = roster.employeeID
                     WHERE rosterID = :rosterID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "rosterID" => $rosterID
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve roster");
        }
        return $statement;
    }

    //--query to insert an roster into db--
    public function insertRoster($t, $d, $m, $tu, $w, $th, $f, $sat, $sun, $tl, $empID) {
        $sqlQuery = "INSERT INTO roster " .
                "(title, description, monday, tuesday, wednesday, thursday, friday, saturday, sunday, total, employeeID) " .
                "VALUES (:title, :description, :monday, :tuesday, :wednesday, :thursday, :friday, :saturday, :sunday, :total, :employeeID)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "title" => $t,
            "description" => $d,
            "monday" => $m,
            "tuesday" => $tu,
            "wednesday" => $w,
            "thursday" => $th,
            "friday" => $f,
            "saturday" => $sat,
            "sunday" => $sun,
            "total" => $tl,
            "employeeID" => $empID
        );
        
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not insert roster");
        }

        $id = $this->connection->lastInsertId();
        // need to add in event id 
        return $id;
    }
    
   //--query to update an roster--
   public function updateRoster($rID, $t, $d, $m, $tu, $w, $th, $f, $sat, $sun, $tl, $empID) {
        $sqlQuery = "UPDATE roster SET " .
                "title = :title, " .
                "description = :description, " .
                "monday = :monday, " .
                "tuesday = :tuesday, " .
                "wednesday = :wednesday, " .
                "thursday = :thursday, " .
                "friday = :friday, " .
                "saturday = :saturday, " .
                "sunday = :sunday, " .
                "total = :total, " .
                "employeeID = :employeeID " .
                " WHERE rosterID = :rosterID ";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "rosterID" => $rID,
            "title" => $t,
            "description" => $d,
            "monday" => $m,
            "tuesday" => $tu,
            "wednesday" => $w,
            "thursday" => $th,
            "friday" => $f,
            "saturday" => $sat,
            "sunday" => $sun,
            "total" => $tl,
            "employeeID" => $empID
        );
    
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not update event");
        }
        return ($statement->rowCount() == 1);
    }
    
    //--query to delete a roster from the db--
    public function deleteRoster ($rosterID) {
        $sqlQuery = "DELETE FROM roster WHERE rosterID = :rosterID";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "rosterID" => $rosterID
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete roster");
        }

        return ($statement->rowCount() == 1);
    }
}