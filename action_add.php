<?php
include("config.php");
include("firebaseRDB.php");
$db = new firebaseRDB($databaseURL);
// Check if an image file is being uploaded
if(isset($_FILES['p_image']) && $_FILES['p_image']['error'] == 0) {
   // Set the directory to store the image file
   $upload_dir = 'uploaded_img/';

   // Create a new filename (you can choose a suitable name)
   $new_filename = uniqid('product_image_', true) . '.' . pathinfo($_FILES['p_image']['name'], PATHINFO_EXTENSION);

   // Set the path where the file will be saved
   $upload_path = $upload_dir . $new_filename;

   // Move the image file to the specified location
   if(move_uploaded_file($_FILES['p_image']['tmp_name'], $upload_path)) {
       // Insert data into the database
       $insert = $db->insert("product", [
           "p_name"          => $_POST['p_name'],
           "p_code"          => $_POST['p_code'],
           "p_quantity"      => $_POST['p_quantity'],
           "p_image"         => $upload_path,
       ]);

       // Display the success message when data is successfully saved in the database
       echo "Data saved successfully.";
       // Add a button to go back to index.php
       echo '<br><a href="index.php" class="back-btn">Go back </a>';
       // Add style for the button
            echo '<style>
            .back-btn {
               display: inline-block;
               padding: 10px 20px;
               background-color: #4caf50;
               color: white;
               text-decoration: none;
               border-radius: 5px;
               transition: background-color 0.3s;
            }

            .back-btn:hover {
               background-color: #45a049;
            }
            </style>';
   } else {
       // Display an error message if there is an issue moving the uploaded file
       echo "Error moving uploaded file.";
   }
} else {
   // Display a message if no image file is selected
   echo "Please select an image file to upload.";
}
?>