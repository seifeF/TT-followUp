<?php
$msg = "";
require_once('connection.php'); 
if(isset($_POST['save']))
{
	$name = $_POST['name'];
	$lan = $_POST['lan'];
	$wan = $_POST['wan'];
	$service = $_POST['service'];
	
	
	
$sql = "INSERT INTO branchs (name, lan, wan,sn)
VALUES ('$name', '$lan', '$wan','$service')";

if ($conn->query($sql) === TRUE) {
  $msg = "Branch Added";
} else {
  $msg = "Something went wrong";
}
}
?>
<?php echo @$msg;?>
<div class="formbold-main-wrapper">
  <div class="formbold-form-wrapper">
    <form action="" method="POST">
      <div class="formbold-mb-5">
        <label for="name" class="formbold-form-label">Branch Name</label>
        <input
          type="text"
          name="name"
          id="name"
          placeholder="Branch name"
          class="formbold-form-input"required
        />
      </div>

      <div class="formbold-mb-5">
        <label for="lan" class="formbold-form-label">LAN IP Address</label>
        <input
          type="text"
          name="lan"
          id="name"
          placeholder="LAN IP"
          class="formbold-form-input"required
        />
      </div>

      <div class="formbold-mb-5">
        <label for="wan" class="formbold-form-label">WAN IP Address</label>
        <input
          type="text"
          name="wan"
          id="name"
          placeholder="WAN IP"
          class="formbold-form-input"required
        />
      </div>

      <div class="formbold-mb-5">
        <label for="service" class="formbold-form-label">Service Number</label>
        <input
          type="text"
          name="service"
          id="service"
          placeholder="Service NO"
          class="formbold-form-input"required
        />
      </div>

      <div>
        <button name="save" class="formbold-btn">Save</button>
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