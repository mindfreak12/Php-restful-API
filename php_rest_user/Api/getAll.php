<?php
  //get all users with get method in api
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

  // getall query
  $result = $user->GetAllUser();
  // Get row count
  $num = $result->rowCount();

  //check if there any post
  if($num > 0)
    {//post array
      $user_arr = array();
      $user_arr['data'] = array();

      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
         extract($row);

         $user_item = array(
           'id' => $id,
           'Fname'=>$Fname,
           'Lname'=>$Lname,
           'email'=>$email,
           'password'=>$password,
           'confirmPass'=>$confirmPass
         );
        //pust to "data"
        array_push($user_arr['data'],$user_item);
      }
      // turn it to jason
      echo json_encode($user_arr)."\n";
    }
    else {
      echo json_encode(
        array('message'=>'No user found')
      );
    }
