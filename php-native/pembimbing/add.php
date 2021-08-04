<?php
    include "../connect.php";

    $name = isset($_POST["name"]) ? $_POST["name"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $baseUrl = "http://192.168.43.87/PKL/pembimbing/";
    $targetDir = "photo/";
    $targetFile = $targetDir . str_replace(' ', '-', trim(addslashes($_FILES["photo"]["name"])));

    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $check = $_FILES["photo"]["tmp_name"];

    if($check !== false){
        $photo = $baseUrl . $targetFile;
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
    } else {
        $photo = "";
    }

    $sql = "INSERT INTO pembimbing (name, photo, email, password) VALUES ('".$name."', '".$photo."', '".$email."', '".$password."')";
    $query = $db->query($sql);

    if($query){
        $res = [
            "status" => "oke",
            "msg" => "succesfully added",
            "result" => $db->insert_id
        ];
    } else {
        $res = [
            'status' => 'tidak oke',
            'msg' => 'failed to add',
            'result' => $db->error,
        ];
    }

    echo json_encode($res);
?>

// $query = mysqli_query($conn, $sql);
// if($query){
//     $msg = "pembimbing completly saved";
// } else{
//     $msg = "pembimbing failed to save";
// }

// $response = array(
//     'status' => 'mantap',
//     'msg' => $msg
// );

// echo json_encode($response);