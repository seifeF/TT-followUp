<?php
$msg = "";
require_once('connection.php'); 
if(isset($_POST['save_tt']))
{
	$tt = $_POST['tt'];
	$id = $_POST['name'];
	$by = $_SESSION['userID'];
	
	$usersQuery2 = "SELECT * FROM tt where tt = '$tt'";
	$usersResult2=mysqli_query($conn,$usersQuery2);
	if($rowUser2 = mysqli_fetch_array($usersResult2)){ 
		$msg = "TT Already Exists";
	}else{
	
	$usersQuery3 = "SELECT * FROM branchs WHERE id='$id'";
	$usersResult3=mysqli_query($conn,$usersQuery3);
	$time = time();
	if($rowUser3 = mysqli_fetch_array($usersResult3)){ 
		$sql = "INSERT INTO tt (tt,branch,reg_date,reg_by)
		VALUES ('$tt',$id,'$time', '$by')";

		if ($conn->query($sql) === TRUE) {
			$page = $_SERVER['PHP_SELF'];
			$sec = "0";
			header("Refresh: $sec; url=$page");
			$msg = "TT Registered";
		} else {
			$msg = "Something went wrong";
		}
	
	}
	
	}
	
	

}
?>
<?php echo @$msg;?>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="" method="POST">
      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label">Branch</label>
        <select
          type="text"
          name="name"
          id="name"
          placeholder="Branch name"
          class="formbold-form-input"required
        >
		<?php
		require_once('connection.php'); 
$usersQuery = "SELECT * FROM branchs ORDER BY name ASC";
$usersResult=mysqli_query($conn,$usersQuery);
while($rowUser = mysqli_fetch_array($usersResult)){ 

		?>
		 <option value="<?php echo $rowUser["id"]; ?>"><?php echo $rowUser["name"]; ?></option>

		<?php
}
?>
		</select>
      </div>

      <div class="formbold-mb-5">
        <label for="lan" class="formbold-form-label">TT Number</label>
        <input
          type="text"
          name="tt"
          id="name"
          placeholder="TT"
          class="formbold-form-input"required
        />
      </div>


      <div>
        <button name="save_tt" class="formbold-btn">Save</button>
      </div>
    </form>
  </div>
</div>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: "Inter", sans-serif;
  }
  .formbold-mb-5 {
    margin-bottom: 20px;
  }
  .formbold-pt-3 {
    padding-top: 12px;
  }
  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 48px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 550px;
    width: 100%;
  }
  .formbold-form-label {
    display: block;
    font-weight: 500;
    font-size: 16px;
    color: #07074d;
    margin-bottom: 12px;
  }
  .formbold-form-label-2 {
    font-weight: 600;
    font-size: 20px;
    margin-bottom: 20px;
  }

  .formbold-form-input {
    width: 100%;
    padding: 12px 24px;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
    font-weight: 500;
    font-size: 16px;
    color: #6b7280;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #283897;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold-btn {
    text-align: center;
    font-size: 16px;
    border-radius: 6px;
    padding: 14px 32px;
    border: none;
    font-weight: 600;
    background-color: #283897;
    color: white;
    cursor: pointer;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }

  .formbold--mx-3 {
    margin-left: -12px;
    margin-right: -12px;
  }
  .formbold-px-3 {
    padding-left: 12px;
    padding-right: 12px;
  }
  .flex {
    display: flex;
  }
  .flex-wrap {
    flex-wrap: wrap;
  }
  .w-full {
    width: 100%;
  }
  @media (min-width: 540px) {
    .sm\:w-half {
      width: 50%;
    }
  }
</style>