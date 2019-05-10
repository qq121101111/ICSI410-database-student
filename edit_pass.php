<html>
<head>
    <meta charset="UTF-8">
    <title>Student Infomations System</title>

</head>
<body>
<center>
    <?php
    include_once "menu.php";
    //conenet to database
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=university_student_database;", "root", "root");
    } catch (PDOException $e) {
        die("connect failed" . $e->getMessage());
    }
    
    $pdo->query("SET NAMES 'UTF8'");
    //implement sql and get value
    $sql = "SELECT * FROM student WHERE id =" . $_GET['id'];
    $stmt = $pdo->query($sql);//return the data
    if ($stmt->rowCount() > 0) {
        $stu = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("Faild");
    }
    ?>
    <form method="post" action="action.php?action=edit_password">

        <input type="hidden" name="id" id="id" value="<?php echo $stu['num']; ?>"/>
        <table>
            <tr>
                <td>ID</td>
                <td><input id="id" name="id" type="text" value="<?php echo $stu['id'] ?>"/></td>

            </tr>
            <tr>
                <td>Pass Word</td>
                <td><input id="stu_paw" name="stu_paw" type="text" value="<?php echo $stu['stu_paw'] ?>"/></td>

            </tr>
            
            <tr>
                <td> </td>
                <td><input type="submit" value="Submit"/>  
                    <input type="reset" value="Reset"/>
                </td>
            </tr>
        </table>

    </form>


</center>
</body>
</html>