<script type="text/javascript" src="js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery/jquery-ui-1.8.20.custom.min.js"></script>
<link rel="stylesheet" href="css/ui-lightness/jquery-ui-1.8.20.custom.css" type="text/css" />
<link rel="stylesheet" href="css/home.css" type="text/css" media="screen" />
<script type="text/javascript">
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<style>
#content {
float:inherit;
width: 880px;
}
.description {
    font-size: 11px;
    color:#666;
}
h2 {
    font-size: 17px;
}
</style>
<div id="content">
<?php if(!empty($Event)):?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Event</a></li>
		<li><a href="#tabs-2">Tickets</a></li>
		<li><a href="#tabs-3">Location</a></li>
	</ul>
	<div id="tabs-1">
        <h1><?php echo $Event['Event']['title'];?></h1>
        <br />
        <div class="img-event"><img style="border: 1px solid #CCC;padding: 2px;" src="Thumbs/show/<?php echo $Event['Event']['id'];?>/600/400/<?php echo $Event['Event']['presentation_image'];?>/jpg" /></div>

        <span><?php echo $Event['Event']['subtitle'];?></span>
        <br />
        <span class="description">
        <?php echo $Event['Event']['description'];?>    
        </span>
	   
        <br />
        <h2>Sell Points</h2>
        <br />
        <span class="description">
        <?php echo $Event['Event']['sell_points_description'];?>
        </span>
	</div>
	<div id="tabs-2">
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>
	<br class="clearfix" />
<?php else:?>

<h1>Event doesnt' exists.</h1>
<?php endif;?>
</div>