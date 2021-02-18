<?php
$connect = new PDO("mysql:host=localhost;dbname=bamr", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT NameRoom_ID, NameRoom, Disableval FROM nameroom ORDER BY NameRoom_ID ASC
 ";
    //   ORDER BY User_id DESC
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'fetchSingle') {
    $query = "
 SELECT NameRoom_ID, NameRoom, Disableval FROM nameroom  WHERE NameRoom_ID = '" . $received_data->NameRoom_ID . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data['NameRoom_ID'] = $row['NameRoom_ID'];
        $data['NameRoom'] = $row['NameRoom'];
    }

    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $data = array(
        ':NameRoom' => $received_data->NameRoom
    );

    $query = "
 INSERT INTO NameRoom 
 (
 NameRoom,Disableval) 
 VALUES (
 :NameRoom,
 '')
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Inserted'
    );

    echo json_encode($output);
}
if ($received_data->action == 'update') {
    $data = array(
        ':NameRoom_ID' => $received_data->NameRoom_ID,
        ':NameRoom' => $received_data->NameRoom,
    );

    $query = "
    UPDATE nameroom 
    SET NameRoom_ID = :NameRoom_ID,
    NameRoom = :NameRoom
    WHERE NameRoom_ID = :NameRoom_ID
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}
if ($received_data->action == 'delete') {
    $query = "
 DELETE FROM nameroom 
 WHERE NameRoom_ID = '" . $received_data->NameRoom_ID . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Data Deleted'
    );

    echo json_encode($output);
}