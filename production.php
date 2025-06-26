<?php
session_start(); 
include "database.php";

if (isset($_POST["submit_add"])) {
    $ProductName = $_POST['ProductName'];
    $userID = $_SESSION['userID'];
    $DateProduced = $_POST['DateProduced'];
    $Quantity = $_POST['Quantity'];

    $stmt_insert = mysqli_prepare($conn, "INSERT INTO `production`(`ProductName`,`UserID`, `DateProduced`, `Quantity`) VALUES (?,?, ?, ?)");

    if ($stmt_insert) {
        mysqli_stmt_bind_param($stmt_insert, "sisi", $ProductName,$userID, $DateProduced, $Quantity);
        $result_insert = mysqli_stmt_execute($stmt_insert);

        if ($result_insert) {
            header("Location: production.php?msg=New record created successfully");
            exit();
        } else {
            echo "Failed to insert: " . mysqli_stmt_error($stmt_insert);
        }
        mysqli_stmt_close($stmt_insert);
    } else {
        echo "Failed to prepare insert statement: " . mysqli_error($conn);
    }
}

if (isset($_POST["submit_update"])) {
    $ProductionID = $_POST['ProductionID'];
    $ProductName = $_POST['ProductName'];
    $DateProduced = $_POST['DateProduced'];
    $Quantity = $_POST['Quantity'];

    $stmt_update = mysqli_prepare($conn, "UPDATE `production` SET `ProductName`=?, `DateProduced`=?, `Quantity`=? WHERE `ProductionID`=?");

    if ($stmt_update) {
        mysqli_stmt_bind_param($stmt_update, "ssii", $ProductName, $DateProduced, $Quantity, $ProductionID);
        $result_update = mysqli_stmt_execute($stmt_update);

        if ($result_update) {
            header("Location: production.php?msg=Data updated successfully");
            exit();
        } else {
            echo "Failed to update: " . mysqli_stmt_error($stmt_update);
        }
        mysqli_stmt_close($stmt_update);
    } else {
        echo "Failed to prepare update statement: " . mysqli_error($conn);
    }
}


