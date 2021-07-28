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

        public function create($file) {
            require "database/db.php";
            
            $xlsx = new SimpleXLSX($file);
            $fp = fopen( 'file.csv', 'w');
            foreach( $xlsx->rows() as $fields ) {
                fputcsv( $fp, $fields);
            }
            fclose($fp);

            $fo = fopen('file.csv', 'r');

            $c = 0;
            while(($filesop = fgetcsv($fo, 1000, ",")) !== false) {

                if ($c++ == 0) continue;
                $lname = $filesop[0];
                $fname = $filesop[1];
                $mname = $filesop[2];
                $course = $filesop[3];
                $sql = "INSERT INTO students(LAST_NAME, FIRST_NAME, MIDDLE_NAME, COURSE) VALUES ('$lname','$fname', '$mname', '$course')";
                $statement = $connection->prepare($sql);
                $statement->execute();

                $c = $c + 1;
            }

            header("Location: /phpexcel");
        }
    }


?>