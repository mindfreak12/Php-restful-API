<?php
//get one user by id with get method in api
// headers
header('Acess-Control-Allow-Orgin: *');
header('Content-Type: application/json');

include_once'../config/Database.php';
include_once'../models/userController.php';

// intial db & connect
$database = new Database();
$db= $database->connect();

// intial getallfunction
$user= new userController($db);

// get id from url
$user->id=isset($_GET['id']) ? $_GET['id'] : die();

//get user
$user->getUser();

//create array
$user_arr=array(
  'id'=>$user->id,
  'Fname'=>$user->Fname,
  'Lname'=>$user->Lname,
  'email'=>$user->email,
  'password'=>$user->password,
  'confirmPass'=>$user->confirmPass
);
//convert to json
print_r(json_encode($user_arr));
