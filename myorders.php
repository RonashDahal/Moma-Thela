<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Moma-Thela</title>
    <link rel="stylesheet" type="text/css" href="../minimum.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="../iconlogo.png">
    <style>
        body {
            background-color: #070e16;
            color: white;
            font-family: Poppins, sans-serif;
            padding: 20px;
        }
        .order-card {
            background: #0e1621;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .order-card:hover {
            background: #1a2533;
        }
        .modal-content {
            background-color: #0e1621;
            color: white;
        }
        .order-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <header>
            <div class="logo">
               <a href="index.html"><img src="../iconlogo.png" alt="Moma-Thela Logo"></a>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.html">Home</a></li>
                    <li><a href="../index.html#about">About</a></li>
                    <li><a href="../shop.html">Menu</a></li>
                    <li><a href="../index.html#reservations">Reservations</a></li>
                    <li><a href="../index.html#contact">Contact</a></li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <h2 class="font-weight-bold">My Pending Orders</h2>
            <div id="orders-list">
                <?php
                    include 'config.php';
                    $sql = "SELECT * FROM orders ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_name = $row['product_name'];
                            
                             // Check for different types of momo and set the appropriate image
            if (strpos(strtolower($product_name), 'momo') !== false) {
                if (strpos(strtolower($product_name), 'steam') !== false) {
                    $image = 'steam2.png';
                } elseif (strpos(strtolower($product_name), 'fried') !== false) {
                    $image = 'fried.png';
                } elseif (strpos(strtolower($product_name), 'jhol') !== false) {
                    $image = 'jhol.png';
                } elseif (strpos(strtolower($product_name), 'tandoori') !== false) {
                    $image = 'tandoori.png';
                } elseif (strpos(strtolower($product_name), 'chili') !== false) {
                    $image = 'chilli.png';
                } elseif (strpos(strtolower($product_name), 'chaat') !== false) {
                    $image = 'chaat.png';
                } elseif (strpos(strtolower($product_name), 'curry') !== false) {
                    $image = 'curry.png';
                }
            }

            // Default image if no match is found
            if (!$image) {
                $image = 'default.png'; // Use a default image
            }
                            

                            echo '<div class="order-card">';
                            echo '<div class="d-flex align-items-center">';
                            echo '<img src="../' . $image . '" class="order-img mr-3" alt="Product Image">';
                            echo '<div>';
                            echo '<p><strong>' . $row['product_name'] . '</strong> - ' . $row['quantity'] . ' pcs</p>';
                            echo '<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#orderModal" 
                            data-product="' . $row['product_name'] . '" 
                            data-quantity="' . $row['quantity'] . '" 
                            data-price="' . $row['price'] . '" 
                            data-shipping="20" 
                            data-sauce="' . $row['sauce'] . '" 
                            data-payment="' . $row['payment_method'] . '" 
                            data-total="' . $row['total_price'] . '" 
                            data-date="' . $row['order_date'] . '" 
                            data-image="../' . $image . '">See Details</button>';
                            echo '</div></div></div>';
                        }
                    } else {
                        echo '<p>No orders found.</p>';
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>

        <!-- Order Details Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="modal-product-img" class="order-img mb-3" src="" alt="Product Image">
                        <p><strong>Product:</strong> <span id="modal-product-name"></span></p>
                        <p><strong>Quantity:</strong> <span id="modal-quantity"></span></p>
                        <p><strong>Price:</strong> <span id="modal-price"></span></p>
                        <p><strong>Shipping Fee:</strong> <span id="modal-shipping"></span></p>
                        <p><strong>Selected Sauce:</strong> <span id="modal-sauce"></span></p>
                        <p><strong>Payment Method:</strong> <span id="modal-payment"></span></p>
                        <p><strong>Total Price:</strong> <span id="modal-total-price"></span></p>
                        <p><strong>Date:</strong> <span id="modal-date"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="../iconlogo.png" alt="Logo">
                </div>
                <nav class="footer-links">
                    <a href="../index.html">Home</a>
                    <a href="../index.html#about">About</a>
                    <a href="../shop.html">Menu</a>
                    <a href="../#reservations">Reservations</a>
                    <a href="../#testimonials">Reviews</a>
                    <a href="../#gallery">Gallery</a>
                    <a href="../#contact">Contact</a>
                </nav>
                <div class="footer-social">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <p class="footer-text">&copy; 2024 Moma-Thela. All rights reserved.</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $('#orderModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                $('#modal-product-name').text(button.data('product'));
                $('#modal-quantity').text(button.data('quantity'));
                $('#modal-price').text(button.data('price'));
                $('#modal-shipping').text(button.data('shipping'));
                $('#modal-sauce').text(button.data('sauce'));
                $('#modal-payment').text(button.data('payment'));
                $('#modal-total-price').text(button.data('total'));
                $('#modal-date').text(button.data('date'));
                $('#modal-product-img').attr('src', button.data('image'));
            });
        </script>
    </div>
</body>
</html>
