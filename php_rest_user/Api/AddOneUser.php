<?php
//add a user in data base
// headers
header('Acess-Control-Allow-Orgin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POSt');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With ');

include_once'../config/Database.php';
include_once'../models/userController.php';

// intial db & connect
$database = new Database();
$db= $database->connect();

// intial getallfunction
$user= new userController($db);

//get the data created or added
$data = json_decode(file_get_contents("php://input"));

$user->Fname = $data->Fname;
$user->Lname = $data->Lname;
$user->email = $data->email;
$user->password = $data->password;
$user->confirmPass = $data->confirmPass;
// Create user
 if($user->AddUser())
 {
   echo json_encode(
     array('message' => 'user added')
   );
 }
 else
 {
   echo json_encode(
     array('message' => 'no user added')
   );
 }
