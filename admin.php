<?php
include 'config.php';

if (isset($_POST['delete_id'])) {
    $delete_id = (int) $_POST['delete_id'];
    $delete_sql = "DELETE FROM orders WHERE id = $delete_id";
    if (mysqli_query($conn, $delete_sql)) {
        echo "<script>alert('Order deleted successfully'); window.location.href = 'admin.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting order');</script>";
    }
}

$sql = "SELECT * FROM orders";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Order List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #070e16;
            padding: 20px;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a:hover {
            background-color: #1a1f2b;
        }

        .main-content {
            margin-left: 270px;
            padding: 20px;
            flex: 1;
            width: calc(100% - 270px);
        }

        h1.my-4 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        #fl {
            margin-left: auto;
            margin-right: auto;
            width: fit-content;
        }

        /* Make the order details section responsive */
        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
        }

    </style>
</head>
<body>
    <div class="sidebar">
        <img id="fl" src="../iconlogo.png" height="70" width="70" >
        <h2>Admin Panel</h2>
        <a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <a href="#"><i class="fas fa-shopping-cart"></i> Orders</a>
        <a href="#"><i class="fas fa-box"></i> Products</a>
        <a href="#"><i class="fas fa-users"></i> Customers</a>
        <a href="#"><i class="fas fa-cog"></i> Settings</a>
    </div>

    <div class="main-content">
        <h1 class="my-4">Order List</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sauce</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['order_date']) . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['phone']) . "</td>
                                <td>" . htmlspecialchars($row['address']) . "</td>
                                <td>" . htmlspecialchars($row['product_name']) . "</td>
                                <td>" . htmlspecialchars($row['quantity']) . "</td>
                                <td>RS." . htmlspecialchars($row['price']) . "</td>
                                <td>" . htmlspecialchars($row['sauce']) . "</td>
                                <td>RS." . htmlspecialchars($row['total_price']) . "</td>
                                <td>" . htmlspecialchars($row['payment_method']) . "</td>
                                <td>
                                    <!-- Button to trigger modal -->
                                    <button type='button' class='btn btn-info' data-bs-toggle='modal' data-bs-target='#orderModal" . $row['id'] . "'>View</button>
                                    <!-- Modal -->
                                    <div class='modal fade' id='orderModal" . $row['id'] . "' tabindex='-1' aria-labelledby='orderModalLabel" . $row['id'] . "' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='orderModalLabel" . $row['id'] . "'>Order Details #" . $row['id'] . "</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <div class='modal-body'>
                                                    <p><strong>Date:</strong> " . htmlspecialchars($row['order_date']) . "</p>
                                                    <p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>
                                                    <p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>
                                                    <p><strong>Phone:</strong> " . htmlspecialchars($row['phone']) . "</p>
                                                    <p><strong>Address:</strong> " . htmlspecialchars($row['address']) . "</p>
                                                    <p><strong>Product Name:</strong> " . htmlspecialchars($row['product_name']) . "</p>
                                                    <p><strong>Quantity:</strong> " . htmlspecialchars($row['quantity']) . "</p>
                                                    <p><strong>Price:</strong> RS." . htmlspecialchars($row['price']) . "</p>
                                                    <p><strong>Sauce:</strong> " . htmlspecialchars($row['sauce']) . "</p>
                                                    <p><strong>Total Price:</strong> RS." . htmlspecialchars($row['total_price']) . "</p>
                                                    <p><strong>Payment Method:</strong> " . htmlspecialchars($row['payment_method']) . "</p>
                                                </div>
                                                <div class='modal-footer'>
                                                    <form method='POST' action='admin.php'>
                                                        <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                                        <button type='submit' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</button>
                                                    </form>
                                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php mysqli_close($conn); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
