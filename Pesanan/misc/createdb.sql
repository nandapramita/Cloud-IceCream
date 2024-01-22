CREATE TABLE pesanan (
    idPesanan INT AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    idProduct INT,
    address VARCHAR (255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idUser) REFERENCES user(idUser),
    FOREIGN KEY (idProduct) REFERENCES product(idProduct)
);