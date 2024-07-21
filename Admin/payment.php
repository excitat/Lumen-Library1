<?php
include "connection.php";
include "navbar4.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];  // Captured from the form
    $bid = $_POST['bid'];            // Captured from the form
    $amount_paid = $_POST['amount_paid']; // Captured from the form

    // Get the current fine amount for the student and book from the fines table
    $result = mysqli_query($db, "SELECT fine FROM fines WHERE username='$username' AND bid='$bid'");
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $current_fine = $row['fine'];

        // Calculate the new fine amount
        $new_fine = $current_fine - $amount_paid;
        if ($new_fine <= 0) {
            $new_fine = 0;
            $status = "Paid";
        } else {
            $status = "Unpaid";
        }

        // Update the fine and status in the fines table
        mysqli_query($db, "UPDATE fines SET fine='$new_fine', status='$status' WHERE username='$username' AND bid='$bid'");

        echo "<h2> Payment successful. The new fine amount is $new_fine FCFA. </h2>";
    } else {
        echo "Error fetching the current fine amount.";
    }
} else {
    $username = $_GET['username'];
    $bid = $_GET['bid'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Enter Payment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            font-family: "Lato", sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Enter Payment</h2>
        <form method="post" action="payment.php">
            <input type="hidden" name="username" value="<?php echo $username; ?>">
            <input type="hidden" name="bid" value="<?php echo $bid; ?>">
            <div class="form-group">
                <label for="amount_paid">Amount Paid (in FCFA):</label>
                <input type="number" class="form-control" id="amount_paid" name="amount_paid" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</body>
</html>
