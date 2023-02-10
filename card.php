    <?php
    include_once('db.php');
    $sql = "SELECT * FROM holder WHERE verification_code='".$_GET['code']."'";
    $result = $conn->query($sql);
    $message='';
    $name= '';
        $image= '';
        $link= '';
        $designation='';
        $code= '';
    $branch= '';
    $gender = '';
    $exp='';
        $ppta='';
    $iss = '';
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name= $row['fullname'];
        $image= $row['image'];
        $link= $row['verify_link'];
    $branch = $row['branch'];
    $exp = $row['expiry'];
    $iss = $row['issued'];
    $gender = $row['gender'];
        $designation=$row['designation'];
        $code= $row['verification_code'];
         $ppta= $row['PPTMA'];
    } else {
    $message= "No Card Holder Found";
    }




    echo '
    <body style="width:100vw;margin:0;padding:0;height:100vh;">

    <div style="width:70vw;margin:0;padding:0; height:97vh;background-image:url(./photo/card.jpg);background-size:cover; ">
    <img style="float:right;height:210px;margin-top:180px;margin-right:15px;" src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https://verifyme.com.ng/detail.php?link='.$link.'" title="Link to VerifyMe" />
    <img style="position:absolute;width:260px;top:195px;height:340px;left:60px;" src="'.$image.'" />
    <span style="position:fixed;right:540px;top:180px;"><b>'.$code.'</b> </span>
    <span style="position:fixed;right:500px;bottom:80px;font-size:x-large;"><b><i>'.$iss.' <br> '.$exp.' </i></b> </span>
    <span style="position:fixed;right:485px;bottom:150px;font-size:x-large;"><b>'.$ppta.'</b> </span>
  
    <br>
    <br>


    <br>
    <br>


    <br>
    <br><br>

    <br><br>

    <br>
    <strong style="width:100%;padding-left:165px;text-transform:uppercase;font-size:x-large;"> </strong>

    <br>
    <br>

    <strong style="width:100%;padding-left:360px;text-transform:uppercase;font-size:x-large">'.$name.' '.$message.' </strong>

    <br>
    <br>
    <br>
    <div  style="height:5px"></div>
    <strong style="width:100%;padding-left:360px;text-transform:uppercase;font-size:x-large">'. $designation.'</strong>
    <br>
    <br>
    <br>
    <br>
    <div  style="height:3px"></div>
    <strong style="width:100%;padding-left:360px;text-transform:uppercase;font-size:x-large">'.$branch.'  </strong>
    <br>

    <br>
    <br>

    <div  style="height:3px"></div>
    <strong style="width:100%;padding-left:360px;text-transform:uppercase;font-size:x-large">'.$gender.'</strong>


    </div>
    </body>
    '



    ?>