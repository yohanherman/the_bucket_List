<?php
function loadClasses($classe)
{
    require "classes/$classe.class.php";
}

spl_autoload_register('loadClasses');

$manager = new Manager;




if (isset($_POST["delete"])) {

    $id = $_POST['id'];

    $manager->deleteTask($id);

    header("location:index.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b713960f0d.js" crossorigin="anonymous"></script>
    <title>deletionTask</title>
</head>

<body>

    <form action="confirmationDeletion.php" method="POST" class="border border-danger text-center p-3 m-3" >
        <h1 class="text-danger">THE DELETION IS NOT REVERSIBLE</h1>
        <p class="fw-bold"> TASK: <?php echo $_POST['taskName'] ?></p>
        <input type="hidden" name="id" value="<?= $_POST['id'] ?>">


        <button type="submit" name='delete' class="border-0 rounded bg-danger text-white">YES</button>
        <button class="border-0 rounded bg-primary"><a class="text-white" href="index.php">NO</a></button>
        <div></div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>