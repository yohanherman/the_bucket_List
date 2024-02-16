<?php

function loadClasses($classe)
{
    require "classes/$classe.class.php";
}

spl_autoload_register('loadClasses');

// instanciation de ma database
$connexion = new Database;

// instanciatioin de ma classe
$manager = new Manager;

// ajout de ma tache au click sur le bouton

if (isset($_POST["addTask"])) {

    $_task = $_POST["task"];

    $manager->addTask($_task);
}


if (isset($_POST['changeStatus0'])) {

    $id = $_POST['id'];

    $manager->changeStatusto1($id);
}


if (isset($_POST['changeStatus1'])) {

    $id = $_POST['id'];
    $manager->changeStatusto0($id);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b713960f0d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="bg-info p-3">
        <h3 class="text-white text-center">THE BUCKET LIST</h3>
    </div>

    <div class="shadow p-3 mb-5 bg-body rounded m-3">

        <form action="index.php" method="POST">
            <div>
                <input class=" form-control border border-0 border-bottom border-dark text-center" type='text' name='task' placeholder="What would you like to do ?">
            </div>
            <div class="d-flex justify-content-center">

                <button class="border border-0 btn btn-block bg-success m-3 w-50 rounded text-white" type='submit' name="addTask">Add</button>
            </div>
        </form>

        <div><?php if (empty($_task)) { ?>

                <!-- <div class="text-danger text-center"> <php echo "The field is required" ?></div> -->

            <?php } ?>

        </div>
    </div>

    <div class="shadow p-3 mb-5 bg-body rounded m-3">

        <h3>Todo List</h3>


        <table class="">
            <thead>
                <tr>
                    <th>#</th>
                    <th>List</th>
                    <th>Status</th>
                    <th>Close</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $allTask = $manager->displayTask();

                if (!empty($allTask)) {

                    foreach ($allTask as $task) { ?>

                        <tr>

                            <td class=""><?= $counter++ ?></td>

                            <td class=""><?= htmlspecialchars($task->getTask()) ?></td>

                            <td class=""><?php if ($task->getStatus() == 0) { ?>

                                    <div class="bg-warning rounded p-2">
                                        <span class="text-white">Pending</span>
                                    </div>

                                <?php


                                            } else {

                                ?>
                                    <div class="bg-success rounded p-2">
                                        <span>Completed</span>
                                    </div>

                                <?php

                                            } ?>
                            </td>

                            <td class="col-md-3"><?php if ($task->getStatus() == 0) { ?>

                                    <form action="index.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $task->getId() ?>">
                                        <input type="hidden" name="status" value="<?= $task->getStatus() ?>">
                                        <button class="border border-0 bg-white" type="submit" name="changeStatus0"><i class="fa-solid fa-lock-open"></i></button>

                                    </form>
                            </td>

                        <?php  } elseif ($task->getStatus() == 1) { ?>

                            <form action="index.php" method="POST">
                                <input type="hidden" name="id" value="<?= $task->getId() ?>">
                                <input type="hidden" name="status" value="<?= $task->getStatus() ?>">
                                <button class="border border-0 bg-white" type="submit" name="changeStatus1"><i class="fa-solid fa-lock"></i></button>
                            </form>

                        <?php  } ?>

                        </tr>

                <?php
                    }
                }

                ?>
                <!-- <td>
                    <form action="" method="POST">
                        <input type="text" name="id">
                    </form>
                </td> -->



            </tbody>
        </table>


    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>