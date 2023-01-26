<?php
include "./db.php";

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header('Access-Control-Allow-Origin:*');
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Max-Age:1000');
}
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
    }

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
        header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding,
        X-CSRF-Token, Authorization");
    }
    exit(0);
}
$res = array('error' => false);
$action='';

if (isset($_GET['action'])) {
    $action=$_GET['action'];
}
if ($action=="login") {
    $username=$_POST['username'];
    $password=$_POST['username'];

    $sql="Select * from admin where username='$username' AND password='$password'";
    $result=$conn->query($sql);
    $num=mysqli_num_rows($result);
    if ($num > 0) {
        $res['message']="Login Berhasil";
    }
    else {
        $res['error']=true;
        $res['message']="Username atau Password Salah";
    }
}
if($action=='addusers'){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$education=$_POST['education'];
	$gender=$_POST['gender'];
	 
	$sql="INSERT INTO `usersdata`(`id`, `name`, `email`, `education`, `gender`) VALUES(NULL,'$name','$email','$education','$gender')";
	$result=$conn->query($sql);
	if($result===true){
		$res['error']=false;
        $res['message']="User Berhasil Ditambahkan";
	}else{
		$res['error']=true;
        $res['message']="Gagal Menambahkan User";
	}

}
if($action=='getuserinfo'){
	$sql="SELECT * FROM `usersdata`";
	$result=$conn->query($sql);
	$num=mysqli_num_rows($result);
	$userData=array();
	if($num >0){
		while($row=$result->fetch_assoc()){
			array_push($userData,$row);
		}
		$res['error']=false;
        $res['user_Data']=$userData;

	}else{
		$res['error']=false;
        $res['message']="Data tidak ditemukan";
	}
	
}
$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();
?>  