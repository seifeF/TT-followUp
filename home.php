<?php
session_start();
error_reporting(1);

if(empty($_SESSION['username']) or (empty($_SESSION['userID'])))
{
	header("location:index.php");
}
	
$userName = $_SESSION['username'];
$userID = $_SESSION['userID'];
$userType = $_SESSION['userID'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Network Tracking</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="home_css.css">
  <script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<style>
			.page {
				display: none;
			}

			.page-active {
				display: block;
			}
			dl {
				list-style-type: none;
			}

			dl li {
				text-decoration: none;
				color: black;
			}
		</style>
<script type="text/javascript">
 if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
			$(document).ready(function() {
				function onHash() {
					if(!window.location.hash) {
						return;
					}
					var name = window.location.hash.substr(1),
							el = document.getElementById('page-' + name);
				
					if(el) {					
						// remove current page's class
						document.getElementsByClassName('page-active')[0].className = 'page';
						// add new page's class
						el.className = 'page page-active';
					}
				};
			
				window.onhashchange = onHash;
				onHash();
			});
		</script>
</head>

<body>
  <nav>
    <div class="sidebar-top">
	<center>
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="assets/awashBlue.png" class="logo" style="width:80px;" alt="">
      <h3 class="hide"></h3>
	  </center>
    </div>
    <div class="search" style="background-color:#283897;height:10px;">
    </div>

	<div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="#dashboard" class="active" data-active="0">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span class="link hide">Active TT</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="#branch" data-active="1">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Branches</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="#newtt" data-active="2">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">New TT</span>
          </a>
        </li>
		<?php
		if($userType == "1")
		{
			?>
        <li class="tooltip-element" data-tooltip="3">
          <a href="#user" data-active="3">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">User Management</span>
          </a>
        </li>
		<?php
		}
		?>
        <div class="tooltip">
          <span class="show">Active TT</span>
          <span>Branches</span>
          <span>New TT</span>
		  <?php
		if($userType == "1")
		{
			?>
          <span>User Management</span>
		  <?php
		}
		?>
        </div>
      </ul>

     </div>

    
	
    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="./img/face-1.png" alt="">
          <div class="admin-info">
            <h3><?php echo $userName;?></h3>
			<?php
			if($userType == "1")
			{
				?>
            <h5>Admin</h5>
			<?php
			}else
			{
				?>
				<h5>User</h5>
				<?php
				
			}?>
			
          </div>
        </div>
        <a href="logout.php" class="log-out">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show"><?php echo $userName;?></span>
        <span>Logout</span>
      </div>
    </div>
  </nav>


  <main>
					<div class='page page-active' id='page-dashboard'>
							<?php 
							include("dashboard.php");
							?>
						</div>
						<div class='page' id='page-branch'>
							<?php 
							include("branch.php");
							?>
						</div>
						<div class='page' id='page-newtt'>
							<?php 
							include("newtt.php");
							?>
						</div>
						<div class='page' id='page-user'>
							<?php 
							include("user.php");
							?>
						</div>
						<div class='page' id='page-newBranch'>
							<?php 
							include("newBranch.php");
							?>
						</div>
    <p class="copyright">
      &copy; 2022 -  All Rights Reserved.
    </p>
  </main>

  <script src="app.js"></script>
</body>

</html>

<script>



const shrink_btn = document.querySelector(".shrink-btn");
const search = document.querySelector(".search");
const sidebar_links = document.querySelectorAll(".sidebar-links a");
const active_tab = document.querySelector(".active-tab");
const shortcuts = document.querySelector(".sidebar-links h4");
const tooltip_elements = document.querySelectorAll(".tooltip-element");

let activeIndex;

shrink_btn.addEventListener("click", () => {
  document.body.classList.toggle("shrink");
  setTimeout(moveActiveTab, 400);

  shrink_btn.classList.add("hovered");

  setTimeout(() => {
    shrink_btn.classList.remove("hovered");
  }, 500);
});

search.addEventListener("click", () => {
  document.body.classList.remove("shrink");
  search.lastElementChild.focus();
});

function moveActiveTab() {
  let topPosition = activeIndex * 58 + 2.5;

  if (activeIndex > 3) {
    topPosition += shortcuts.clientHeight;
  }

  active_tab.style.top = `${topPosition}px`;
}

function changeLink() {
  sidebar_links.forEach((sideLink) => sideLink.classList.remove("active"));
  this.classList.add("active");

  activeIndex = this.dataset.active;

  moveActiveTab();
}

sidebar_links.forEach((link) => link.addEventListener("click", changeLink));

function showTooltip() {
  let tooltip = this.parentNode.lastElementChild;
  let spans = tooltip.children;
  let tooltipIndex = this.dataset.tooltip;

  Array.from(spans).forEach((sp) => sp.classList.remove("show"));
  spans[tooltipIndex].classList.add("show");

  tooltip.style.top = `${(100 / (spans.length * 2)) * (tooltipIndex * 2 + 1)}%`;
}

tooltip_elements.forEach((elem) => {
  elem.addEventListener("mouseover", showTooltip);
});

</script>
