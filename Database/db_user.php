<?php
$connect = new PDO("mysql:host=localhost;dbname=bamr", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT * FROM user  WHERE User_ID = '" . $received_data->User_ID . "'";
    //   ORDER BY User_id DESC
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
// if ($received_data->action == 'insert') {
//     $data = array(
//         ':MeetingRoom_ID' => $received_data->MeetingRoom_ID,
//         ':User_ID' => $received_data->User_ID,
//         ':NameRoom' => $received_data->NameRoom,
//         ':Numbar_User' => $received_data->Numbar_User,
//         ':Start_day' => $received_data->Start_day,
//         ':Start_time' => $received_data->Start_time,
//         ':End_day' => $received_data->End_day,
//         ':End_time' => $received_data->End_time,
//         ':Description' => $received_data->Description,
//         ':WhoCreate' => $received_data->WhoCreate,
//         ':WhoEdit' => $received_data->WhoEdit,
//         ':Whotime_Create' => $received_data->Whotime_Create,
//         ':Whotime_Edit' => $received_data->Whotime_Edit

//     );

//     $query = "
//  INSERT INTO meetingroom 
//  (MeetingRoom_ID,
//  User_ID,
//  NameRoom,
//  Numbar_User,
//  Start_day,
//  Start_time,
//  End_day,
//  End_time,
//  Description,
//  WhoCreate,
//  WhoEdit,
//  Whotime_Create,
//  Whotime_Edit) 
//  VALUES (
//  :MeetingRoom_ID,
//  :User_ID,:NameRoom,
//  :Numbar_User,
//  :Start_day,
//  :Start_time,
//  :End_day,
//  :End_time,
//  :Description,
//  :WhoCreate,
//  :WhoEdit,
//  :Whotime_Create,
//  :Whotime_Edit)
//  ";

//     $statement = $connect->prepare($query);

//     $statement->execute($data);

//     $output = array(
//         'message' => 'Data Inserted'
//     );

//     echo json_encode($output);
// }
// if ($received_data->action == 'fetchSingle') {
//     $query = "
//  SELECT NameRoom, Start_day, Start_time, End_day, End_time, Description FROM meetingroom
//  WHERE User_id = '" . $received_data->User_ID . "' and MeetingRoom_ID = '" . $received_data->MeetingRoom_ID . "'
//  ";

//     $statement = $connect->prepare($query);

//     $statement->execute();

//     $result = $statement->fetchAll();

//     foreach ($result as $row) {
//         $data['NameRoom'] = $row['NameRoom'];
//         $data['Start_day'] = $row['Start_day'];
//         $data['Start_time'] = $row['Start_time'];
//         $data['End_day'] = $row['End_day'];
//         $data['End_time'] = $row['End_time'];
//         $data['Description'] = $row['Description'];
//     }

//     echo json_encode($data);
// }
if ($received_data->action == 'update') {
    $data = array(
        ':Emails' => $received_data->emails,
        ':Phones' => $received_data->phones,
        ':User_ID' => $received_data->user_id
    );

    $query = "
    UPDATE user 
    SET Email = :Emails,
    Phone = :Phones
    WHERE User_id = :User_ID
    ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Data Updated'
    );

    echo json_encode($output);
}

// if ($received_data->action == 'delete') {
//     $query = "
//  DELETE FROM meetingroom 
//  WHERE MeetingRoom_ID = '" . $received_data->MeetingRoom_ID . "'
//  ";

//     $statement = $connect->prepare($query);

//     $statement->execute();

//     $output = array(
//         'message' => 'Data Deleted'
//     );

//     echo json_encode($output);
// }
