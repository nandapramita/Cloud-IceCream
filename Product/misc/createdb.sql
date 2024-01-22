CREATE TABLE product (
    idProduct INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    harga DECIMAL(10, 2),
    komposisi TEXT,
    rasa VARCHAR(50),
    berat_bersih DECIMAL(10, 2),
    gambar VARCHAR(255)
);