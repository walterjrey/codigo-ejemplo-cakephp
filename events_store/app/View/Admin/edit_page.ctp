<!-- Load TinyMCE -->
<script type="text/javascript" src="<?php echo Router::url('/', true);?>/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
	$().ready(function() {
		$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : '<?php echo Router::url('/', true);?>/js/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",

			// Theme options
			theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
			theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
			theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			//content_css : "css/content.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
	});
</script>
<div id="page-heading"><h1>Edit Page</h1></div>

<form action="" method="post" enctype="multipart/form-data" name="frmAddEvent">
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
	<td>
	
	
		<!--  start step-holder -->
		<!--  end step-holder -->
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Page title:</th>
			<td><input type="text" name="title" id="title" class="inp-form-large" value="<?php echo (!empty($Pages)?$Pages->data['Pages']['title']:'');?>" /></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Page sub-title:</th>
			<td><input type="text" name="subtitle" class="inp-form-large" value="<?php echo (!empty($Pages)?$Pages->data['Pages']['subtitle']:'');?>" /></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Order:</th>
			<td><input type="text" name="orden" class="inp-form" value="<?php echo (!empty($Pages)?$Pages->data['Pages']['orden']:'');?>" /></td>
			<td></td>
		</tr>         
		<tr>
		<th valign="top">Show in the site<br /> menu:</th>
		<td>	
		<input type="radio" name="show_in_menu" value="1" <?php echo (!empty($Pages) && $Pages->data['Pages']['show_in_menu'] == 1)?'checked="true"':"";?> /> Yes&nbsp;&nbsp;
        <input type="radio" name="show_in_menu" value="2" <?php echo (!empty($Pages) && $Pages->data['Pages']['show_in_menu'] == 2)?'checked="true"':"";?> /> No
		</td>
		<td></td>
		</tr>    
		<tr id="menu_where" style="<?php echo (!empty($Pages) && $Pages->data['Pages']['show_in_menu'] == 1)?'':'display: none;';?>">
			<th valign="top">Footer/Header:</th>
			<td>
    		<input type="radio" name="show_where" value="1" <?php echo (!empty($Pages) && $Pages->data['Pages']['show_where'] == 1)?'checked="true"':"";?> /> Header&nbsp;&nbsp;
            <input type="radio" name="show_where" value="2" <?php echo (!empty($Pages) && $Pages->data['Pages']['show_where'] == 2)?'checked="true"':"";?> /> Footer

            </td>
			<td></td>
		</tr>               
		<tr id="menu_text" style="<?php echo (!empty($Pages) && $Pages->data['Pages']['show_in_menu'] == 1)?'':'display: none;';?>">
			<th valign="top">Menu text:</th>
			<td><input type="text" name="menutext" class="inp-form-large" value="<?php echo (!empty($Pages)?$Pages->data['Pages']['menutext']:'');?>" /></td>
			<td></td>
		</tr> 
		<tr>
			<th valign="top">URL:</th>
			<td><input type="text" name="slug" class="inp-form-large" id="slug" value="<?php echo (!empty($Pages)?$Pages->data['Pages']['slug']:'');?>" /></td>
			<td></td>
		</tr> 
        
		<tr>
		<th valign="top">Page Content:</th>
		<td>	
		<select  class="styledselect_form_1" name="page_content" id="page_content">
			<option value="contact_form" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'contact_form')?'selected="selected"':"";?>>Contact Form</option>
            <option value="custom_content" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'custom_content')?'selected="selected"':"";?>>Custom Content</option>
            <option value="latest_event_list" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'latest_event_list')?'selected="selected"':"";?>>Latest Events</option>
            <option value="all_events" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'all_events')?'selected="selected"':"";?>>All Events</option>
			<option value="category_events" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'category_events')?'selected="selected"':"";?>>Events in Category</option>
            <option value="hot_events" <?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'hot_events')?'selected="selected"':"";?>>Hot Events</option>
		</select>
		</td>
		<td></td>
		</tr>                                
	<tr id="page_type_content" style="<?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'custom_content')?'':'display: none;';?>">
		<th valign="top">Content:</th>
		<td><textarea rows="100" cols="" name="description" class="form-textarea tinymce"><?php echo (!empty($Pages)?$Pages->data['Pages']['content']:'');?></textarea></td>
		<td></td>
	</tr>   
	<tr id="category_content" style="<?php echo (!empty($Pages) && $Pages->data['Pages']['page_content'] == 'category_events')?'':'display: none;';?>">
	<th valign="top">Categories:</th>
	<td>	
	<select name="category_id"  class="styledselect_form_1">
        <?php foreach($categories as $key => $item):?>
		<option value="<?php echo $item['Category']['id'];?>" <?php echo (!empty($Pages) && $Pages->data['Pages']['category_id'] == $item['Category']['id'])?'selected="selected"':"";?> ><?php echo $item['Category']['title'];?></option>
        <?php endforeach;?>
	</select>
	</td>
	<td></td>
	</tr>
    
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" value="" class="form-submit" onclick="document.frmAddEvent.submit()" />
			<input type="reset" value="" class="form-reset" onclick="document.frmAddEvent.reset();"  />
		</td>
		<td></td>
	</tr>
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
</form>
<div class="clear">&nbsp;</div>
<script type="text/javascript">

$(function() {
   $('#page_content_container li').click(function() {
        if($(this).attr('id') == 'page_content_input_custom_content') {
            $('#page_type_content').show();
        } else {
            $('#page_type_content').hide();
        }  
        if($(this).attr('id') == 'page_content_input_category_events') {
            $('#category_content').show();
        } else {
            $('#category_content').hide();
        }
        
        $('#page_content').val($(this).attr('id').replace('page_content_input_', ''));
   }); 
   $('#title').blur(function() {
        $('#slug').val(string_to_slug($(this).val()));
   })
   .keyup(function() {
        $('#slug').val(string_to_slug($(this).val()));
   });
   
   $("input[name='show_in_menu']").click(function() {
        if($(this).is(':checked') && $(this).val() == 1) {
            $('#menu_text').show();
            $('#menu_where').show();
        } else {
            $('#menu_text').hide();
            $('#menu_where').hide();
        }
   });
});

function string_to_slug(str) {
  str = str.replace(/^\s+|\s+$/g, ''); // trim
  str = str.toLowerCase();
  
  // remove accents, swap ס for n, etc
  var from = "אבהגטיכךלםןמעףצפשתüûסח·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc------";
  for (var i=0, l=from.length ; i<l ; i++) {
    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }

  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
    .replace(/\s+/g, '-') // collapse whitespace and replace by -
    .replace(/-+/g, '-'); // collapse dashes

  return str;
}
</script>