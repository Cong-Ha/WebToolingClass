<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/Fetch-CustomerDetails.js"></script>
</head>
<body>
    <div class="container mt-3">
        <h3>Customer Info</h3>
        <button type="button" class="btn btn-success float-end mb-2" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
            Add Customer Info
        </button>
        <table class="table table-dark table-hover">
            <thead>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Contact Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Country</th>
                <th>Action</th>
            </thead>
            <tbody id="customerTable">
                <?php
                    include("config/dbConfig.php");
                    $query = "SELECT Id, CustomerName, ContactName, Address, City, PostalCode, Country FROM customerinfo";
                    $stmt = $conn->prepare($query);
                    $stmt->execute();

                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        echo"<tr>";
                            echo"<td>{$Id}</td>";
                            echo"<td>{$CustomerName}</td>";
                            echo"<td>{$ContactName}</td>";
                            echo"<td>{$Address}</td>";
                            echo"<td>{$City}</td>";
                            echo"<td>{$PostalCode}</td>";
                            echo"<td>{$Country}</td>";
                            echo"<td>";
                            echo"<button type='button' class='btn btn-primary btn-sm' onClick=readCustomer($Id) data-bs-toggle='modal' data-bs-target='#readCustomerModal'>Read</button>   
                                <button type='button' class='btn btn-warning btn-sm' onClick=editCustomer()>Edit</button>
                                <button type='button' class='btn btn-danger btn-sm' onClick=deleteCustomer()>Delete</button>";
                            echo"</td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Read Customer Modal -->
    <div class="modal fade" id="readCustomerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Customer Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="customerDetails">
                    Loading...
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Customer</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="form-group mt-2">
                        <label for="addCustomerName" aria-placeholder="Customer Name"></label>
                        <input type="text" id="addCustomerName" class="form-control" placeholder="Customer Name:">
                        <span id="customerNameError" class="text-danger"></span>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="form-group mt-2 mb-2 d-flex justify-content-center">
                    <button class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>