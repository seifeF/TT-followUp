<?php
$msg = "";
require_once('connection.php'); 
if(isset($_POST['save_user']))
{
	$name = $_POST['name'];
	$pass = $_POST['password'];
	$type = $_POST['type'];
	
	$hash = password_hash($pass, 
          PASSWORD_DEFAULT);
	
	$usersQuery2 = "SELECT * FROM user where username = '$name'";
	$usersResult2=mysqli_query($conn,$usersQuery2);
	if($rowUser2 = mysqli_fetch_array($usersResult2)){ 
		$msg = "User Already Exists";
	}else{
	
		$sql = "INSERT INTO user (username,password,userType)
		VALUES ('$name','$hash','$type')";

		if ($conn->query($sql) === TRUE) {
			$page = $_SERVER['PHP_SELF'];
			$sec = "0";
			header("Refresh: $sec; url=$page");
			$msg = "User Registered";
		} else {
			$msg = "Something went wrong";
		}
	
	}
	
	
	
	

}
?>
<?php echo @$msg;?>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="" method="POST">
	<div class="formbold-mb-5">
        <label for="lan" class="formbold-form-label">Username</label>
        <input
          type="text"
          name="name"
          id="name"
          placeholder="username"
          class="formbold-form-input"required
        />
      </div>
	  <div class="formbold-mb-5">
        <label for="lan" class="formbold-form-label">Password</label>
        <input
          type="text"
          name="password"
          id="name"
          placeholder="Password"
          class="formbold-form-input"required
        />
      </div>
      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label">User Type</label>
        <select
          type="text"
          name="type"
          id="name"
          placeholder="Branch name"
          class="formbold-form-input"required
        >
		
		 <option value="0">User</option>
		 <option value="1">Admin</option>

		</select>
      </div>

     


      <div>
        <button name="save_user" class="formbold-btn">Register</button>
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