<?php
 class userController
  {
    // DB stuff
    private $conn;
    private $table='user2';

    //user-info atrribute
    public  $id;
    public  $Fname;
    public  $Lname;
    public  $email;
    public  $password;
    public  $confirmPass;

    // constructer with db

    public function __construct($db){
      $this->conn=$db;
    }

    // get all users
    public function GetAllUser()
    {
      //create query
      $query='SELECT * FROM ' .$this->table;
      //prepare statment
      $stmt = $this->conn->prepare($query);
      //excute query
      $stmt->execute();

      return $stmt;
    }

    //get 1 user
    public function getUser()
    {
      //create query
      $query='SELECT * FROM ' .$this->table.' WHERE id=?';
      // prepare statment
      $stmt = $this->conn->prepare($query);
      //bind the id
      $stmt->bindParam(1, $this->id);
      //excute query
      $stmt->execute();

      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      //set properties
      $this->Fname=$row['Fname'];
      $this->Lname=$row['Lname'];
      $this->email=$row['email'];
      $this->password=$row['password'];
      $this->confirmPass=$row['confirmPass'];
    }
    //add user
    public function AddUser()
    {
      //create query
      $query='INSERT INTO '.$this->table.'
      SET
        Fname = :Fname,
        Lname = :Lname,
        email = :email,
        password = :password,
        confirmPass = :confirmPass
      ';

      //prepare statemnt
      $stmt = $this->conn->prepare($query);
      //clear data
      $this->Fname = htmlspecialchars(strip_tags($this->Fname));
      $this->Lname = htmlspecialchars(strip_tags($this->Lname));
      $this->email = htmlspecialchars(strip_tags($this->email));
      $this->password = htmlspecialchars(strip_tags($this->password));
      $this->confirmPass = htmlspecialchars(strip_tags($this->confirmPass));

      //bind data
      $stmt->bindParam(':Fname',$this->Fname);
      $stmt->bindParam(':Lname',$this->Lname);
      $stmt->bindParam(':email',$this->email);
      $stmt->bindParam(':password',$this->password);
      $stmt->bindParam(':confirmPass',$this->confirmPass);
      //execute query
      if($stmt->execute())
        {
          return true;
        }
          printf("ERROR: %s.\n",$stmt->error);
          return false;

      }

      //update user
      public function UpdateUser()
      {
        //create query
        $query='UPDATE '.$this->table.'
        SET
          Fname = :Fname,
          Lname = :Lname,
          email = :email,
          password = :password,
          confirmPass = :confirmPass
          WHERE
           id = :id
        ';

        //prepare statemnt
        $stmt = $this->conn->prepare($query);
        //clear data
        $this->Fname = htmlspecialchars(strip_tags($this->Fname));
        $this->Lname = htmlspecialchars(strip_tags($this->Lname));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->confirmPass = htmlspecialchars(strip_tags($this->confirmPass));
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind data
        $stmt->bindParam(':Fname',$this->Fname);
        $stmt->bindParam(':Lname',$this->Lname);
        $stmt->bindParam(':email',$this->email);
        $stmt->bindParam(':password',$this->password);
        $stmt->bindParam(':confirmPass',$this->confirmPass);
        $stmt->bindParam(':id',$this->id);
        //execute query
        if($stmt->execute())
          {
            return true;
          }
            printf("ERROR: %s.\n",$stmt->error);
            return false;

        }
        //DeleteUser
        public function DeletUser()
        {
          //create query
          $query = 'DELETE FROM '.$this->table.' WHERE id = :id';

          //prepare statemnt
          $stmt = $this->conn->prepare($query);
          // clean id
          $this->id = htmlspecialchars(strip_tags($this->id));
          //bind id
          $stmt->bindParam(':id',$this->id);
          //execute
          if($stmt->execute())
            {
              return true;
            }
              printf("ERROR: %s.\n",$stmt->error);
              return false;


        }
  }
