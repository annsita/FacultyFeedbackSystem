<?php
session_start();
if(isset($_POST["submit"])){
    // Include config file
    require_once "config.php";
	$rec=$_POST["rec_count"];
	$count=1;
	$score=0;
	
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

	while($rec>=$count)
	{
$excellent=0;
$good=0;
$fair=0;
$poor=0;
		$data=trim($_POST["qn".$count]);
		
$arr=explode("|",$data);
$score= $arr[0]+ $score;;
$state= $arr[1];
$qn_id=$arr[2];

echo "<br>state".$state;
echo "<br>question id".$qn_id;
if($state=="Poor")
{$poor=1;}
else if($state=="Excellent")
{$excellent=$excellent+1;}
else if($state=="Good")
{$good=1;}
else if($state=="Fair")
{$fair=1;}
	$count++;
	//INSERT INTO `type` (`type_id`, `f_id`, `q_id`, `excellent`, `good`, `fair`, `poor`) VALUES (NULL, '45', '7', '1', '0', '0', '0');
	$stmt = $pdo->prepare("INSERT INTO `type` (`f_id`, `q_id`, `excellent`, `good`, `fair`, `poor`) VALUES (?, ?, ?, ?, ?,?)");

        if($stmt->execute([ $_POST['fac_id'],$qn_id,$excellent,$good,$fair,$poor])) {
                $stmt = null;
	
	}
	
	
	}	
	
	
	
	
 $stmt = $pdo->prepare("INSERT INTO mark (fac_id,stud_id,mark) VALUES (?,?,?)");

        if($stmt->execute([ $_POST['fac_id'],$_SESSION['sid'],$score  ])) {
                $stmt = null;
			$mark=0;
			$sql2="SELECT * FROM mark where fac_id=".$_POST['fac_id'];
			if($result2 = mysqli_query($link, $sql2)){
										$no=mysqli_num_rows($result2 );
				
										if($no>0){
											while($row2 = mysqli_fetch_array($result2)){
											$mark=$row2['mark']+$mark;
											}
											$grade=$mark/$no;
											$sql5= "DELETE FROM result WHERE f_id=".$_POST['fac_id'];
											mysqli_query($link, $sql5);
											 $stmt = $pdo->prepare("INSERT INTO result (f_id,res_grade) VALUES (?,?)");

        if($stmt->execute([ $_POST['fac_id'],$grade ])) {
                $stmt = null;
                header("location: faculty-feed.php");
            }
			}
			}
		}
	
			
			
			

    

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);

			}


?>