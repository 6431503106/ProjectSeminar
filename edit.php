<?php
include("config.php");
include("firebaseRDB.php");

$db = new firebaseRDB($databaseURL);

// Fetch product details for editing
$id = $_GET['id'];
$product = json_decode($db->retrieve("product/$id"), true);

// Check if the form is submitted
if(isset($_POST['edit_product'])){
    // Update product information
    $update = $db->update("product", $id, [
        "p_name"     => $_POST['p_name'],
        "p_code"     => $_POST['p_code'],
        "p_quantity" => $_POST['p_quantity'],
    ]);

    if($update){
        echo "Data updated successfully.";
    } else {
        echo "Error updating data.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>

    <!-- Include Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }

    .admin-product-form-container {
        max-width: 500px;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        font-size: 24px;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .box {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .box:focus {
        outline: none;
        border-color: #4caf50;
    }

    .btnProduct {
        background-color: #4caf50;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .btnProduct:hover {
        background-color: black;
    }
</style>

    <div class="container">

        <div class="admin-product-form-container centered">

        <form action="edit.php?id=<?php echo $id; ?>" method="POST">

        <h3>UPDATE A PRODUCT</h3>

        <input type="text" name="p_name" placeholder="Product name" class="box" required>
        <input type="text" name="p_code" placeholder="The product code" class="box" required>
        <input type="number" name="p_quantity" min="1" placeholder="The product quantity" class="box" required>
        <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg"  class="box" required>
        <input type="hidden" name="id" value="<?php echo $id?>" class="box" required>
            <input type="submit" value="SAVE A PRODUCT" class="btnProduct" required >
           <a href="index.php" class="btnProduct"> GO BACK </a>
        </form>
        </div>

    </div>
</body>
</html>