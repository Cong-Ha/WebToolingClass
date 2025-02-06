<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <div class="container mt-3">
            <h2>Customer Info</h2>
            <a href="create.php" class="btn btn-success float-end">Add Customer Info</a>
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Customer Id</th>
                    <th>Customer Name</th>
                    <th>Contact Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Postal Code</th>
                    <th>Country</th>
                    <th>Action</th>
                </tr>
                </thead>
                <?php 
                    //include databse connection
                    include "config/dbConfig.php";
                    
                    //select  data
                    $query = "SELECT Id, CustomerName, ContactName, Address, City, PostalCode, Country FROM customerinfo";

                    //prepare query statement
                    $stmt = $conn->prepare($query);

                    //execute query
                    $stmt->execute();
                    
                    //get number of rows
                    //$num=$stmt->rowCount();
                    //echo $num;

                    
    
                ?>
                <tbody>
                    <?php 
                      while ($row = $stmt->fetch((PDO::FETCH_ASSOC))) 
                      {
                          extract($row);
                          //echo "id = {$Id}";
                      

                        echo"<tr>";
                            echo"<td>{$Id}</td>";
                            echo"<td>{$CustomerName}</td>";
                            echo"<td>{$ContactName}</td>";
                            echo"<td>{$Address}</td>";
                            echo"<td>{$City}</td>";
                            echo"<td>{$PostalCode}</td>";
                            echo"<td>{$Country}</td>";
                            echo"<td>";
                                echo'<button type="button" class="btn btn-primary btn-sm">Add</button>';    
                                echo'<button type="button" class="btn btn-warning btn-sm">Edit</button>';
                                echo'<button type="button" class="btn btn-danger btn-sm">Del</button>';
                            echo"</td>";
                        echo"</tr>";
                      }
                    ?>

                </tbody>
            </table>
        </div>
    </body>
</html>