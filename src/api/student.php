<?php
//beacuse db and vue in same local
header('Access-Control-Allow-Origin:*');
 $resualt=array("error"=>false);
 $resualt["errormessage"]="";

//connect DB
//variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname="dbvue";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    $resualt["state"]=false;
    $resualt["msg"]="failed";
  die("Connection failed: " . mysqli_connect_error());

}else{
    $resualt["state"]=true;
    $resualt["msg"]="Success";

}


//get action from url ?action=value
$action ="";
if(isset($_GET['action'])){
    $action=$_GET['action'];
}

//----------------------------------------------------read
if($action=="read"){
    
$sql = "SELECT * FROM students";
$sql2 ="SELECT * FROM admin" ;
$sql3 ="SELECT * FROM superadmin" ;

$res  = $conn->query($sql);
$res2 = $conn->query($sql2);
$res3 = $conn->query($sql3);

$sta=array();
$ada=array();
$suada=array();

//Number Of Rows
$result_row=mysqli_query($conn,$sql);
$rowcount=mysqli_num_rows($result_row);
if($rowcount < 1){
  $resualt["error"]=true;
  $resualt["errormessage"]="Not Rows";
}
//Loop and fetch data student in $sta array
if ($res->num_rows > 0) {
  while($row = $res->fetch_assoc()) {
       array_push($sta,$row);
  }
  $resualt["students"]=$sta;
}
//Loop and fetch data admin in $ada array
if ($res2->num_rows > 0) {
  while($row = $res2->fetch_assoc()) {
       array_push($ada,$row);
  }
  $resualt["admins"]=$ada;
}

//Loop and fetch data superadmin in $suada array
if ($res3->num_rows > 0) {
  while($row = $res3->fetch_assoc()) {
       array_push($suada,$row);
  }
  $resualt["superadmin"]=$suada;
}
}
//--------------------------------Create Student
if($action=="create"){
    $name=$_POST["name"];
    $major=$_POST["major"];
    $semester=$_POST["semester"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $sql4 ="insert into students (name, major, semester,phone,email)
    values ('$name', '$major', '$semester','$phone','$email')";
    mysqli_query($conn, $sql4);

}

//--------------------------------Create Admin
if($action=="createadmin"){
 
  $email=$_POST["email"];
  $password=$_POST["password"];
  $phone=$_POST["phone"];
  $name=$_POST["name"];
  $sql5 ="insert into admin (email, password,phone,name)
  values ('$email', '$password','$phone','$name')";
  mysqli_query($conn, $sql5);

}
//------------------------------------------UpdateStudent
if($action=="update"){
    $universityId=$_POST["universityId"];
    $name=$_POST["name"];
    $major=$_POST["major"];
    $semester=$_POST["semester"];
    $phone=$_POST["phone"];
    $email=$_POST["email"];
    $sql3 ="update students 
              set name = '$name', major = '$major', semester = '$semester',
               phone = '$phone', email = '$email' 
              where universityId = $universityId";
    mysqli_query($conn, $sql3);

}


//------------------------------------------UpdateAdmin
if($action=="updateadmin"){
 
  $id=$_POST["id"];
  $email=$_POST["email"];
  $password=$_POST["password"]; 
  $phone=$_POST["phone"];
  $name=$_POST["name"];
  $sql6 ="update admin 
            set email = '$email', password = '$password, phone = '$phone', name = '$name'            
            where id = $id";
  mysqli_query($conn, $sql6);

}
//---------------------------------delete student
if($action=="delete"){
  $id=$_POST["universityId"];
  $sql = "DELETE FROM students where universityId=$id";
  mysqli_query($conn, $sql);
}
if($action=="deleteAll"){
  $sql = "DELETE FROM students";
  mysqli_query($conn, $sql);


}


//---------------------------------delete admin
if($action=="deleteadmin"){
  $id=$_POST["id"];
  $sql = "DELETE FROM admin where id=$id";
  mysqli_query($conn, $sql);
}
 echo json_encode($resualt);
 mysqli_close($conn);

?>
