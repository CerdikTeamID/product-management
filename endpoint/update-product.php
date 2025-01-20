<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name'], $_POST['categories'], $_POST['purchase'], $_POST['selling'], $_POST['stock'], $_FILES['file'])) {
    $productID = $_POST['tbl_product_id'];
    $productName = $_POST['product_name'];
    $categories = $_POST['categories'];
    $purchase = $_POST['purchase'];
    $selling = $_POST['selling'];
    $stock = $_POST['stock'];
    $dateUpdated = date("Y-m-d H:i:s");

    // Handle file upload
    $imagePath = ''; // Initialize image path
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $imageTmpPath = $_FILES['file']['tmp_name'];
        $imageName = basename($_FILES['file']['name']);
        $imagePath = $uploadDir . $imageName;

        // Move the uploaded file
        if (!move_uploaded_file($imageTmpPath, $imagePath)) {
            echo "Error uploading file.";
            exit();
        }
    } else {
        // Fetch the existing image from the database if no new image is uploaded
        $stmt = $conn->prepare("SELECT productImage FROM tbl_product WHERE tbl_product_id = :tbl_product_id");
        $stmt->bindParam(":tbl_product_id", $productID, PDO::PARAM_STR);
        $stmt->execute();
        $existingImage = $stmt->fetchColumn();
        $imagePath = $existingImage; // Use existing image
    }

    try {
        $stmt = $conn->prepare("UPDATE tbl_product SET product_name = :product_name, tbl_kategori_id = :categories, purchase = :purchase, selling = :selling, stock = :stock, productImage = :image, date_updated = :date_updated WHERE tbl_product_id = :tbl_product_id");
        
        $stmt->bindParam(":tbl_product_id", $productID, PDO::PARAM_STR);
        $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
        $stmt->bindParam(":categories", $categories, PDO::PARAM_INT); 
        $stmt->bindParam(":purchase", $purchase, PDO::PARAM_STR);
        $stmt->bindParam(":selling", $selling, PDO::PARAM_STR);
        $stmt->bindParam(":stock", $stock, PDO::PARAM_INT); 
        $stmt->bindParam(":image", $imagePath, PDO::PARAM_STR);
        $stmt->bindParam(":date_updated", $dateUpdated, PDO::PARAM_STR);

        $stmt->execute();

        header("Location: http://localhost/product-management/products.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo "
            <script>
                alert('An error occurred while updating the product. Please try again.');
                window.location.href = 'http://localhost/product-management/products.php';
            </script>
        ";
    }
    } else {
        echo "
            <script>
                alert('Please fill in all fields!');
                window.location.href = 'http://localhost/product-management/products.php';
            </script>
        ";
    }
}
?>