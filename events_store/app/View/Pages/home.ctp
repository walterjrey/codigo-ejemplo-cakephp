<link rel="stylesheet" href="css/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/mosaic.css" type="text/css" media="screen" />

<script type="text/javascript" src="js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/mosaic.1.0.1.min.js"></script>

<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
    
	$('.bar3').mosaic({
		animation	:	'slide',	//fade or slide
		anchor_y	:	'top'		//Vertical anchor position
	});        
});
</script>
<link rel="stylesheet" href="css/home.css" type="text/css" media="screen" />

<div id="content">

<div class="slider-wrapper theme-default">

    <div id="slider" class="nivoSlider">
            <a href="/"><img src="Thumbs/show/8/600/400/jpeg/jpg" title="<strong>La vela puerca</strong>: Se presenta en la trastienda!" /></a>
        <?php foreach($EventSlider as $key => $Event):?>
            <a href="events/<?php echo $Event['Event']['slug'].'/'.$Event['Event']['id'];?>"><img src="Thumbs/show/25/600/400/jpeg/jpg" title="<strong><?php echo $Event['Event']['title'];?></strong>: <?php echo $Event['Event']['subtitle'];?>" /></a>
        <?php endforeach;?>                
    </div>      
</div>

      		<!--img src="Thumbs/show/<?php echo $Event['Event']['id'];?>/400/200/<?php echo $Event['Event']['presentation_image'];?>/jpg" /-->        
	<div class="box">
		<h2>Next Events</h2>

	</div>

	<div class="box">
        <?php foreach($EventSlider as $key => $Event):?>
		<div class="mosaic-block bar3">
			<a href="events/<?php echo $Event['Event']['slug'].'/'.$Event['Event']['id'];?>" class="mosaic-overlay">
				<div class="details">
					<h4><strong><?php echo $Event['Event']['title'];?></strong>: <?php echo $Event['Event']['subtitle'];?></h4>
					<!--p>View Event</p-->
				</div>
			</a>
			<a href="events/<?php echo $Event['Event']['slug'].'/'.$Event['Event']['id'];?>" class="mosaic-backdrop"><img src="Thumbs/show/25/600/400/jpeg/jpg"/></a>
		</div>                                                   
        <?php endforeach;?>                                                                                                         
	</div>
	<br class="clearfix" />
</div>
<div id="sidebar">

    <div class="box">            
        <div style="width: 300px;height:152px;position:relative">
            <a href="/"><img src="Thumbs/show/8/300/200/jpeg/jpg" title="" />
            <span class="desc"><strong>La vela puerca</strong><br /> Se presenta en la trastienda!</span>
            </a>
        </div>            
    </div>

    <div class="box">            
        <div style="width: 300px;height:152px;;position:relative">
            <a href="/"><img src="Thumbs/show/8/300/200/jpeg/jpg" title="" />
            <span class="desc"><strong>La vela puerca<br /> Se presenta en la trastienda!</span>
            </a>
        </div>            
    </div>        

	<div class="box">
        <div class="widget categories">
			<h2>Categories</h2>
			<ul>
            <?php foreach($categories as $key => $cat):?>
				<li class="cat-item cat-item-1"><a href="categories/<?php echo $cat['Category']['slug'];?>/<?php echo $cat['Category']['id'];?>"><?php echo $cat['Category']['title'];?></a></li>
            <?php endforeach;?>
			</ul>
		</div>
	</div>
	<div class="box">
        <div class="widget">
			<h2>Hot Events</h2>
			<ul>
               <?php foreach($EventSlider as $key => $Event):?>
                    <li class="cat-item cat-item-1"><a href="events/<?php echo $Event['Event']['slug'].'/'.$Event['Event']['id'];?>"><?php echo $Event['Event']['title'];?></a><br /><span class="small-text"><?php echo $Event['Event']['subtitle'];?></span></li>                            
                <?php endforeach;?>                        
			</ul>
		</div>
	</div>            
</div>
<br class="clearfix" />