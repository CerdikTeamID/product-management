<?php
include("../conn/conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name'], $_POST['categories'], $_POST['purchase'], $_POST['selling'], $_POST['stock'], $_FILES['file'])) {
        $productName = $_POST['product_name'];
        $categories = $_POST['categories'];
        $purchase = $_POST['purchase'];
        $selling = $_POST['selling'];
        $stock = $_POST['stock'];
        $dateUpdated = date("Y-m-d H:i:s");

        // Handle file upload
        $uploadDir = '../uploads/'; // Adjust the path as necessary
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
        }

        $imagePath = '';
        if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['file']['tmp_name'];
            $imageName = $_FILES['file']['name'];
            $imagePath = $uploadDir . basename($imageName); // Ensure the uploads directory exists

            if (!move_uploaded_file($imageTmpPath, $imagePath)) {
                echo "Error uploading file.";
                exit();
            }
        } else {
            echo "File upload error.";
            exit();
        }

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_product (product_name, tbl_kategori_id, purchase, selling, stock, productImage, date_updated) VALUES (:product_name, :categories, :purchase, :selling, :stock, :image, :date_updated)");
            
            $stmt->bindParam(":product_name", $productName, PDO::PARAM_STR);
            $stmt->bindParam(":categories", $categories, PDO::PARAM_INT);
            $stmt->bindParam(":purchase", $purchase, PDO::PARAM_STR);
            $stmt->bindParam(":selling", $selling, PDO::PARAM_STR);
            $stmt->bindParam(":stock", $stock, PDO::PARAM_STR);
            $stmt->bindParam(":image", $imagePath, PDO::PARAM_STR);
            $stmt->bindParam(":date_updated", $dateUpdated, PDO::PARAM_STR);

            $stmt->execute();

            header("Location: http://localhost/product-management/products.php");
            exit();
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
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
