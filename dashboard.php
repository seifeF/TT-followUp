<style>
@import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700');

$base-spacing-unit: 24px;
$half-spacing-unit: $base-spacing-unit / 2;

$color-alpha: #1772FF;
$color-form-highlight: #EEEEEE;

*, *:before, *:after {
	box-sizing:border-box;
}

body {
	padding:$base-spacing-unit;
	font-family:'Source Sans Pro', sans-serif;
	margin:0;
}

h1,h2,h3,h4,h5,h6 {
	margin:0;
}

.container {
	
	margin-right:auto;
	margin-left:auto;
	display:flex;
	justify-content:center;
	align-items:center;
}

.table {
	width:100%;
	border:1px solid $color-form-highlight;
}

.table-header {
	display:flex;
	width:100%;
	background:#000;
	padding:($half-spacing-unit * 1.5) 0;
}

.table-row {
	display:flex;
	width:100%;
	padding:($half-spacing-unit * 1.5) 0;
	
	&:nth-of-type(odd) {
		background:$color-form-highlight;
	}
}

.table-data, .header__item {
	flex: 1 1 20%;
	text-align:center;
}

.header__item {
	text-transform:uppercase;
}

.filter__link {
	color:white;
	text-decoration: none;
	position:relative;
	display:inline-block;
	padding-left:$base-spacing-unit;
	padding-right:$base-spacing-unit;
	
	&::after {
		content:'';
		position:absolute;
		right:-($half-spacing-unit * 1.5);
		color:white;
		font-size:$half-spacing-unit;
		top: 50%;
		transform: translateY(-50%);
	}
	
	&.desc::after {
		content: '(desc)';
	}

	&.asc::after {
		content: '(asc)';
	}
	
}





</style>
<script type="text/javascript">
var properties = [
	'name',
	'wins',
	'draws',
	'losses',
	'total',
];

