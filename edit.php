<?php
$msg = "";
$errors = [];

try
{
    //include database connection
    include "config/dbConfig.php";

    $id = isset($_GET['id']) ? $_GET['id'] : die("Id not found.");
    $query = "SELECT CustomerName, ContactName, Address, City, PostalCode, Country FROM customerinfo WHERE Id = ? LIMIT 0,1";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // echo "<pre>";
    // print_r($row);
    // echo "</pre>";
    $customerName = $row["CustomerName"];
    $contactName = $row["ContactName"];
    $address = $row["Address"];
    $city = $row["City"];
    $postalCode = $row["PostalCode"];
    $country = $row["Country"];


}
catch(PDOException $e) 
{
    echo "Error : " .$e->getMessage();
}


function sanitizeInput($data)
{
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = trim($data);

    return $data;
}

//validation function using regex
function validateInput($data, $patterns)
{
    return preg_match($patterns, $data);
}

$patterns = [
    "CustomerName" => "/^[a-zA-Z\s]{1,25}$/",      //only letters including uppercase & spaces, max 25 characters
    "ContactName" => "/^[a-zA-Z\s]{1,25}$/",      //only letters including uppercase & spaces, max 25 characters
    "Address" => "/^[a-zA-Z0-9\s,#.-]{1,200}$/", //only letters including uppercase, numbers, spaces, #, comma, dot, hyphen, max 200 characters
    "City" => "/^[a-zA-Z\s]{1,100}$/",          //only letters including uppercase & spaces, max 100 characters
    "PostalCode" => "/^[a-zA-Z0-9]{1,10}$/",   //only letters including uppercase, numbers, max 10 characters
    "Country" => "/^[a-zA-Z\s]{1,100}$/"      //only letters including uppercase & spaces, max 100 characters
];

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $CustomerName = sanitizeInput($_POST['CustomerName']);
    $ContactName = sanitizeInput($_POST['ContactName']);
    $Address = sanitizeInput($_POST['Address']);
    $City = sanitizeInput($_POST['City']);
    $PostalCode = sanitizeInput($_POST['PostalCode']);
    $Country = sanitizeInput($_POST['Country']);



    if(!validateInput($CustomerName, $patterns['CustomerName']))
    {
        $errors['CustomerName'] = "Invalid Customer Name (only letters including uppercase & spaces, max 25 characters).";
                
    }
    if(!validateInput($ContactName, $patterns['ContactName']))
    {
        $errors['ContactName'] = "Invalid Contact Name (only letters including uppercase & spaces, max 25 characters).";
                
    }
    if(!validateInput($Address, $patterns['Address']))
    {
        $errors['Address'] = "Invalid Address (letters, numbers, spaces, ',', '#', '.', '-').";
                
    }
    if(!validateInput($City, $patterns['City']))
    {
        $errors['City'] = "Invalid City Name (only letters & spaces, max 100 characters).";
                
    }
    if(!validateInput($PostalCode, $patterns['PostalCode']))
    {
        $errors['PostalCode'] = "Invalid Postal Code name (only alphanumeric, max 10 characters).";
                
    }
    if(!validateInput($Country, $patterns['Country']))
    {
        $errors['Country'] = "Invalid Country name (only alphanumeric, max 10 characters).";
                
    }

    // proceed if no validation errors
    if(empty($errors ))
    {
        try
        {
            // include database connection
            include "config/dbConfig.php";

            //insert query
            $query = "UPDATE customerinfo SET CustomerName = ?, ContactName = ?, Address = ?, City = ?, PostalCode = ?, Country = ? WHERE Id = ?";

            //prepare query for execution
            $stmt = $conn->prepare($query);

            // bind parameters
            $stmt->bindParam(1,$CustomerName);
            $stmt->bindParam(2,$ContactName);
            $stmt->bindParam(3,$Address);
            $stmt->bindParam(4,$City);
            $stmt->bindParam(5,$PostalCode);
            $stmt->bindParam(6,$Country);
            $stmt->bindParam(7,$id);


            //execute query
            if($stmt->execute()) {
                $msg = "<div class='alert alert-success'><strong>Record was updated!</strong></div>";
                header("Refresh:2");
                header("Location: index.php");
            }
            else {
                $msg = "<div class='alert alert-danger'><strong>Unable to update record!</strong></div>";
            }

        } 
        catch (Exception $e)
        {
            echo "Error: ". $e->getMessage();
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <body>
        <div class="container mt-5 mb-5 d-flex justify-content-center">
                <div class="card w-50">
                    <div class="card-body">
                        <!-- database access message -->
                        <?php echo $msg; ?>
                        <form action="#" method="POST">
                            <div class="form-group">
                                <!-- Customer Name -->
                                <div class="form-group mt-2">
                                    <label for="CustomerName" class="form-label">Customer Name:</label>
                                    <input type="text" class="form-control" name="CustomerName" id="CustomerName" maxlength="25" value="<?php echo $customerName ?>">
                                    <span class="text-danger"><?php echo $errors['CustomerName'] ?? ''; ?></span>
                                </div>

                                <!-- Contact Name -->
                                <div class="form-group mt-2">
                                    <label for="ContactName" class="form-label">Contact Name:</label>
                                    <input type="text" class="form-control" name="ContactName" id="ContactName" maxlength="25" value="<?php echo $contactName ?>">
                                    <span class="text-danger"><?php echo $errors['ContactName'] ?? ''; ?></span>
                                </div>

                                <!-- Address -->
                                <div class="form-group mt-2">
                                    <label for="Address" class="form-label">Address:</label>
                                    <input type="text" class="form-control" name="Address" id="Address" maxlength="200" value="<?php echo $address ?>">
                                    <span class="text-danger"><?php echo $errors['Address'] ?? ''; ?></span>
                                </div>

                                <!-- City -->
                                <div class="form-group mt-2">
                                    <label for="City" class="form-label">City:</label>
                                    <input type="text" class="form-control" name="City" id="City" maxlength="100" value="<?php echo $city ?>">
                                    <span class="text-danger"><?php echo $errors['City'] ?? ''; ?></span>
                                </div>

                                <!-- Postal Code -->
                                <div class="form-group mt-2">
                                    <label for="PostalCode" class="form-label">Postal Code:</label>
                                    <input type="text" class="form-control" name="PostalCode" id="PostalCode" maxlength="10" value="<?php echo $postalCode ?>">
                                    <span class="text-danger"><?php echo $errors['PostalCode'] ?? ''; ?></span>
                                </div>

                                <!-- Country -->
                                <div class="form-group mt-2">
                                    <label for="Country" class="form-label">Country:</label>
                                    <input type="text" class="form-control" name="Country" id="Country" maxlength="100" value="<?php echo $country ?>">
                                    <span class="text-danger"><?php echo $errors['Country'] ?? ''; ?></span>
                                </div>

                                <div class="form-group mt-2 d-flex justify-content-center">
                                    <button class="btn btn-primary">Add</button>
                                    <a href=index.php class="btn btn-danger ms-3">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
</html>