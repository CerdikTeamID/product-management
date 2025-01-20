<?php
include ("../conn/conn.php"); // Adjust the path as necessary

if (isset($_POST['tbl_product_id'])) {
    $productID = $_POST['tbl_product_id'];

    // Prepare the SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM tbl_product WHERE tbl_product_id = :productID");
    $stmt->bindParam(':productID', $productID);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Product deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete product.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>