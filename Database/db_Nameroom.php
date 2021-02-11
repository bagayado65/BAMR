<?php
$connect = new PDO("mysql:host=localhost;dbname=bamr", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT NameRoom_ID, NameRoom FROM nameroom ORDER BY NameRoom_ID ASC
 ";
    //   ORDER BY User_id DESC
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
