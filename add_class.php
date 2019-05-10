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
        function doAdd(class_code, id) {
            if (confirm("Are you sure you want to add it?")) {
                window.location = 'action.php?action=add&class_code=' + class_code + '&id=' + id;
            }
        }
    </script>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Student Page.</h1>
    </div>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <center>
    <?php
    include_once "menu.php";
    ?>
    <h3>Class Information</h3>
    <table width="500" border="1">
        <tr>
            <th>Student ID</th>
            <th>Class Code</th>
            <th>Major Code</th>
            <th>Class Tilte</th>
            <th>Credit</th>
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
        //implement sql and get the data

        $sql = "SELECT student.id, classes.class_code, classes.maj_code, classes.class_name, classes.credit From student, classes WHERE student.id =" . $_GET['id'];
        foreach ($pdo->query($sql) as $row) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['class_code']}</td>";
            echo "<td>{$row['maj_code']}</td>";
            echo "<td>{$row['class_name']}</td>";
            echo "<td>{$row['credit']}</td>";      
            echo "<td>
                   <a href='javascript:doAdd({$row['class_code']},{$row['id']})'>Add</a>
                  </td>";
          
            echo "</tr>";
        }

        ?>

    </table>
</center>
</body>
</html>