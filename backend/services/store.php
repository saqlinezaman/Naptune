<?php
include '../../config/database.php';

session_start();
if(isset($_POST['insert'])){
    $titel = $_POST['titel'];
    $descryption = $_POST['descryption'];
    $icon = $_POST['icon'];


    if( $titel && $descryption && $icon){
        $query = " INSERT INTO services (titel,descryption,icon) VALUES ('$titel','$descryption','$icon')";
        mysqli_query($db , $query );
        $_SESSION ['service_insert'] = 'Service insert successfully';
        header('location: services.php');

    }else{
        header('location: create.php');
    }
}


if(isset($_GET['statusid'])){
    $id = $_GET['statusid'];

    $getQuery = "SELECT * FROM services WHERE id='$id'";
    $connect = mysqli_query($db,$getQuery);
    $service = mysqli_fetch_assoc($connect);


    if($service['status'] == 'deactive'){
        $update_query = "UPDATE services SET status='active' WHERE id='$id'";
        mysqli_query($db,$update_query);
        $_SESSION['service_status'] = "Service Status Successfully Complete"; 
        header('location: services.php');
    }else{
        $update_query = "UPDATE services SET status='deactive' WHERE id='$id'";
        mysqli_query($db,$update_query);
        $_SESSION['service_status'] = "Service Status Successfully Complete"; 
        header('location: services.php');
    }
}

// update
if(isset($_POST['update'])){
    if(isset($_GET['update'])){
        $id = $_GET['update'];
        $titel = $_POST['titel'];
        $descryption = $_POST['descryption'];
        $icon = $_POST['icon'];
    
        if($titel && $descryption && $icon){
            $query_update = "UPDATE services SET titel='$titel',descryption='$descryption',icon='$icon' WHERE id='$id'";
            mysqli_query($db,$query_update);
            $_SESSION['service_edit'] = "Service Update Successfully Complete"; 
            header('location: services.php');
        }
    
    }
}
if(isset($_GET['deleteid'])){ 
    $id = $_GET['deleteid'] ;
    $delete_query = "DELETE FROM services WHERE id='$id'";
    mysqli_query($db,$delete_query);
    $_SESSION['service_delete'] = "Service Deleted Successfully"; 
    header('location: services.php');
}



// ?>