<?php
// Include config file
require_once "config.php";


// Define variables and initialize with empty values
$qntype_name = "";

$qntype_name_err = "";


// Processing form data when form is submitted
if(isset($_POST["qntype_id"]) && !empty($_POST["qntype_id"])){
    // Get hidden input value
    $qntype_id = $_POST["qntype_id"];

    $qntype_name = trim($_POST["qntype_name"]);
		

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

    $vars = parse_columns('questiontype', $_POST);
    $stmt = $pdo->prepare("UPDATE questiontype SET qntype_name=? WHERE qntype_id=?");

    if(!$stmt->execute([ $qntype_name,$qntype_id  ])) {
        echo "Something went wrong. Please try again later.";
        header("location: error.php");
    } else {
        $stmt = null;
        //header("location: questiontype-read.php?qntype_id=$qntype_id");
		//praveen
		header("location: questiontype-index.php");
    }
} else {
    // Check existence of id parameter before processing further
	$_GET["qntype_id"] = trim($_GET["qntype_id"]);
    if(isset($_GET["qntype_id"]) && !empty($_GET["qntype_id"])){
        // Get URL parameter
        $qntype_id =  trim($_GET["qntype_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM questiontype WHERE qntype_id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Set parameters
            $param_id = $qntype_id;

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

                    $qntype_name = $row["qntype_name"];
					

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
				  	<
				  		
                     <section class="pt-5">
        <div class="container-fluid">
            <div class="row">

                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="qntype_name" maxlength="100"class="form-control" value="<?php echo $qntype_name; ?>">
                                <span class="form-text"><?php echo $qntype_name_err; ?></span>
                            </div>

                        <input type="hidden" name="qntype_id" value="<?php echo $qntype_id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="questiontype-index.php" class="btn btn-secondary">Cancel</a>
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

