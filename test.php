<!DOCTYPE html>  
<html>  
	<head>  
		<title>Hash Switcher</title>
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
		<div class='bod'>
			<table>
				<tr>
					<td class='nav'>
						<h3>Pages</h3>
						<dl>
							<a href="#one"><li>one</li></a>
							<a href='#two'><li>two</li></a>
							<a href='#three'><li>three</li></a>
						</dl>
					</td>
					<td class='info'>
						<div class='page page-active' id='page-one'>
							<h3 style='text-align: center;'>Page One</h3>
						</div>
						<div class='page' id='page-two'>
							<h3 style='text-align: center;'>Page Two</h3>
						</div>
						<div class='page' id='page-three'>
							<h3 style='text-align: center;'>Page Three</h3>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</body>  
</html>  