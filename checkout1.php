<?php
include 'backendfiles/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $sauce = $_POST['sauce'];
    $total_price = $_POST['total_price'];
    $payment_method = "Cash On Delivery"; 

   
    $sql = "INSERT INTO orders (name, email, phone, address, product_name, quantity, price, sauce, total_price, payment_method) 
            VALUES ('$name', '$email', '$phone', '$address', '$product_name', '$quantity', '$price', '$sauce', '$total_price', '$payment_method')";

    if (mysqli_query($conn, $sql)) {
        
        header("Location: success.html");
  exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Moma-Thela</title>
    <link rel="stylesheet" type="text/css" href="minimum.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="iconlogo.png">
    <style>
        body {
            background-color: #070e16;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            background: #0e1621;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
        }
        .form-section, .summary-section {
            width: 48%;
        }
        .summary-section img {
            width: 100%;
            border-radius: 10px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        .summary {
            margin-top: 20px;
            background: #1a2533;
            padding: 15px;
            border-radius: 10px;
        }
        .summary p {
            display: flex;
            justify-content: space-between;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
        .checkout-btn {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #1eff0085;
            color: white;
            border: none;
            margin-top: 10px;
        }
        .summary-section img {
    width: 100%;
    height: 17rem; 
    border-radius: 10px;
    object-fit: cover; 
}

    </style>
</head>
<body>
    <div class="main-container">
        <header>
            <div class="logo">
               <a href="index.html"><img src="iconlogo.png" alt="Moma-Thela Logo"></a>
            </div>
            <nav>
                <ul >
                    <li><a href="index.html">Home</a></li>
                    <li><a href="index.html#about">About</a></li>
                    <li><a href="shop.html">Menu</a></li>
                    <li><a href="backendfiles/myorders.php">My Orders</a></li>
                    <li><a href="index.html#contact">Contact</a></li>
                </ul>
            </nav>
        </header>
<form action="checkout1.php" method="POST">
        <div class="container">
            <div class="form-section">
                <h2>Checkout</h2>
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label>Phone Number:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label>Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <button type="submit" class="checkout-btn">Checkout</button>
            </div>
           

            <div class="summary-section">
                <img id="product-img" src="" alt="Product Image">
                <div class="summary">
                    <p><span>Product:</span> <span id="product-name" name="product-name" ></span></p>
                    <p><span>Quantity:</span> <span id="product-quantity" name="quantity" ></span></p>
                    <p><span>Price:</span> <span id="product-price" name="price" ></span></p>
                    <p><span>Shipping Fee:</span> <span>RS.20</span></p>
                    <p><span>Selected Sauce: </span><span name="sauce" id="selsauce"></span></p>
                    <p><span>Payment Method: </span><span name="total-price" >Cash On Delivery</span></p>
                    <p class="total"><span>Total:</span> <span id="total-price"></span></p>
                </div>
            </div>
        </div>
        </form>
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="iconlogo.png" alt="Logo">
                </div>
                <nav class="footer-links">
                    <a href="index.html">Home</a>
                    <a href="index.html#about">About</a>
                    <a href="shop.html">Menu</a>
                    <a href="index.html#reservations">Reservations</a>
                    <a href="index.html#testimonials">Reviews</a>
                    <a href="index.html#gallery">Gallery</a>
                    <a href="index.html#contact">Contact</a>
                </nav>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <p class="footer-text">&copy; 2024 Moma-Thela. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
</body>
<script>
    window.addEventListener('DOMContentLoaded', function() {
    const momoDetails = JSON.parse(localStorage.getItem('selectedMomo'));
    if (momoDetails) {
        
        document.getElementById("product-name").textContent = momoDetails.name;
        document.getElementById("product-img").src = momoDetails.image;

        let quantity = momoDetails.quantity ? parseInt(momoDetails.quantity) : 1;
        let itemPrice = momoDetails.price ? parseInt(momoDetails.price.replace(/[^\d]/g, "")) : 0;
        const shippingFee = 20;
        const totalCost = (itemPrice * quantity) + shippingFee;
        const dsauce =  localStorage.getItem('selectedSauce');

      
        document.getElementById("product-quantity").textContent = quantity;
        document.getElementById("product-price").textContent = `RS.${itemPrice * quantity}`;
        document.getElementById("total-price").textContent = `RS.${totalCost}`;
        document.getElementById("selsauce").textContent = dsauce;

        
        let form = document.querySelector('form'); 

        
        let productNameInput = document.createElement('input');
        productNameInput.type = 'hidden';
        productNameInput.name = 'product_name';
        productNameInput.value = momoDetails.name;
        form.appendChild(productNameInput);

        let quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = quantity;
        form.appendChild(quantityInput);

        let priceInput = document.createElement('input');
        priceInput.type = 'hidden';
        priceInput.name = 'price';
        priceInput.value = itemPrice * quantity;
        form.appendChild(priceInput);

        let sauceInput = document.createElement('input');
        sauceInput.type = 'hidden';
        sauceInput.name = 'sauce';
        sauceInput.value = dsauce;
        form.appendChild(sauceInput);

        let totalPriceInput = document.createElement('input');
        totalPriceInput.type = 'hidden';
        totalPriceInput.name = 'total_price';
        totalPriceInput.value = totalCost;
        form.appendChild(totalPriceInput);
    } else {
        console.error("No momo details found in local storage.");
    }
});

</script>


</html>
