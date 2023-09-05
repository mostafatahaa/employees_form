<?php
require "create.php";
require "update.php";

$sql = "SELECT * FROM user";
// we use the connection to database -> sql statematn to read the select data
$stmt = $db_connection->query($sql);
//FETCH_PROPS_LATE ==> Call the constructor before setting properties.
// Arguments of custom class constructor when the mode parameter is PDO::FETCH_CLASS.
$result = $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, "User", ['name', 'email', 'age', 'salary', 'address']);
$result = is_array($result) && !empty($result) ? $result : false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title>PDO</title>
</head>

<body>
    <form method="post" style="width: 50%; margin:auto; padding-top:100px;">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                Please fill out the form
            </div>
        <?php endif ?>

        <?php if (isset($msg)) : ?>
            <div class="alert alert-primary" role="alert" style="background-color: #d3ffda;">
                Successfly saved information
            </div>
        <?php endif ?>

        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" value="<?= isset($user) ? $user->name : "" ?>" aria-describedby="emailHelp" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" value="<?= isset($user) ? $user->email : "" ?>" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">age</label>
            <input type="number" class="form-control" name="age" value="<?= isset($user) ? $user->age : "" ?>" placeholder="Your age">
        </div>
        <div class="form-group">
            <label>Salary</label>
            <input type="number" name="salary" class="form-control" value="<?= isset($user) ? $user->salary : "" ?>" step="0.1" laceholder=" put your salary">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" value="<?= isset($user) ? $user->address : "" ?>" placeholder="Your Address">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>

    <table class="table table-striped table-dark" style="width: 70%; margin:auto;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email address</th>
                <th scope="col">Age</th>
                <th scope="col">Salary</th>
                <th scope="col">Address</th>
                <th scope="col">Control</th>
            </tr>
        </thead>
        <?php if ($result === false) : ?>
            <tr>
                <td>
                    <div class="alert alert-dark" role="alert" style="background-color: #d3d3d3;">
                        No Information to show
                    </div>
                <td>
            </tr>
        <?php endif ?>
        <tbody>
            <?php
            if ($result !== false) {
                foreach ($result as $employees => $val) :
            ?>
                    <tr>
                        <td><?= ++$counter ?></td>
                        <td><?= $val->name ?></td>
                        <td><?= $val->email ?></td>
                        <td><?= $val->age ?></td>
                        <td><?= $val->salary ?></td>
                        <td><?= $val->address ?></td>
                        <td>
                            <a href="/PDO/?action=edit&id=<?= $val->id ?>"><button type="button" class="btn btn-info">Edit</button></a>
                            <a href="/PDO/?action=delete&id=<?= $val->id ?>" onclick="if(!confirm('Do you want to delete this employee ?')) return false;"><i class=" fa fa-time"></i><button type=" button" class="btn btn-danger">Delete</button></a>
                        </td>

                    </tr>
                <?php endforeach ?>

            <?php } ?>


        </tbody>
    </table>
</body>

</html>