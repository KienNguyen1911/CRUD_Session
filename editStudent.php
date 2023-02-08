<?php
// start a session
// header("refresh: 10;");
session_start();
$value_name = $value_birthday = $value_address = $value_image = "";
$id = $_GET["id"];
$value_name = $_SESSION["student"][$id]["name"];
$value_birthday = $_SESSION["student"][$id]["birthday"];
$value_address = $_SESSION["student"][$id]["address"];
$value_image = $_SESSION["student"][$id]["image"];

$nameErr = $birthdayErr = $addressErr = $imageErr = "";
$name = $birthday = $address = $image = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = validate_input($_POST["name"]);
    $birthday = validate_input($_POST["birthday"]);
    $address = validate_input($_POST["address"]);
    $image = $_FILES["image"]["tmp_name"];
    $target_dir = "picture/" . $_FILES["image"]["name"];
    move_uploaded_file($image, $target_dir);

    $student = [
        "name" => $name,
        "birthday" => $birthday,
        "address" => $address,
        "image" => $target_dir,
    ];
    $_SESSION["student"][$id] = $student;
    // session_unset();
    // var_dump($_SESSION['student']);
    // echo "<pre>";
    // print_r($_SESSION);
    // echo "</pre>";
    header('location: listStudent.php');
}

function validate_input($data)
{
    if (empty($data)) {
        $dataErr = "Không được để trống";
        echo $dataErr;
    } else {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
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

<body>
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-8">
                <h1>Form Add new Student</h1>
                <form class="row g-3" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" name="name" value="<?php echo $value_name ?>" required>
                        <div class="valid-feedback">
                            <?php echo $nameErr ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustomUsername" class="form-label">Birthday</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="date" class="form-control" id="validationCustomUsername" name="birthday" aria-describedby="inputGroupPrepend" value="<?php echo $value_birthday ?>" required>
                            <div class="invalid-feedback">
                                <?php echo $birthdayErr ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label for="validationCustom03" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" id="validationCustom03" value="<?php echo $value_address ?>" required>
                        <div class="invalid-feedback">
                            <?php echo $addressErr ?>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: flex; flex-direction: column">
                        <label class="form-label" for="inputGroupFile01">Image</label>
                        <input type="file" class="form-control" value="<?php echo $value_image ?>" id="inputGroupFile01" name="image"  onchange="loadFile(event)">
                        <div class="invalid-feedback">
                            <?php
                            echo $imageErr
                            ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Update form</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">

                <a href="http://localhost/LearnPHP/day3/listStudent.php" class="btn btn-primary">Students Table</a>

                <div class="img">
                    <img id="output" src="<?php echo $value_image ?>" alt="" style="max-width: 400px; margin-top: 20px" />
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
</body>

</html>