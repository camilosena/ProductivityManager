<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Blueprint: Tooltip Menu</title>
		<link rel="stylesheet" type="text/css" href="../css/component.css" />
		<script src="../js/modernizr.custom.js"></script>
	</head>
	<body>
		<div>
			<ul id="cbp-tm-menu" class="cbp-tm-menu">
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Veggiede</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-archive">Sorrel desert</a></li>
						<li><a href="#" class="cbp-tm-icon-cog">Raisin kakadu</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Plum salsify</a></li>
						<li><a href="#" class="cbp-tm-icon-users">Bok choy celtuce</a></li>
						<li><a href="#" class="cbp-tm-icon-earth">Onion endive</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Bitterleaf</a></li>
						<li><a href="#" class="cbp-tm-icon-mobile">Sea lettuce</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Pepper tatsoi</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-archive">Brussels sprout</a></li>
						<li><a href="#" class="cbp-tm-icon-cog">Kakadu lemon</a></li>
						<li><a href="#" class="cbp-tm-icon-link">Juice green</a></li>
						<li><a href="#" class="cbp-tm-icon-users">Wine fruit</a></li>
						<li><a href="#" class="cbp-tm-icon-earth">Garlic mint</a></li>
						<li><a href="#" class="cbp-tm-icon-location">Zucchini garnish</a></li>
						<li><a href="#" class="cbp-tm-icon-mobile">Sea lettuce</a></li>
					</ul>
				</li>
				<li>
					<a href="#">Sweet melon</a>
					<ul class="cbp-tm-submenu">
						<li><a href="#" class="cbp-tm-icon-screen">Sorrel desert</a></li>
						<li><a href="#" class="cbp-tm-icon-mail">Raisin kakadu</a></li>
						<li><a href="#" class="cbp-tm-icon-contract">Plum salsify</a></li>
						<li><a href="#" class="cbp-tm-icon-pencil">Bok choy celtuce</a></li>
						<li><a href="#" class="cbp-tm-icon-article">Onion endive</a></li>
						<li><a href="#" class="cbp-tm-icon-clock">Bitterleaf</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<script src="../js/cbpTooltipMenu.min.js"></script>
		<script>
			var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
		</script>
	</body>
</html>
