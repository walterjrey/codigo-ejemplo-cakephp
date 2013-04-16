<div id="page-heading"><h1>Dates</h1></div>

<form action="" method="post" enctype="multipart/form-data" name="frmAddSectorsInfo">
<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowleft.jpg" width="20" height="300" alt="" /></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><img src="images/shared/side_shadowright.jpg" width="20" height="300" alt="" /></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td id="td_dates">

	
		<!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no-off">1</div>
			<div class="step-light-left"><a href="">Add event details</a></div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">2</div>
			<div class="step-light-left">Location</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">3</div>
			<div class="step-light-left">Pricing</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no">4</div>            
			<div class="step-dark-left">Dates</div>
			<div class="step-dark-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
	
		<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
  
	<tr>
	<th>Dates:</th>
	<td><input type="button" value="Add New Date" onclick="addPrice()" /> </td>
	<td>
	</td>
    </tr>
    <tr><td colspan="2"><hr /></td></tr>   
    </table>		
	<!-- end id-form  -->

	</td>
	<td>

	<!--  start related-activities -->
	<div id="related-activities">
		
		<!--  start related-act-top -->
		<div id="related-act-top">
		<img src="images/forms/header_related_act.gif" width="271" height="43" alt="" />
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
			
				<div class="left"><a href=""><img src="images/forms/icon_plus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Add another product</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="images/forms/icon_minus.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Delete products</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				
				<div class="clear"></div>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><img src="images/forms/icon_edit.gif" width="21" height="21" alt="" /></a></div>
				<div class="right">
					<h5>Edit categories</h5>
					Lorem ipsum dolor sit amet consectetur
					adipisicing elitsed do eiusmod tempor.
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
					</ul>
				</div>
				<div class="clear"></div>
				
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->

</td>
</tr>

<tr>
<td>
    <table border="0" cellpadding="0" cellspacing="0">    
    <tr>
    <th>Create an event for each date:&nbsp;&nbsp;</th>
    <td><input type="radio" value="1" name="create_event" /> Yes &nbsp; <input type="radio" value="2" checked="true" name="create_event" /> No (Recomended) </td>
    <td>
    </td>
    </tr> 
    <tr><td colspan="2">&nbsp;</td></tr>          
	<tr>
		<td valign="top" colspan="2">            
			<input type="button" value="Submit" class="form-submit" onclick="document.frmAddSectorsInfo.submit()" />
		</td>
		<td></td>
	</tr>
	</table>
</td>
</tr>
<tr>
<td><img src="images/shared/blank.gif" width="695" height="1" alt="blank" /></td>
<td></td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->
</td>
<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
<input type="hidden" name="step4" value="1" />
</form>

<table border="0" cellpadding="0" cellspacing="0"  id="form_date" style="display: none;">
<tr>
<th valign="top">Event Date:</th>
<td class="noheight">

	<table border="0" cellpadding="0" cellspacing="0">
	<tr  valign="top">
		<td>
        <input type="text" name="date[]" class="inp-form datepicker" />    
		</td>
		<td></td>
	</tr>
	</table>

</td>
<td></td>
</tr>
<tr>
	<th valign="top">Event Hour:</th>
	<td>
    <select name="hour[]">
    <?php for($i = 0; $i < 24; $i++):?>
        <option value="<?php echo $i;?>"><?php echo sprintf('%02d', $i);?></option>
    <?php endfor;?>
    </select>
    :
    <select name="minutes[]">
    <?php for($i = 0; $i < 60; $i++):?>
        <option value="<?php echo $i;?>"><?php echo sprintf('%02d', $i);?></option>
    <?php endfor;?>
    </select>    
    </td>
	<td></td>
</tr>
<tr>
<th valign="top">Tickets Availables on:</th>
<td class="noheight">

	<table border="0" cellpadding="0" cellspacing="0">
	<tr  valign="top">
		<td>
        <input type="text" name="date2[]" class="inp-form datepicker" />    
		</td>
		<td></td>
	</tr>
	</table>

</td>
<td></td>
</tr>

<tr><td colspan="2"><input type="button" value="Remove" onclick="deletePrice(this)" /></td></tr>
<tr><td colspan="2"><hr /></td></tr>
</table>
<script type="text/javascript">
ind = 0;
function addPrice() {
    var html = '<tr><td colspan="2"><table width="100%" id="table_'+ind+'">'+$('#form_date').html().replace('[ID]', ind)+'</table></td></tr>';
    $('#id-form').append(html);

    $('#table_'+ind+' input.datepicker').datepicker({
			showOn: "button",
			buttonImage: "img/icon_calendar.jpg",
			buttonImageOnly: true,
            dateFormat: "yy-mm-dd"
		});        
    ind++;
}
function deletePrice(obj) {
    $(obj).parent().parent().parent().parent().parent().parent().remove();
}
$(function(){
   addPrice();

});
</script>