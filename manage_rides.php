<?php
session_start();
require 'config.php';

// Redirect if not admin
if (!isset($_SESSION['admin'])) {
    header("Location: adminlog.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Upload image
    $image_name = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    // Make sure folder exists
    if (!file_exists('images/rides')) {
        mkdir('images/rides', 0777, true);
    }

    $image_path = 'images/rides/' . $image_name;
    move_uploaded_file($image_tmp, $image_path);

    // Save to DB
    $stmt = $conn->prepare("INSERT INTO rides (name, price, description, image) VALUES (:name, :price, :description, :image)");
    $stmt->execute([
        'name' => $name,
        'price' => $price,
        'description' => $description,
        'image' => $image_name
    ]);

    // Redirect to show success
    header("Location: manage_rides.php?success=1");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Ride</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f6f8;
      padding: 20px;
    }
    h2 {
      color: #333;
    }
    form {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      margin-top: 20px;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-family: inherit;
    }
    button {
      background: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .success-message {
      background: #d4edda;
      color: #155724;
      padding: 10px 15px;
      border-radius: 6px;
      margin-bottom: 15px;
      border: 1px solid #c3e6cb;
    }
  </style>
</head>
<body>

<h2>Add New Ride</h2>

<?php if (isset($_GET['success'])): ?>
  <div class="success-message">
    Ride added successfully!
  </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
  <label>Ride Name</label>
  <input type="text" name="name" required>

  <label>Price (₹)</label>
  <input type="number" name="price" step="0.01" required>

  <label>Description</label>
  <textarea name="description" rows="3" required></textarea>

  <label>Upload Image</label>
  <input type="file" name="image" accept="image/*" required>

  <button type="submit">Add Ride</button>
</form>

</body>
</html>
