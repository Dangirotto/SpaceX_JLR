<!DOCTYPE HTML>
<!--
	Aerial by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
include("index_controller.php");
?>
<html>
	<head>
		<title>SpaceX by Danillo Girotto Guimaraes</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">
		<div id="wrapper">
			<div id="bg"></div>
			<div id="overlay"></div>
			<div id="main">

				<!-- Header -->
					<header id="header">
						<a href="index.php"><h1>SpaceX Launches</h1></a>
						<p>Select one option below:</p>
						<nav>
							<ul>
								<li><a href="index.php?run=year" class="fa fa-calendar" title="Launches by year"><span class="label">By year</span></a></li>
								<li><a href="index.php?run=site" class="fa fa-rocket" title="Launches by site"><span class="label">By site</span></a></li>
							</ul>
						<?php
						if(isset($_GET['run']) && $_GET['run'] == 'year'){?>
							<p>Launches per year:</p>
							<nav>
								<ul>
							<?php
							foreach ($launches_per_year as $year => $count) {
								echo "<li style='width: 100%; line-height: 0; height: 0'><span class='label'>Year: $year - Launches: $count</span></li>";
							}
							echo "</ul>";
						}
						elseif(isset($_GET['run']) && $_GET['run'] == 'site'){?>
							<p>Launches per site:</p>
							<nav>
								<ul>
							<?php
							foreach ($launches_per_site as $site_id => $count) {
								echo "<li style='width: 100%; line-height: 0; height: 0'><img src='$sites_images[$site_id]' style='width: 10%;'><span class='label'>Site: $sites_name[$site_id] - Launches: $count</span></li>";
							}
							echo "</ul>";
						}
						?>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
						<span class="copyright">&copy; Design template from: <a href="http://html5up.net">HTML5 UP</a>.</span>
					</footer>

			</div>
		</div>
		<script>
			window.onload = function() { document.body.classList.remove('is-preload'); }
			window.ontouchmove = function() { return false; }
			window.onorientationchange = function() { document.body.scrollTop = 0; }
		</script>
	</body>
</html>