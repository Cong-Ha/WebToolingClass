<?php
    try
    {
        //include database connection
        include "config/dbConfig.php";

        $id = isset($_GET['id']) ? $_GET['id'] : die("Id not found.");
        
        //delete query
        $query = "DELETE FROM customerinfo WHERE Id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);

        if ($stmt->execute()){
            header("Location: index.php");
        }
    }
    catch(PDOException $e) 
    {
        echo "Error : " .$e->getMessage();
    }
?>