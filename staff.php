<?php
include_once('db.php');

if(isset($_POST['staff'])){
    $image = $_FILES['file']['tmp_name'];

    $firstName=$_POST['firstName'];
    $surname=$_POST['surname'];
    $otherNames=$_POST['otherNames'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $maritalStatus=$_POST['maritalStatus'];
    $religion=$_POST['religion'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $lga=$_POST['lga'];
    $state=$_POST['state'];
    $accnumber=$_POST['accnumber'];
    $accname=$_POST['accname'];
    $bank=$_POST['bank'];
    $image=$_POST['image'];
    $guarantorimage=$_POST['guarantorimage'];
    $guarantorname=$_POST['guarantorname'];
    $guarantorphone=$_POST['guarantorphone'];

//    if($firstName=="" || $surname=="" || $gender=="" || $dob=="" || $phone =="" || $email==""){
//         echo "Supply all the required fields";
//     } else {
        $sql = "INSERT INTO `staff` (`id`, `date_created`, `salary`, `first_name`, `surname`, `other_names`, `image`, `Gender`, `dob`, `marital`, `religion`, `phone`, `email`, `address`, `lga`, `state`, `accno`, `accname`, `bank`, `guarantor_name`, `guarantor_phone`, `guarantor_image`) VALUES (NULL, 'date', 'NGN20,000', 'Emmanuel', 'Erim', 'Otioh', 'image', 'gender', 'dob', 'marital', 'religion', 'phone', 'email', 'address', 'lga', 'state', 'acno', 'acname', 'bank', 'guaran', 'guar-Phone', 'guar image');";
        if(mysqli_query($conn, $sql)){
            if(move_uploaded_file($image, './images/' . $surname . '' . $phone.'.jpg')){
                echo "Staff Posted";

            }
        }

       


    // }


}else{
    echo "No Post Request";
}


?>