$.each( properties, function( i, val ) {
	
	var orderClass = '';

	$("#" + val).click(function(e){
		e.preventDefault();
		$('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
  		$(this).toggleClass('filter__link--active');
   		$('.filter__link').removeClass('asc desc');

   		if(orderClass == 'desc' || orderClass == '') {
    			$(this).addClass('asc');
    			orderClass = 'asc';
       	} else {
       		$(this).addClass('desc');
       		orderClass = 'desc';
       	}

		var parent = $(this).closest('.header__item');
    		var index = $(".header__item").index(parent);
		var $table = $('.table-content');
		var rows = $table.find('.table-row').get();
		var isSelected = $(this).hasClass('filter__link--active');
		var isNumber = $(this).hasClass('filter__link--number');
			
		rows.sort(function(a, b){

			var x = $(a).find('.table-data').eq(index).text();
    			var y = $(b).find('.table-data').eq(index).text();
				
			if(isNumber == true) {
    					
				if(isSelected) {
					return x - y;
				} else {
					return y - x;
				}

			} else {
			
				if(isSelected) {		
					if(x < y) return -1;
					if(x > y) return 1;
					return 0;
				} else {
					if(x > y) return -1;
					if(x < y) return 1;
					return 0;
				}
			}
    		});

		$.each(rows, function(index,row) {
			$table.append(row);
		});

		return false;
	});

});
</script>
<br/>
<h2>Active TT</h2>
<br/>
<a href="#newtt">Add New TT</a>
<br/>
<br/>

<div class="container">
	
	<div class="table">
		<div class="table-header">
			<div class="header__item"><a id="name" class="filter__link" href="#">Branch Name</a></div>
			<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">TT</a></div>
			<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">LAN</a></div>
			<div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">WAN</a></div>
			<div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">S/N</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Registered Date</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Registered By</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Action</a></div>
		</div>
		<?php
		require_once('connection.php'); 
$usersQuery = "SELECT * FROM tt WHERE status='0' ORDER BY id DESC";
$usersResult=mysqli_query($conn,$usersQuery);
$color = array("#cad0f3", "#d1d3db");
$i = 0;
while($rowUser = mysqli_fetch_array($usersResult)){ 
$bid = $rowUser["branch"];

$usersQuery2 = "SELECT * FROM branchs WHERE id='$bid'";
$usersResult2=mysqli_query($conn,$usersQuery2);
while($rowUser2 = mysqli_fetch_array($usersResult2)){ 
$userBy = $rowUser["reg_by"];
$usersQuery3 = "SELECT * FROM user WHERE id='$userBy'";
$usersResult3=mysqli_query($conn,$usersQuery3);
while($rowUser3 = mysqli_fetch_array($usersResult3)){ 

		?>
		<div class="table-content" style="background-color:<?php if ($i % 2 == 0) { echo $color['0'];}else{ echo $color['1']; }?>;min-height: 30px;">	
			<div class="table-row">		
				<div style="float: left; padding: 2px 2px 2px 2px;" class="table-data"><?php echo $rowUser2["name"]; ?></div>
				<div class="table-data"><?php echo $rowUser["tt"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["lan"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["wan"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["sn"]; ?></div>
				<div style="float: left; padding: 2px 2px 2px 2px;" class="table-data"><?php echo date('m/d/Y h:i:s',$rowUser["reg_date"]); ?></div>
				<div class="table-data"><?php echo $rowUser3["username"]; ?></div>
				<div class="table-data"><a onclick="return confirm('By Continuing you are resolving this TT')" href="resolve.php?id=<?php echo $rowUser['id'];?>">Resolved</a></div>
			</div>
		</div>	
		
		<?php
		$i++;
}
}
}
?>
	</div>
</div>

<br/>
<br/>
<br/>
<h4>Recently Resolved</h4>
<br/>
<div class="container">
	
	<div class="table">
		<div class="table-header">
			<div class="header__item"><a id="name" class="filter__link" href="#">Branch Name</a></div>
			<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">TT</a></div>
			<div class="header__item"><a id="wins" class="filter__link filter__link--number" href="#">LAN</a></div>
			<div class="header__item"><a id="draws" class="filter__link filter__link--number" href="#">WAN</a></div>
			<div class="header__item"><a id="losses" class="filter__link filter__link--number" href="#">S/N</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Registered Date</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Resolved Date</a></div>
			<div class="header__item"><a id="total" class="filter__link filter__link--number" href="#">Registered By</a></div>
		</div>
		<?php
		require_once('connection.php'); 
$usersQuery = "SELECT * FROM tt WHERE status='1' ORDER BY id DESC LIMIT 10";
$usersResult=mysqli_query($conn,$usersQuery);
$color = array("#cad0f3", "#d1d3db");
$i = 0;
while($rowUser = mysqli_fetch_array($usersResult)){ 
$bid = $rowUser["branch"];

$usersQuery2 = "SELECT * FROM branchs WHERE id='$bid'";
$usersResult2=mysqli_query($conn,$usersQuery2);
while($rowUser2 = mysqli_fetch_array($usersResult2)){ 
$userBy = $rowUser["reg_by"];
$usersQuery3 = "SELECT * FROM user WHERE id='$userBy'";
$usersResult3=mysqli_query($conn,$usersQuery3);
while($rowUser3 = mysqli_fetch_array($usersResult3)){ 

		?>
		<div class="table-content" style="background-color:<?php if ($i % 2 == 0) { echo $color['0'];}else{ echo $color['1']; }?>;min-height: 30px;">	
			<div class="table-row">		
				<div style="float: left; padding: 2px 2px 2px 2px;" class="table-data"><?php echo $rowUser2["name"]; ?></div>
				<div class="table-data"><?php echo $rowUser["tt"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["lan"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["wan"]; ?></div>
				<div class="table-data"><?php echo $rowUser2["sn"]; ?></div>
				<div style="float: left; padding: 2px 2px 2px 2px;" class="table-data"><?php echo date('m/d/Y h:i:s',$rowUser["reg_date"]); ?></div>
				<div style="float: left; padding: 2px 2px 2px 2px;" class="table-data"><?php echo date('m/d/Y h:i:s',$rowUser["res_date"]); ?></div>
				<div class="table-data"><?php echo $rowUser3["username"]; ?></div>
			</div>
		</div>	
		
		<?php
		$i++;
}
}
}
?>
	</div>
</div>