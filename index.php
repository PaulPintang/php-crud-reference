<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <?php include('process.php');
    // FETCH THE DATA TO BE UPDATED
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];

            $update = true;
            $rec = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
            $record = mysqli_fetch_array($rec);
            $name = $record['name'];
            $id = $record['id'];
        }
    ?>
    <div class="w-96 mx-auto">
        <form action="process.php" method="POST">
            <div class="flex flex-col justify-center items-center p-4  space-y-5">
                <h1 class="text-4xl">PHP CRUD PRACTICE</h1>
                 <?php if(isset($_SESSION['message'])):?>
                    <div class="text-<?=$_SESSION['msg_type']?>">
                        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                        ?>
                    </div>
                <?php endif ?>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input 
                    type="text" 
                    class="p-2 border-4 border-gray-200 focus:border-green-200 outline-none rounded-md"
                    name="name"
                    value="<?php echo $name; ?>"
                    placeholder="type something here..." />
                
                <div>
                    <?php if ($update == false): ?>
                    <button class="bg-green-500 text-white p-2 rounded-md pl-4 pr-3" type="submit" name="save">ADD</button>
                    <?php else: ?>
                    <button class="bg-green-500 text-white p-2 rounded-md pl-4 pr-3" type="submit" name="update">UPDATE</button>
                    <?php endif; ?>
                </div>
               
            </div>
        </form>
        <div>
            <div>
                 data from the database
            </div>
            <table>
                <thead>
                    <tr>    
                        <th>NAME</th>
                    </tr>
                </thead>
                <!-- loop the data -->
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>"
                                class="bg-green-500 rounded">Edit</a>
                        </td>
                        <td>
                            <a href="process.php?del=<?php echo $row['id']; ?>"
                                class="bg-red-500 rounded">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>