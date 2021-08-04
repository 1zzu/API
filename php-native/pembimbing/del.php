<?php
    include "../connect.php";

    $id = $_GET["id"];

    $sql =  "DELETE FROM pembimbing WHERE `pembimbing`.`id` = '".$id."'";
    $query = $db->query($sql);

    if($query) {
        $res = [
          "status" => "OK",
          "message" => "succesfully deleted",
          "result" => $id
        ];
      }
      else {
        $res = [
          "status" => "FAIL",
          "message" => "failed",
          "result" => $db->error
        ];
      }

    echo json_encode($res);
?>