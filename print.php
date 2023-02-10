<?php
include_once('db.php');
$msg = '';
if(isset($_POST['holder'])){

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $designation = $_POST['designation'];
    $branch = $_POST['branch'];
    $ppta = $_POST['pptma'];
    $date_issued = $_POST['date_issued'];
    $date_expiry = $_POST['date_expiry'];
    $image = $_FILES['fileToUpload']['tmp_name'];
    $link = 'card_holder_HDSDY63872638628738UHUDH' . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);
    $vn = 'V'.mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);
    $date = date('d/m/y');

    $target_dir = "photo/";
    $target_file = $target_dir .''.$vn.'_'. basename($_FILES["fileToUpload"]["name"]);
    $check = "SELECT * FROM holder WHERE fullname='".$name."'";
 $cresult = $conn->query($check);
    if ($cresult->num_rows > 0) {
        echo 'Card Holder Already Exist';
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO `holder` (`id`, `verification_code`, `verify_link`, `date_created`, `expiry`, `issued`, `gender`, `designation`, `fullname`, `branch`, `image`, `PPTMA`) VALUES (NULL, '" . $vn . "', '" . $link . "', '" . $date . "', '" . $date_expiry . "', '" . $date_issued . "', '" . $gender . "', '" . $designation . "', '" . $name . "', '" . $branch . "', 'https://verifyme.com.ng/" .$target_file . "', '" . $ppta . "');";

            if ($conn->query($sql) === TRUE) {
                $msg= "New record created successfully for ".$vn."";
                header("Location: card.php?code=".$vn."");

            } else {
                echo "New record Failed!";

            }

        } else {
            echo "Image Upload Failed";
        }


    }

}













?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VerifyMe - Identity Verification System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm py-3 py-lg-0 px-3 px-lg-0">
        <a href="index.html" class="navbar-brand ms-lg-5">
            <h1 class="display-5 m-0 text-primary">Verify<span class="text-secondary">Me</span></h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="service.html" class="nav-item nav-link">Service</a>
              
                <a href="contact.html" class="nav-item nav-link">Contact</a>
                <a href="tel:+2348089657611" class="nav-item nav-link nav-contact bg-secondary text-white px-5 ms-lg-5"><i class="bi bi-telephone-outbound me-2"></i>+234 808 9657 611</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Team Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                <h5 class="text-primary text-uppercase" style="letter-spacing: 5px;">Generate Card</h5>
         
            </div>
            <div class="row g-5">
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                   
                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="position-relative rounded-top">
                    <span class="alert alert-info"><?php echo $msg; ?></span>
                    <div class="card padding">
                        <h3>Existing Card Holder</h3>
<form action="card.php" method="get">
<input placeholder="Verificattion Code" class="form-control" name="code" required />
<button type="submit" class="btn btn-primary">Generate</button>
</form>
                    </div>

                      <br><br><br>
                    <div class="card padding">
                        <h3>New Card Holder</h3>
                        <form action="" method="post" enctype="multipart/form-data">
<input placeholder="Fullname" class="form-control" name="name" required />
<select placeholder="Fullname" class="form-select" name="gender" required >
<option>
    Gender ....
</option>
<option value="Male">
    Male
</option>
<option value="Female">
    Female
</option>
</select>
<input placeholder="Designation" class="form-control" name="designation" required/>
<input placeholder="Branch" class="form-control" name="branch" required/>
<input placeholder="PPTMA" class="form-control" name="pptma" required/>
<label>
    Date Issued
</label>
<input placeholder="Date" class="form-control" type='date' name="date_issued" required />

<label>
    Expiry Date
</label>
<input placeholder="Date" class="form-control" type='date' name="date_expiry" required />

<label>
    Passport
</label>
<input placeholder="" class="form-control" type='file' name="fileToUpload" required />

<button type="submit" name='holder' class="btn btn-primary">Submit & Generate</button>
</form>
                    </div>





                    <br><br><br>
                    <div class="card padding">
                        <h3> Card Holders List</h3>
                        <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">VN</th>
      <th scope="col">Name</th>
      <th scope="col">Branch</th>
      <th scope="col">Action</th>
   
    </tr>
  </thead>
  <tbody>
    <?php 
$sql = "SELECT * FROM holder";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
            echo '
    <tr>
    <th scope="row">' . $row["verification_code"] . '</th>
    <td>' . $row["fullname"] . '</td>
    <td>' . $row["branch"] . '</td>
    <td><a href="https://verifyme.com.ng/card.php?code=' . $row["verification_code"] . '"> Open Card</a></td>
  </tr>';

  
  }
} else {
  echo "0 results";
}
$conn->close();


?>
   

</tbody>
</table>
                    </div>



                    </div>
                 


                </div>
                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                   
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Quick Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Popular Links</h3>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                        <a class="text-light mb-2" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Latest Blog</a>
                        <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Get In Touch</h3>
                    <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>24 Etagbo, Calabar</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>roicomsat@gmail.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>+234 808 9657 611</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">Follow Us</h3>
                    <div class="d-flex">
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                        <a class="btn btn-lg btn-primary btn-lg-square rounded" href="#"><i class="fab fa-instagram fw-normal"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <form class="mx-auto" style="max-width: 600px;">
                        <div class="input-group">
                            <input type="text" class="form-control border-white p-3" placeholder="Your Email">
                            <button class="btn btn-primary px-4">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-primary text-light py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white border-bottom" href="#">VerifyMe</a>. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Designed by <a class="text-white border-bottom" href="https://roicomsat.com">Roicomsat</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-secondary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>