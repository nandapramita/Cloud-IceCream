<?php
include 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $productID = $_POST['productID'];

    if ($action === 'deleteProduct') {
        // Delete the product from the database
        $query = "DELETE FROM product WHERE idProduct = :productID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':productID', $productID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '', 'deletedProductID' => $productID]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete the product.']);
        }
    } elseif ($action === 'updateHarga' || $action === 'updateStok') {
        // Perform price or stock update
        $newData = $_POST['newData'];

        // Determine the column to be updated
        $updateColumn = ($action === 'updateHarga') ? 'harga' : 'stok';

        // Perform the update in the database
        $query = "UPDATE product SET $updateColumn = :newData WHERE idProduct = :productID";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':newData', $newData);
        $stmt->bindParam(':productID', $productID);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => '', 'updatedProductID' => $productID]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update $updateColumn."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid action.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>