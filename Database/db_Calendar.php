<?php
$connect = new PDO("mysql:host=localhost;dbname=bamr", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if($received_data->action == 'fetchall')
{
 $query = "
 SELECT MeetingRoom_ID, NameRoom, Sday, Stime, Etime, Description FROM nameroom,meetingroom  WHERE meetingroom.NameRoom_ID = nameroom.NameRoom_ID and User_ID = '" . $received_data->User_ID . "' ORDER BY MeetingRoom_ID ASC
 ";
//   ORDER BY User_id DESC
 $statement = $connect->prepare($query);
 $statement->execute();
 while($row = $statement->fetch(PDO::FETCH_ASSOC))
 {
  $data[] = $row;
 }
 echo json_encode($data);
}
if ($received_data->action == 'fetchalls_data') {
  $query = "
 SELECT MeetingRoom_ID, NameRoom, Sday, Stime, Etime, Description FROM nameroom,meetingroom  WHERE meetingroom.NameRoom_ID = nameroom.NameRoom_ID ORDER BY MeetingRoom_ID ASC
 ";
  //   ORDER BY User_id DESC
  $statement = $connect->prepare($query);
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  echo json_encode($data);
}
if($received_data->action == 'insert')
{
 $data = array(
    ':MeetingRoom_ID' => $received_data->MeetingRoom_ID,
    ':User_ID' => $received_data->User_ID,
    ':NameRoom_ID' => $received_data->NameRoom_ID,
    ':Numbar_User' => $received_data->Numbar_User,
    ':Start_day' => $received_data->Start_day,
    ':Start_time' => $received_data->Start_time,
    ':End_time' => $received_data->End_time,
    ':Description' => $received_data->Description
 );

 $query = "
 INSERT INTO meetingroom 
 (MeetingRoom_ID,
 User_ID,
 NameRoom_ID,
 Numbar_User,
 Sday,
 Stime,
 Etime,
 Description) 
 VALUES (
 :MeetingRoom_ID,
 :User_ID,
 :NameRoom_ID,
 :Numbar_User,
 :Start_day,
 :Start_time,
 :End_time,
 :Description)
 ";

 $statement = $connect->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Inserted'
 );

 echo json_encode($output);
}
if($received_data->action == 'fetchSingle')
{
 $query = "
 SELECT meetingroom.NameRoom_ID, Sday, Stime, Etime, Description FROM nameroom,meetingroom  WHERE meetingroom.NameRoom_ID = nameroom.NameRoom_ID and User_id = '".$received_data->User_ID. "' and MeetingRoom_ID = '".$received_data->MeetingRoom_ID."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $result = $statement->fetchAll();

 foreach($result as $row)
 {
  $data['NameRoom_ID'] = $row['NameRoom_ID'];
  $data['Sday'] = $row['Sday'];
  $data['Stime'] = $row['Stime'];
  $data['Etime'] = $row['Etime'];
  $data['Description'] = $row['Description'];

 }

 echo json_encode($data);
}
if($received_data->action == 'update')
{
 $data = array(
   ':NameRoom_ID' => $received_data->NameRoom_ID,
   ':Start_day' => $received_data->Start_day,
   ':Start_time' => $received_data->Start_time,
   ':End_time' => $received_data->End_time,
   ':Description' => $received_data->Description,
   ':MeetingRoom_ID' => $received_data->MeetingRoom_ID
 );

 $query = "
 UPDATE meetingroom 
 SET NameRoom_ID = :NameRoom_ID,
 Sday = :Start_day,
 Stime = :Start_time,
 Etime = :End_time,
 Description = :Description
 WHERE MeetingRoom_ID = :MeetingRoom_ID
 ";

 $statement = $connect->prepare($query);

 $statement->execute($data);

 $output = array(
  'message' => 'Data Updated'
 );

 echo json_encode($output);
}

if($received_data->action == 'delete')
{
 $query = "
 DELETE FROM meetingroom 
 WHERE MeetingRoom_ID = '".$received_data->MeetingRoom_ID."'
 ";

 $statement = $connect->prepare($query);

 $statement->execute();

 $output = array(
  'message' => 'Data Deleted'
 );

 echo json_encode($output);
}
if ($received_data->action == 'fetchCheckcal') {
  $query = "
 SELECT count(*) FROM `meetingroom` WHERE (
	'" . $received_data->Start_time . "' BETWEEN Stime AND Etime
    OR '" . $received_data->End_time . "' BETWEEN Stime AND Etime
    OR Stime BETWEEN '" . $received_data->Start_time . "' AND '" . $received_data->End_time . "'
) AND NameRoom_ID = '" . $received_data->NameRoom_ID . "' AND Sday = '" . $received_data->Start_day . "'
 ";
  $statement = $connect->prepare($query);

  $statement->execute();

  $result = $statement->fetchAll();

  foreach ($result as $row) {
    $data['numrock'] = $row['count(*)'];
  }
  echo json_encode($data);
}
if ($received_data->action == 'fetchcalendar') {
  $query = "
SELECT CONCAT('ห้อง :',NameRoom,' ติดต่อ :',Phone,' ',Email,' คำอธิบาย :',Description) AS name,CONCAT(Sday,' ',Stime) AS start,CONCAT(Sday,' ',Etime) AS end FROM nameroom,meetingroom,user WHERE meetingroom.NameRoom_ID = nameroom.NameRoom_ID and meetingroom.User_id = user.User_id and meetingroom.NameRoom_ID = '".$received_data->NameRoom_ID."'
 ";
  //   ORDER BY User_id DESC
  $statement = $connect->prepare($query);
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  echo json_encode($data);
}
if ($received_data->action == 'fetchcalendar_all') {
  $query = "
SELECT CONCAT('ห้อง : ',NameRoom,' ติดต่อ :',Phone,' ',Email,' คำอธิบาย :',Description) AS name,CONCAT(Sday,' ',Stime) AS start,CONCAT(Sday,' ',Etime) AS end FROM nameroom,meetingroom,user WHERE meetingroom.NameRoom_ID = nameroom.NameRoom_ID and meetingroom.User_id = user.User_id
 ";
  //   ORDER BY User_id DESC
  $statement = $connect->prepare($query);
  $statement->execute();
  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
  }
  echo json_encode($data);
}