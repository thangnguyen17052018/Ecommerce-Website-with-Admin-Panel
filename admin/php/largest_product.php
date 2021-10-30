<?php 
    include_once "config.php"; //import file php config.php vào file hiện tại
    $query2 = mysqli_query($conn, "SELECT * 
                                   FROM HangHoa 
                                   ORDER BY MSHH
                                   DESC LIMIT 1;
                        ");
    $row2 = mysqli_fetch_assoc($query2);
    $lastID = $row2['MSHH'];
    if ($lastID == ""){
        $productID = "HH1";
    } else {
        $productID = substr($lastID, 2);
        $productID = intval($productID);
        $productID = "HH".($productID + 1);
    }
    echo $productID;
?>

