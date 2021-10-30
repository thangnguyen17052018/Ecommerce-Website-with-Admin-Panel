<?php 
    include_once "config.php"; //import file php config.php vào file hiện tại
    $query2 = mysqli_query($conn, "SELECT * 
                                   FROM NhanVien 
                                   ORDER BY CAST(SUBSTRING(MSNV, 3, LENGTH(MSNV)) AS INT) 
                                   DESC LIMIT 1;
                        ");
    $row2 = mysqli_fetch_assoc($query2);
    $lastID = $row2['MSNV'];
    if ($lastID == ""){
        $empID = "NV1";
    } else {
        $empID = substr($lastID, 2);
        $empID = intval($empID);
        $empID = "NV".($empID + 1);
    }
    echo $empID;
    /* <?php echo $empID; ?> */
?>

