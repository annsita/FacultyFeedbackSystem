<?php
// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$f_name = "";
$f_email = "";
$f_gender = "";
$f_photo = "";
$f_username = "";
$f_password = "";
$f_isactive = "";
$f_grade = "";
$desig_id = "";
$dept_id = "";

$f_name_err = "";
$f_email_err = "";
$f_gender_err = "";
$f_photo_err = "";
$f_username_err = "";
$f_password_err = "";
$f_isactive_err = "";
$f_grade_err = "";
$desig_id_err = "";
$dept_id_err = "";


// Processing form data when form is submitted
if(isset($_POST["faculty_id"]) && !empty($_POST["faculty_id"])){
    // Get hidden input value
    $faculty_id = $_POST["faculty_id"];

    $f_name = trim($_POST["f_name"]);
		$f_email = trim($_POST["f_email"]);
		$f_gender = trim($_POST["f_gender"]);
		$f_photo = $_FILES["f_photo"];
		$f_username = trim($_POST["f_username"]);
		$f_password = trim($_POST["f_password"]);
		$f_isactive = trim($_POST["f_isactive"]);
		$f_grade = trim($_POST["f_grade"]);
		$desig_id = trim($_POST["desig_id"]);
		$dept_id = trim($_POST["dept_id"]);
		

    // Prepare an update statement
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
        exit('Something weird happened');
    }

    $vars = parse_columns('faculty', $_POST);
    $stmt = $pdo->prepare("UPDATE faculty SET f_name=?,f_email=?,f_gender=?,f_photo=?,f_username=?,f_password=?,f_isactive=?,f_grade=?,desig_id=?,dept_id=? WHERE faculty_id=?");

    if(!$stmt->execute([ $f_name,$f_email,$f_gender,prav_upload($f_photo),$f_username,$f_password,$f_isactive,$f_grade,$desig_id,$dept_id,$faculty_id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        //header("location: faculty-read.php?faculty_id=$faculty_id");
		//praveen
		header("location: faculty-index.php");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["faculty_id"] = trim($_GET["faculty_id"]);
    if(isset($_GET["faculty_id"]) && !empty($_GET["faculty_id"])){
        // Get URL parameter
        $faculty_id =  trim($_GET["faculty_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM faculty WHERE faculty_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $faculty_id;

            // Bind variables to the prepared statement as parameters
			if (is_int($param_id)) $__vartype = "i";
			elseif (is_string($param_id)) $__vartype = "s";
			elseif (is_numeric($param_id)) $__vartype = "d";
			else $__vartype = "b"; // blob
			mysqli_stmt_bind_param($stmt, $__vartype, $param_id);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value

                    $f_name = $row["f_name"];
					$f_email = $row["f_email"];
					$f_gender = $row["f_gender"];
					$f_photo = $row["f_photo"];
					$f_username = $row["f_username"];
					$f_password = $row["f_password"];
					$f_isactive = $row["f_isactive"];
					$f_grade = $row["f_grade"];
					$desig_id = $row["desig_id"];
					$dept_id = $row["dept_id"];
					

                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.<br>".$stmt->error;
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
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
<?php include("admin_menu.php");?>
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
								
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	
				  		
                     <section class="pt-5">
        <div class="container-fluid">
            <div class="row">

                        <h2>Update Faculty details</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="f_name" maxlength="100"class="form-control" value="<?php echo $f_name; ?>">
                                <span class="form-text"><?php echo $f_name_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Email</label>
								
                                 <input type="email" name="f_email" class="form-control" value="<?php echo $f_email; ?>">
                                <span class="form-text"><?php echo $f_email_err; ?></span>
                                
                            </div>
						<div class="form-group">
                                <label>Gender</label>
								
                                <select name="f_gender" class="form-control">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								</select>
                                <span class="form-text"><?php echo $f_gender_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Photo</label>
                                <input type="file" name="f_photo"  value="<?php echo $f_photo; ?>">
                                <span class="form-text"><?php echo $f_photo_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Username</label>
                                <input type="text" name="f_username" maxlength="100"class="form-control" value="<?php echo $f_username; ?>">
                                <span class="form-text"><?php echo $f_username_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Password</label>
                                <input type="password" name="f_password" class="form-control" value="<?php echo $f_password; ?>">
                                <span class="form-text"><?php echo $f_password_err; ?></span>
                            </div>
							
						<div class="form-group">
                                <label>Active?</label>
								<select name="f_isactive" class="form-control">
								<option value="1">Yes</option>
								<option value="0">NO</option>
								</select>
                               
                            </div>
						<div class="form-group">
                               
                                <input type="hidden" name="f_grade" maxlength="100"class="form-control" value="0">
                                <span class="form-text"><?php echo $f_grade_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Designation</label>
                                    <select class="form-control" id="desig_id" name="desig_id">
                                    <?php
                                        $sql = "SELECT *,desig_id FROM designaton";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                         
                                            $value = $row['desig_name'];
                                            if ($row["desig_id"] == $desig_id){
                                            echo '<option value="' . "$row[desig_id]" . '"selected="selected">' . "$value" . '</option>';
                                            } else {
                                                echo '<option value="' . "$row[desig_id]" . '">' . "$value" . '</option>';
                                        }
                                        }
                                    ?>
                                    </select>
                                <span class="form-text"><?php echo $desig_id_err; ?></span>
                            </div>
						<div class="form-group">
                                <label>Department </label>
                                    <select class="form-control" id="dept_id" name="dept_id">
                                    <?php
                                        $sql = "SELECT *,dept_id FROM department";
                                        $result = mysqli_query($link, $sql);
                                        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                            //array_pop($row);
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
                        <input type="hidden" name="faculty_id" value="<?php echo $faculty_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="faculty-index.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
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

