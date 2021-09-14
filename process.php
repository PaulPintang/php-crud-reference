<?php
    // session for alert message
    session_start();

    // initialize variable
    $name = "";
    $id = 0;
    $update = false;

    // connection
    $db = mysqli_connect('localhost', 'root', 'paulpin', 'crud');

    // insert to database
    if(isset($_POST['save'])){
        $name = $_POST['name'];

        $query = "INSERT INTO info (name) VALUES ('$name')";
        mysqli_query($db, $query);

        $_SESSION['message'] = "new record has been saved";
        $_SESSION['msg_type'] = "green-500";

        header("location: index.php");
    }

    // code for retrieve from database
    $results = mysqli_query($db, "SELECT * FROM info ");


    // update 
    if (isset($_POST['update'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];

            mysqli_query($db, "UPDATE info SET name='$name' WHERE id=$id");
            $_SESSION['message'] = "record updated";
            $_SESSION['msg_type'] = "green-500";
           
            header('location: index.php');
        }
    
    // delete
    if (isset($_GET['del'])) {
            $id = $_GET['del'];
            mysqli_query($db, "DELETE FROM info WHERE id=$id");
            $_SESSION['message'] = "Address deleted!"; 
            header('location: index.php');
        }
?>