if (isset($_POST["submit_deletion"])) {
    $ProductionID = $_POST["ProductionID"];

    $sql = "DELETE FROM `production` WHERE ProductionID = $ProductionID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
    header("Location: production.php? msg=Data deleted successfully");
    } else {
    echo "Failed: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Inventory</title>

    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <div class="my-5 pt-5">
        <h1 class="text-center" style="font-family: 'Product Sans Black', sans-serif; color:#18383F"> Welcome back, <?php $userName= $_SESSION['first_name']; echo $userName ; ?>!</h1>
        <h6 class="text-center fs-6" style="font-family: 'Product Sans', sans-serif; color:#18383F"> Your inventory, updated and ready </h6>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-6" id="myModalLabel" style="font-family: 'Product Sans Black', sans-serif; color:#18383F">Add New Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="text-center mb-4">
                            <p class="text-muted">Complete the form below to add a new Product Record</p>
                        </div>
                        <div class="container d-flex justify-content-center">
                            <form action="" method="post" style="width:50vw; min-width:300px;">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Product Name:</label>
                                        <input type="text" class="form-control" name="ProductName" placeholder="">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Date Produced</label>
                                        <input type="date" class="form-control" name="DateProduced">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Quantity:</label>
                                        <input type="text" class="form-control" name="Quantity" placeholder="">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn"
                                    style="font-family: 'Product Sans Black', sans-serif; color:#18383F; background-color: #B2DDE6; border-color: #B2DDE6"
                                    name="submit_add">Add</button>
                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                    style="font-family: 'Product Sans Black', sans-serif; color:#18383F; border-color:rgb(255, 255, 255);"
                                    >Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed top-0 start-0 px-5 py-4">
        <a href="production.php"> <img src="InStock.png" alt="InStock Logo" style="height: 30px;"> </a>
    </div>

    <div class="container">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="fs-6 my-0" style="font-family: 'Product Sans', sans-serif; color:#18383F;">
                Type of Inventory: <span style="font-family: 'Product Sans Black', sans-serif;">Production</span>
            </h6>
            <button type="button" class="btn btn-info ps-4 pe-4" data-bs-toggle="modal" data-bs-target="#myModal" style="font-family: 'Product Sans Black', sans-serif; color:#18383F; background-color: #B2DDE6; border-color: #B2DDE6;">Add New</button>
        </div>

        <table class="table rounded-3 text-center overflow-hidden">
            <thead class="table" style="font-family: 'Product Sans Black', sans-serif; color:#18383F; background-color: #B2DDE6; border-color: #B2DDE6">
                <tr>
                    <th scope="col">Production ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Date Produced</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody style="font-family: 'Product Sans', sans-serif; color: #18383F;">
                <?php
                $userID = $_SESSION['userID'];
                $sql = "SELECT * FROM `production` WHERE `UserID` = $userID";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["ProductionID"] ?></td>
                        <td><?php echo $row["ProductName"] ?></td>
                        <td><?php echo $row["DateProduced"] ?></td>
                        <td><?php echo $row["Quantity"] ?></td>
                        <td>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#editModal_<?php echo $row["ProductionID"]; ?>" class="link-dark"><i class="fa-regular fa-pen-to-square fs-5 me-3" style="color: #18383F;"></i></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_<?php echo $row["ProductionID"]; ?>" class="link-dark"><i class="fa-regular fa-trash-can fs-5" style="color: #18383F;"></i></a>
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal_<?php echo $row["ProductionID"]; ?>" tabindex="-1" aria-labelledby="editModalLabel_<?php echo $row["ProductionID"]; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fs-6" id="editModalLabel_<?php echo $row["ProductionID"]; ?>" style="font-family: 'Product Sans Black', sans-serif; color:#18383F">Edit Record (ID: <?php echo $row["ProductionID"]; ?>)</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="text-center mb-4">
                                            <p class="text-muted">Edit details for Production ID: <?php echo $row["ProductionID"]; ?></p>
                                        </div>
                                        <div class="container justify-content-center ">
                                            <form action="" method="post" style="width:50vw; min-width:300px;">
                                                <input type="hidden" name="ProductionID" value="<?php echo $row["ProductionID"]; ?>">

                                                <div class="row mb-3">
                                                    <div class="col">
                                                        <label class="form-label">Production Name:</label>
                                                        <input type="text" class="form-control" name="ProductName" value="<?php echo $row['ProductName']; ?>">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Date Produced</label>
                                                        <input type="date" class="form-control" name="DateProduced" value="<?php echo $row['DateProduced']; ?>">
                                                    </div>
                                                    <div class="col">
                                                        <label class="form-label">Quantity</label>
                                                        <input type="text" class="form-control" name="Quantity" value="<?php echo $row['Quantity']; ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn"
                                                           style="font-family: 'Product Sans Black', sans-serif; color:#18383F; background-color: #B2DDE6; border-color: #B2DDE6"
                                                           name="submit_update">Update</button>
                                                    <button type="button" class="btn" data-bs-dismiss="modal"
                                                            style="font-family: 'Product Sans Black', sans-serif; color:#18383F; border-color:rgb(255, 255, 255);">
                                                        Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="confirmDeleteModal_<?php echo $row["ProductionID"]; ?>" tabindex="-1" aria-labelledby="confirmDeleteModalLabel_<?php echo $row["ProductionID"]; ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="text-center mb-4">
                                            <p class="text-muted">Are you sure you want to delete Production ID: <?php echo $row["ProductionID"]; ?>?</p>
                                        </div>
                                        <div class="container d-flex justify-content-center">
                                            <div class="modal-footer">
                                                <form action="" method="post">
                                                    <input type="hidden" name="ProductionID" value="<?php echo $row["ProductionID"]; ?>">
                                                    <button type="submit" class="btn"
                                                           style="font-family: 'Product Sans Black', sans-serif; color:#18383F; background-color: #B2DDE6; border-color: #B2DDE6"
                                                           name="submit_deletion">Yes</button>
                                                </form>
                                                <button type="button" class="btn" data-bs-dismiss="modal"
                                                        style="font-family: 'Product Sans Black', sans-serif; color:#18383F; border-color:rgb(255, 255, 255);">
                                                    No
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>