<?php

    include 'controller/SimpleXLSX.php';

    require "database/db.php";

    include_once "model/queries.php";

    $queries = new Queries();
    $d = $queries->getData();

    if(isset($_POST["submit"])) {

          $file = $_FILES['file']['tmp_name'];
          $queries->create($file);
    }

?>