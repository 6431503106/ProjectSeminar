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
    <title>UPDATE Product</title>
</head>
<body>

    <h3>UPDATE Product</h3>

    <form action="edit.php?id=<?php echo $id; ?>" method="POST">
    <input type="text" name="p_name" placeholder="Product name" class="box" required>
        <input type="text" name="p_code" placeholder="The product code" class="box" required>
        <input type="number" name="p_quantity" min="1" placeholder="The product quantity" class="box" required>
        <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg"  class="box" required>
        <input type="submit" class="btnProduct" name="add_product" value="UPDATE THE PRODUCT" >
    </form>

</body>
</html>
