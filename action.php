<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

//connect to database
try{
    $pdo = new PDO("mysql:host=localhost;dbname=university_student_database;","root","root");
}catch(PDOException $e){
    die("Connect failed".$e->getMessage());
}

//switch deferent operations

switch($_GET['action']){
    case "add"://add operation
        $class_code = $_GET['class_code'];
        $id = $_GET['id'];
        $sql = "insert into stu_classes values(NULL, '{$id}', '{$class_code}', '')";
        $rw = $pdo->exec($sql);
        if($rw > 0){
            echo "<script>alert('added');window.location='info.php'</script>";
        }else{
            echo "<script>alert('failed');window.history.back();</script>";
        }
        break;

    case "del"; //delete operation
        $num = $_GET['num'];
        $sql = "delete from stu_classes where num={$num}";
        //$sql = "delete from stu_classes where class_code={$code} and id={$id} ";
        $pdo->exec($sql);
        header("Location:info.php");
        break;


    case "edit_password":

        //edit password operation
        $id = $_POST['id'];
        $stu_paw = $_POST['stu_paw'];

        $sql = "update student set stu_paw='{$stu_paw}' where id={$id}";
        $rw = $pdo->exec($sql);
        if($rw>0){
            echo "<script>alert('update');window.location='info.php'</script>";
        }else{
           echo "<script>alert('nothing changed');window.history.back();</script>";
        }
        break;
}
?>