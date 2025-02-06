<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $CustomerName = $_POST['CustomerName'];
    $ContactName = $_POST['ContactName'];
    $Address = $_POST['Address'];
    $City = $_POST['City'];
    $PostalCode = $_POST['PostalCode'];
    $Country = $_POST['Country'];

    try
    {
        // include database connection
        include "config/dbConfig.php";

        //insert query
        $query = "INSERT INTO customerinfo SET CustomerName = ?, ContactName = ?, Address = ?, City = ?, PostalCode = ?, Country = ?";

        //prepare query for execution
        $stmt = $conn->prepare($query);


    } 
    catch (Exception $e)
    {
        echo "Error: ". $e->getMessage();
    }
}
?>


<html>
<head>
    <title>Create Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <body>
        <div class="container mt-5 mb-5 d-flex justify-content-center">
            <div class="card w-50">
                <div class="card-body">
                    <form action="#" method="POST">
                        <div class="form-group">
                            <!-- Customer Name -->
                            <div class="form-group mt-2">
                                <label for="CustomerName" class="form-label">Customer Name:</label>
                                <input type="text" class="form-control" name="CustomerName" id="CustomerName" maxlength="25" required>
                            </div>

                            <!-- Contact Name -->
                            <div class="form-group mt-2">
                                <label for="ContactName" class="form-label">Contact Name:</label>
                                <input type="text" class="form-control" name="ContactName" id="ContactName" maxlength="25" required>
                            </div>

                            <!-- Address -->
                            <div class="form-group mt-2">
                                <label for="Address" class="form-label">Address:</label>
                                <input type="text" class="form-control" name="Address" id="Address" maxlength="200" required>
                            </div>

                            <!-- City -->
                            <div class="form-group mt-2">
                                <label for="City" class="form-label">City:</label>
                                <input type="text" class="form-control" name="City" id="City" maxlength="100" required>
                            </div>

                            <!-- Postal Code -->
                            <div class="form-group mt-2">
                                <label for="PostalCode" class="form-label">Postal Code:</label>
                                <input type="text" class="form-control" name="PostalCode" id="PostalCode" maxlength="10" required>
                            </div>

                            <!-- Country -->
                            <div class="form-group mt-2">
                                <label for="Country" class="form-label">Country:</label>
                                <input type="text" class="form-control" name="Country" id="Country" maxlength="100" required>
                            </div>

                            <div class="form-group mt-2 d-flex justify-content-center">
                                <button class="btn btn-primary">Add</button>
                                <a href=index.php class="btn btn-danger ms-3">Cancel</a>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

