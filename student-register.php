<?php
// Include config file
require_once "config.php";
require_once "helpers.php";

// Define variables and initialize with empty values
$student_name = "";
$student_contact = "";
$student_email = "";
$student_gender = "";
$student_photo = "";
$student_regno = "";
$student_dob = "";
$student_isactive = "";
$dept_id = "";
$username = "";
$password = "";
$password2 = "";

$student_name_err = "";
$student_contact_err = "";
$student_email_err = "";
$student_gender_err = "";
$student_photo_err = "";
$student_regno_err = "";
$student_dob_err = "";
$student_isactive_err = "";
$dept_id_err = "";
$username_err = "";
$password_err = "";
$password2_err = "";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
        $student_name = trim($_POST["student_name"]);
		$student_contact = trim($_POST["student_contact"]);
		$student_email = trim($_POST["student_email"]);
		$student_gender = trim($_POST["student_gender"]);
		$student_regno = trim($_POST["student_regno"]);
		$student_dob = trim($_POST["student_dob"]);
		$student_isactive = trim($_POST["student_isactive"]);
		$dept_id = trim($_POST["dept_id"]);
				$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
		$password2 = trim($_POST["password2"]);
	 $prod_img= basename($_FILES["student_photo"]["name"]);
	 if($password==$password2)
	 {

      $ext = pathinfo( $prod_img, PATHINFO_EXTENSION);
	$fnn=date("YmdHis").".".$ext;
	 $target_dir = "uploads/";
      // $target_file = $target_dir . basename($_FILES["file1"]["name"]);
      $target_file = $target_dir.$fnn;
      if (move_uploaded_file($_FILES["student_photo"]["tmp_name"], $target_file)) {
          // echo "The file ". htmlspecialchars( basename( $_FILES["file1"]["name"])). " has been uploaded.";
          // echo "<script>alert('ok')</script>";
        }
        else
        {
          // echo "<script>alert('error')</script>";
        }

		

        $dsn = "mysql:host=$db_server;dbname=$db_name;charset=utf8mb4";
        $options = [
          PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
          PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];
        try {
          $pdo = new PDO($dsn, $db_user, $db_password, $options);
        } catch (Exception $e) {
          error_log($e->getMessage());
          exit('Something weird happened'); //something a user can understand
        }

        $vars = parse_columns('student', $_POST);
        $stmt = $pdo->prepare("INSERT INTO student (student_name,student_contact,student_email,student_gender,student_photo,student_regno,student_dob,student_isactive,dept_id,username,password) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        if($stmt->execute([ $student_name,$student_contact,$student_email,$student_gender,$target_file ,$student_regno,$student_dob,$student_isactive,$dept_id,$username,$password  ])) 
		{
                $stmt = null;
              // header("location: login1.php");
			 //echo $target_file;
			 ?>
			 <script>alert("Student registered , please wait for admin's approval !!");
			 window.location="login1.php";
			 </script>
			 
			 <?php
			 
            } else{
                echo "Something went wrong. Please try again later.";
            }
	 }
	 else
	 {echo "Password Mismatch!";}

}
?>

<!DOCTYPE HTML>
<html>
	<head>
	<title></title>
		<link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6b773fe9e4.js" crossorigin="anonymous"></script>
    <style type="text/css">
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 5px;
        }
        body {
            font-size: 14px;
        }
    </style>
	</head>
	<body>
		<!---start-wrap--->
		<div class="wrap">
			<!---start-header--->
			<div class="header">
				<!---start-logo--->
				<div class="logo">
					<a href="index.html"><img src="images/logo.png" /></a>
				</div>
				<!---start-logo--->
				<!---start-top-nav--->
<?php include("public_menu.php");?>
				<div class="clear"> </div>
				<!---End-top-nav--->
			</div>
		</div>
			<!---End-header--->
		<!---start-content---->
		<div class="wrap">
		<div class="content">
			<div class="clear"> </div>
			<div class="contact">
				<div class="project-top-patination">
								<ul>
									<!-- <li><a href="index.html">Mainpage</a></li>
									<li><p>Contact</p></li> -->
								</ul>
							</div>
				<div class="section group">				
				<div class="col span_1_of_3">
					<div class="contact_info">
			    	 	<!-- <h3>Find Us Here</h3> -->
			    	 		<!-- <div class="map">
					   			<iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:12px">View Larger Map</a></small>
					   		</div> -->
      				</div>
      			<div class="company_address">
				     	<!-- <h3>Company Information :</h3>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@mycompany.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p> -->
				   </div>
				</div>				
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h3></h3>
				  		
                     <section class="pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="float-left">Add Student</h2>
                      

                    </div>


                        
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="student_name" maxlength="100"class="form-control" required value="<?php echo $student_name; ?>">
                                <span class="form-text"><?php echo $student_name_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="student_contact" maxlength="100"class="form-control" required  value="<?php echo $student_contact; ?>">
                                <span class="form-text"><?php echo $student_contact_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Email</label>
                                <input type="email" name="student_email" maxlength="100"class="form-control" required  value="<?php echo $student_email; ?>">
                                <span class="form-text"><?php echo $student_email_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Gender</label>
							<select name="student_gender">
							<option value="Male">Male</option><option value="Female">Female</option>
							</select>
                                
                            </div>
						<div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="student_photo" required >
                             
                            </div>
						<div class="form-group">
                                <label>Reg No</label>
                                <input type="text" name="student_regno" maxlength="100"class="form-control" required  value="<?php echo $student_regno; ?>">
                                <span class="form-text"><?php echo $student_regno_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>DOB</label>
                                <input type="date" name="student_dob"  required value="<?php echo $student_dob; ?>">
                                <span class="form-text"><?php echo $student_dob_err; ?></span>
                            </div>
						
						<div class="form-group">
                                
                                
                                <input type="hidden" name="student_isactive" value="No">
						
                            </div>
						<div class="form-group">
                                <label>Department</label>
                                    <select class="form-control" id="dept_id" name="dept_id">
                                    <?php
                                        $sql = "SELECT *,dept_id FROM department";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                         //   array_pop($row);
                                            $value = $row['dept_name'];
                                            if ($row["dept_id"] == $dept_id){
                                            echo '<option value="' . "$row[dept_id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[dept_id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $dept_id_err; ?></span>
                            </div>
								<div class="form-group">
                                <label>Username</label>
                                <input type="text" required placeholder="Username" name="username" maxlength="20"class="form-control" value="<?php echo $username; ?>">
                                <span class="form-text"><?php echo $username_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Password</label>
                                <input type="password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Must contain Minimum eight characters, at least one letter and one number" name="password" class="form-control" value="<?php echo $password; ?>">
                               
                            </div>
							<div class="form-group">
                                <label>Retype Password</label>
                                <input type="password" placeholder="Password" required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" title="Must contain Minimum eight characters, at least one letter and one number" name="password2" class="form-control" value="<?php echo $password2; ?>">

                            </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="login1.php" class="btn btn-secondary">Cancel</a>
                    </form>


                </div>
            </div>
        </div>
    </section>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

				    </div>
  				</div>				
			  </div>
			</div>
			<div class="clear"> </div>
			<div class="footer">
				<div class="footer-left">
					<!-- <a href="#"><img src="images/logo1.png" title="logo" /></a> -->
				</div>
				<div class="footer-right">
					<!-- <p>Design by <a href="http://w3layouts.com/">W3layouts</a></p> -->
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		<!---End-content---->
		</div>
		<!---start-wrap--->
	</body>
</html>

