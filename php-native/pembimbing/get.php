<?php
    include "../connect.php";

    $id = isset($_POST["id"]) ? $_POST["id"] : "";

    if($id){
        $sql =  "SELECT * FROM pembimbing WHERE id = '".$id."'";
        $query = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_assoc($query);
        echo json_encode ([
            'status' => 'oke',
            'result' => $fetch
        ]);
    } else {
        $sql = "SELECT * FROM pembimbing";
        $query = mysqli_query($conn, $sql);
        while($data = mysqli_fetch_assoc($query)){
            $item[] = $data;
        }
        $response = array(
            'status' => 'tidak oke',
            'data' => $item
        );

        echo json_encode($response);
    };
?>