<?php
// start a session
// header("refresh: 10;");
session_start();
if (isset($_COOKIE["user"]) == "admin") {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <style>
        .image-student {
            width: 100px;
            height: 100px;
        }

        .function {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Birthday</th>
                                <th scope="col">Address</th>
                                <th scope="col">Image</th>
                                <th scope="col" colspan="2" class="text-center">Function</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $_SESSION["student"] = [];
                            if ($_SESSION == null) {
                                echo "<tr>" . "<td>" . "No data" . "</td>" . "</tr>";
                            } else {
                                // echo count($_SESSION['student']);
                                // echo '<br>';
                                foreach ($_SESSION['student'] as $key => $value) {
                                    // var_dump($key);
                                    echo '<tr>';
                                    echo '<th scope="row">' . $key . '</th>';
                                    echo '<td>' . $value['name'] . '</td>';
                                    echo '<td>' . $value['birthday'] . '</td>';
                                    echo '<td>' . $value['address'] . '</td>';
                                    echo '<td>' . '<img class="image-student" src="' . $value['image'] . '" alt="none">' . '</td>';
                                    echo '<td>' . '<a class="btn btn-warning function" href="http://localhost/LearnPHP/day3/editStudent.php?id=' . $key . '">Edit</a>' . '</td>';
                                    echo '<td>' . '<a class="btn btn-danger function" href="http://localhost/LearnPHP/day3/delete.php?id=' . $key . '">Delete</a>' . '</td>';
                                    echo '</tr> ';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <a class="btn btn-primary" href="http://localhost/LearnPHP/day3/addStudent.php">Form add student</a>
                    <a class="btn btn-info" href="http://localhost/LearnPHP/day3/login.php">Log Out</a>

                </div>

            </div>
        </div>
    <?php
    if (empty($_SESSION)) {
        $_SESSION['student'] = [];
        echo "<br>";
        echo "No data";
    } else {
        echo ' <pre>';
        print_r($_SESSION);
        echo '</pre>';
    }
} else {
    header("location: http://localhost/LearnPHP/day3/login.php");
}
    ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>

    </html>