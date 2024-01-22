<?php
// Panggil file konfigurasi database atau sesuaikan dengan kebutuhan
include '../database.php';

class ProductHandler {
    private $pdo;

    public function __construct($host, $db, $user, $password) {
        $database = new Database($host, $db, $user, $password);
        $this->pdo = $database->getPDO();
    }

    public function handleProductAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $productID = $_POST['productID'];

            if ($action === 'deleteProduct') {
                return $this->deleteProduct($productID);
            } elseif ($action === 'updateHarga') {
                $newData = $_POST['newData'];
                return $this->updateProduct('harga', $productID, $newData);
            } elseif ($action === 'addProduct') {
                $newData = $_POST['newData'];
                return $this->addProduct($newData);
            } else {
                return json_encode(['success' => false, 'message' => 'Invalid action.']);
            }
        } else {
            return json_encode(['success' => false, 'message' => 'Invalid request method.']);
        }
    }

    private function deleteProduct($productID) {
        $query = "DELETE FROM product WHERE idProduct = :productID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':productID', $productID);

        if ($stmt->execute()) {
            return json_encode(['success' => true, 'message' => 'Product deleted successfully.', 'deletedProductID' => $productID]);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to delete the product.']);
        }
    }

    private function updateProduct($columnName, $productID, $newData) {
        $query = "UPDATE product SET $columnName = :newData WHERE idProduct = :productID";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':newData', $newData);
        $stmt->bindParam(':productID', $productID);

        if ($stmt->execute()) {
            return json_encode(['success' => true, 'message' => 'Product updated successfully.', 'updatedProductID' => $productID]);
        } else {
            return json_encode(['success' => false, 'message' => "Failed to update $columnName."]);
        }
    }

    private function addProduct($newData) {
        $productName = $newData['productName'];
        $productPrice = $newData['productPrice'];
        $productComposition = $newData['productComposition'];
        $productFlavor = $newData['productFlavor'];
        $productWeight = $newData['productWeight'];
    
        $query = "INSERT INTO product (nama, harga, komposisi, rasa, berat_bersih) 
                  VALUES (:productName, :productPrice, :productComposition, :productFlavor, :productWeight)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productPrice', $productPrice);
        $stmt->bindParam(':productComposition', $productComposition);
        $stmt->bindParam(':productFlavor', $productFlavor);
        $stmt->bindParam(':productWeight', $productWeight);
    
        if ($stmt->execute()) {
            $newProductID = $this->pdo->lastInsertId();
            return json_encode(['success' => true, 'message' => 'Product added successfully.', 'newProductID' => $newProductID]);
        } else {
            return json_encode(['success' => false, 'message' => 'Failed to add the product.']);
        }
    }
    
}

// Gunakan kelas ProductHandler
$productHandler = new ProductHandler("localhost", "cloud", "root", "");

// Tangani aksi produk dan tampilkan hasilnya
echo $productHandler->handleProductAction();
?>
