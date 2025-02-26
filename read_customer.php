<?php
include("config/dbConfig.php");
if(isset($_GET['id'])) {
    $customerId = $_GET['id'];
    $query = "SELECT * FROM customerinfo WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(1, $customerId, PDO::PARAM_INT);
    $stmt->execute();

    if($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p><strong>Customer Name: </strong>" .htmlspecialchars($row['CustomerName']) . "</p>";
        echo "<p><strong>Contact Name: </strong>" .htmlspecialchars($row['ContactName']) . "</p>";
        echo "<p><strong>Address: </strong>" .htmlspecialchars($row['Address']) . "</p>";
        echo "<p><strong>City: </strong>" .htmlspecialchars($row['City']) . "</p>";
        echo "<p><strong>Postal Code: </strong>" .htmlspecialchars($row['PostalCode']) . "</p>";
        echo "<p><strong>Country: </strong>" .htmlspecialchars($row['Country']) . "</p>";
    }
    else 
    {
        echo "<p class='text-danger'>Customer not found!</p>";
    }    
}
else
{
    echo "<p class='text-danger'>Invalid request!</p>";
}
?>