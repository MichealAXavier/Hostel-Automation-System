<?php
include("../dbconnect.php");
session_start();

// Check if the user is logged in
if (!isset($_SESSION["reg"])) {
    header("Location: ../stud_login.php"); 
    exit();
}

// Check if the ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the ID
    $id = mysqli_real_escape_string($connect, $_GET['id']);
    
    // Query to fetch the payment details based on the provided ID
    $query = "SELECT * FROM amnt WHERE id = '$id'";
    $result = mysqli_query($connect, $query);

    // Check if the payment record exists
    if(mysqli_num_rows($result) > 0) {
        // Fetch the payment details
        $payment = mysqli_fetch_assoc($result);
        
        // Set the payment date to today's date
        $payment_date = date('Y-m-d');
        
        // Update the payment details with the payment date
        $payment['paid_date'] = $payment_date;

        // Display the receipt
        ?>
        
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Receipt</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    margin: 0;
                    padding: 20px;
                    background-color: #f0f0f0;
                }
                .container {
                    max-width: 800px;
                    margin: auto;
                    padding: 20px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #fff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                h1, h2, h3 {
                    margin-top: 0;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                }
                th, td {
                    padding: 8px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th {
                    background-color: #f2f2f2;
                }
                .print-button {
                    text-align: center;
                    margin-top: 20px;
                }
                .print-button button {
                    padding: 10px 20px;
                    background-color: #4caf50;
                    color: #fff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    font-size: 16px;
                    transition: background-color 0.3s;
                }
                .print-button button:hover {
                    background-color: #45a049;
                }
                .payment-details {
                    margin-bottom: 20px;
                }
                @media print {
                    body * {
                        visibility: hidden;
                    }
                    .container, .container * {
                        visibility: visible;
                    }
                    .container {
                        position: absolute;
                        left: 0;
                        top: 0;
                    }
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Receipt for Payment ID: <?php echo $payment['id']; ?></h1>
                <div class="payment-details">
                    <p><strong>Registration Number:</strong> <?php echo $payment['reg']; ?></p>
                    <p><strong>Name:</strong> <?php echo $payment['name']; ?></p>
                </div>
                <table>
                    <tr>
                        <th>Mess Fees:</th>
                        <td>RS. <?php echo $payment['mess_fees']; ?></td>
                    </tr>
                    <tr>
                        <th>Electricity Charges:</th>
                        <td>RS. <?php echo $payment['electricity_charges']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Fees:</th>
                        <td>RS. <?php echo $payment['total_fees']; ?></td>
                    </tr>
                    <tr>
                        <th>Month:</th>
                        <td><?php echo $payment['month']; ?></td>
                    </tr>
                    <tr>
                        <th>Paid Date:</th>
                        <td><?php echo $payment['paid_date']; ?></td>
                    </tr>
                    <!-- Add more payment details here if needed -->
                </table>
                <!-- You can add more sections to the receipt as needed -->
                <div class="print-button">
                    <button onclick="window.print()">Print Receipt</button>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        // Payment record not found
        echo "Payment record not found.";
    }
} else {
    // ID parameter not provided in the URL
    echo "Error: Payment ID not provided.";
}
?>
