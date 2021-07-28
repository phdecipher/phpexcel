<?php

    class Queries {

        public function getData(): array {
            require "database/db.php";

            $sql = "SELECT * FROM students";

            $statement = $connection->prepare($sql);
            $statement->execute();

            $data = $statement->fetchAll(PDO::FETCH_OBJ);

            return $data;
        }
    }


?>