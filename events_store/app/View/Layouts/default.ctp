<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="description" content="" />
<meta name="keywords" content="" />
<base href="<?php echo Router::url('/', true);?>" />
<title>Big Business by Free CSS Templates</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">Big Business</a></h1>
		</div>
		<div id="slogan">
			<h2>Template design by Free CSS Templates</h2>
		</div>
	</div>
	<div id="menu">
		<ul>
        <?php foreach($menu_header_items as $key => $menu):?>
            <li><a href="pages/<?php echo $menu['Pages']['slug'].'-'.$menu['Pages']['id'];?>"><?php echo $menu['Pages']['menutext'];?></a></li>
        <?php endforeach;?>
		</ul>
		<br class="clearfix" />
	</div>

	<div id="page">
    <?php echo $content_for_layout ?>
	</div>
	<div id="page-bottom">
		<div id="page-bottom-content">
			<h3>Magnis hendrerit erat</h3>
			<p>
				Euismod sodales sociis hendrerit pulvinar molestie urna. Consectetur egestas sodales at ornare laoreet turpis. Lorem id sapien ridiculus sagittis imperdiet urna suspendisse. Posuere arcu parturient quam risus. Aliquam nullam magnis integer gravida vulputate felis. Consectetur montes sollicitudin dictum. Auctor sociis hendrerit pulvinar molestie urna lorem ipsum dolor vivamus pulvinar libero. Massa egestas cubilia lacus augue mattis consectetur.
			</p>
		</div>
		<div id="page-bottom-sidebar">
			<h3>Sed interdum</h3>
			<ul class="list">
				<li class="first"><a href="#">Suspendisse ultricies</a></li>
				<li><a href="#">Tortor mollis enim</a></li>
				<li class="last"><a href="#">Lorem enim tempor</a></li>
			</ul>
		</div>
		<br class="clearfix" />
	</div>
</div>
<div id="footer">
	Copyright (c) 2012 Sitename.com. All rights reserved. Design by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.
</div>
</body>
</html>
