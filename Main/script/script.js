//JAVASCRIPT MODULES UNTUK FEEDBACK
function calculateTotal() {
    var taste = parseInt(document.getElementById('taste').value);
    var texture = parseInt(document.getElementById('texture').value);
    var presentation = parseInt(document.getElementById('presentation').value);
    var overall = parseInt(document.getElementById('overall').value);

    var totalRating = (taste + texture + presentation + overall) / 4;

    document.getElementById('totalRating').innerHTML = 'Rating Anda: ' + totalRating.toFixed(2);
}


//JAVACRIPT CLASS UNTUK PENCARIAN HARGA
class IceCream {
    //Constructor sebagai inisial harga ice cream
    constructor() {
        //Variabel yg menyimpan list harga
        this.iceCreamPrices = {
            "sorbet": 12.99,
            "frozen": 13.99,
            "highpro": 13.99,
            "yogurt": 11.99,
            "gelato": 15.99,
            "regular": 10.99,};
    }

    //Method untuk mencari harga ice cream yg diinputkan
    checkPrice(iceCreamName) {
        //toLowerCase() supaya tdk case sensitif
        iceCreamName = iceCreamName.toLowerCase();

        //memeriksa inputan ada dlm list atau tidak
        if (this.iceCreamPrices.hasOwnProperty(iceCreamName)) {
            //return value jika ada
            return this.iceCreamPrices[iceCreamName];
        } else {
            //return value jika tidak ada
            return "not found";
        }
    }
}

//Function untuk mengelola tampilan
function checkIceCreamPrice() {
    //membuat instance dr class
    const iceCreamInstance = new IceCream();

    //menemukan nilai inputan
    const iceCreamNameInput = document.getElementById("iceCreamName").value;

    //memanggil method dan menampilkan hasil
    const price = iceCreamInstance.checkPrice(iceCreamNameInput);
    document.getElementById("priceDisplay").innerText = `Price: ${price}`;
}