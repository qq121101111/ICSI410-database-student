<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Page</title>
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
    <script>
        function doDel(num) {
            if (confirm("Are you sure you want to drop it?")) {
                window.location = 'action.php?action=del&num=' + num;
            }
        }
    </script>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Student Page.</h1>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <center>
    <?php
    include_once "menu.php";
    ?>
    <h3>Student Information</h3>
    <table width="500" border="1">
        <tr>
            <th>Class Number</th>
            <th>Student ID</th>
            <th>Class Tilte</th>
            <th>Class Code</th>
            <th>Grade</th>
            <th>Option</th>          
        </tr>
        <?php
        //connect to database
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=university_student_database;", "root", "root");
        } catch (PDOException $e) {
            die("Connect failed" . $e->getMessage());
        }
        
        $pdo->query("SET NAMES 'UTF8'");
        //implement sql and get the value
        $sql = "SELECT stu_classes.num, stu_classes.id, classes.class_name, classes.class_code, stu_classes.grade FROM classes, stu_classes WHERE stu_classes.class_code = classes.class_code and stu_classes.id =" . $_GET['id'];
        foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>{$row['num']}</td>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['class_name']}</td>";
            echo "<td>{$row['class_code']}</td>";
            echo "<td>{$row['grade']}</td>";
            echo "<td>
                   <a href='javascript:doDel({$row['num']})'>Drop</a>
                   <a href='add_class.php?id=({$row['id']})'>Add</a>
                  </td>";
          
            echo "</tr>";
        }

        ?>

    </table>
</center>
</body>
</html>