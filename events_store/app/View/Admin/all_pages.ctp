	<!--  start page-heading -->
	<div id="page-heading">
		<h1>Pages List</h1>
	</div>
	<!-- end page-heading -->

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
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
			
				<!--  end message-green -->
		
		 
				<!--  start product-table ..................................................................................... -->
				<form id="mainform" action="">
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr id="header_events_table">
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
                    <th class="table-header-repeat line-left minwidth-1"  style="min-width: 50px;"><a href="#" class="order_link" order_field="id" order_dir="asc">ID</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="#" class="order_link" order_field="title" order_dir="asc">Page Title</a>	</th>
					<th class="table-header-repeat line-left minwidth-1"><a href="#" class="order_link" order_field="show_in_menu" order_dir="asc">In Menu</a></th>
					<th class="table-header-repeat line-left"><a href="#" class="order_link" order_field="page_content" order_dir="asc">Page Content</a></th>
                    <th class="table-header-repeat line-left"><a href="#" class="order_link" order_field="orden" order_dir="asc">Order</a></th>
					<th class="table-header-repeat line-left"><a href="#" class="order_link" order_field="status" order_dir="asc">Status</a></th>
					<th class="table-header-repeat line-left"><a href="#" class="order_link" order_field="created" order_dir="asc">Created</a></th>
					<th class="table-header-options line-left"><a href="">Options</a></th>
				</tr>
                <?php foreach($pages as $key => $page):?>
				<tr class="<?php echo ($key%2?'alternate-row':'');?>">
					<td><input id="page_<?php echo $page['Pages']['id'];?>" value="<?php echo $page['Pages']['id'];?>" class="sel_event"  type="checkbox"/></td>
                    <td><?php echo $page['Pages']['id'];?></td>
					<td><?php echo $page['Pages']['title'];?></td>
					<td><?php echo $page['Pages']['show_in_menu']?"Yes":"No";?></td>
					<td>
                    <?php
                        switch($page['Pages']['page_content']) {
                            case 'contact_form': echo 'Contact Form';break;
                            case 'custom_content': echo 'Custom Content';break;
                            case 'lastest_event_list': echo 'Latest Event List';break;
                            case 'all_events': echo 'All Events';break;    
                            case 'category_events': echo 'Events in Category';break;  
                            case 'hot_events': echo 'Hot Events';break;
                            case 'index': echo 'Home Page';break;                  
                        } 
                     
                    ?></td>
                    <td class="order_field"><span class="order_span"><?php echo $page['Pages']['orden'];?></span><input style="display: none;width:50px" type="text" asocid="<?php echo $page['Pages']['id'];?>" class="order_txt" value="<?php echo $page['Pages']['orden'];?>" /></td>
					<td><?php echo ($page['Pages']['status'] == 1?'Published':'Unpublished');?></td>
					<td><?php echo date("d/m/Y", strtotime($page['Pages']['created']));?></td>
					<td class="options-width">
					<a href="admin/edit_page/<?php echo $page['Pages']['id'];?>" target="_newevent" title="Edit" class="icon-1 info-tooltip"></a>
					<a href="javascript:remove(<?php echo $page['Pages']['id'];?>)" title="Delete" class="icon-2 info-tooltip"></a>
					<a href="javascript:publish(<?php echo $page['Pages']['id'];?>)" title="Edit" class="icon-3 info-tooltip"></a>
					<a href="javascript:unpublish(<?php echo $page['Pages']['id'];?>)" title="Edit" class="icon-4 info-tooltip"></a>
					<a href="" title="Edit" class="icon-5 info-tooltip"></a>
					</td>
				</tr>
                <?php endforeach;?>

				</table>
				<!--  end product-table................................... --> 
				</form>
			</div>
			<!--  end content-table  -->
		
			<!--  start actions-box ............................................... -->
			<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					<a href="javascript:publishSelected()" class="action-edit">Publish</a>
                    <a href="javascript:unpublishSelected()" class="action-edit">Unpublish</a>
					<a href="javascript:deleteSelected()" class="action-delete">Delete</a>
				</div>
				<div class="clear"></div>
			</div>
			<!-- end actions-box........... -->
			
			<!--  start paging..................................................... -->
			<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
			<tr>
			<td>
				<a href="javascript:getFirstPage()" class="page-far-left"></a>
				<a href="javascript:getPrevPage()" class="page-left"></a>
				<div id="page-info">Page <strong><span id="page"></span></strong> / <span id="total_pages"></span></div>
				<a href="javascript:getNextPage()" class="page-right"></a>
				<a href="javascript:getLastPage()" class="page-far-right"></a>
			</td>
			<td>
			<select  class="styledselect_pages" id="items_per_p" onchange="item_list_page(this.value);"  onclick="item_list_page(this.value);">
				<option value="">Number of rows</option>
				<option value="">5</option>
				<option value="">10</option>
				<option value="">15</option>
                <option value="">50</option>
                <option value="">100</option>
			</select>
			</td>
			</tr>
			</table>
			<!--  end paging................ -->
			
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
	<div class="clear">&nbsp;</div>
    
<script type="text/javascript">
order_field = 'title';
order_dir = 'asc';
item_per_page = <?php echo $items_per_page;?>;
page = 1;
total_pages = <?php echo $total_pages;?>;
total_items = <?php echo $total_items;?>;
function get_page() {
    var header_event_table = $('#product-table tr:first');
    datos = "page="+page+"&total_pages="+total_pages+"&order_field="+order_field+"&order_dir="+order_dir+"&items_per_page="+item_per_page;
    var date = new Date();
    var timestamp = date.getTime();
    $.ajax({
       type: "POST",
       url: "admin/ajax_get_all_pages_page?t="+timestamp,
       data: datos,
       dataType: 'html',
       beforeSend: function(){
           $('#product-table').html('<div id="loading_image" style="text-align:center"><img src="img/ajax-loader.gif" /></div>');
    	},
       success: function(data){
            $('#product-table').append(header_event_table);
            $('#product-table').append(data);
            $('#loading_image').remove();
            update_values();
            $('.order_link').click(function() {
                setOrder($(this));
                return false;
            });            
      }
    });    
}

function changeOrder(asocid, val) {
    datos = "asocid="+asocid+"&order="+val;
    var date = new Date();
    var timestamp = date.getTime();
    $.ajax({
       type: "POST",
       url: "admin/ajax_pages_change_order?t="+timestamp,
       data: datos,
       dataType: 'json',
       beforeSend: function(){

    	},
       success: function(data){
            if(data.error == '') {
                $('.order_txt[asocid="'+asocid+'"]').parent().find('span.order_span:first').text(val);
            } else {
                alert('Error');
            }
      }
    });    
}

function event_actions(action, id) {  
    if(action == 'remove') {
        if(!confirm('Are you sure? This can\'t be undone.')) {
            return false;
        }
    }    
    datos = "action="+action+"&id="+id;
    var date = new Date();
    var timestamp = date.getTime();
    $.ajax({
       type: "POST",
       url: "admin/ajax_pages_actions?t="+timestamp,
       data: datos,
       dataType: 'json',
       beforeSend: function(){

    	},
       success: function(data){
            if(data.error == '') {
                get_page();
            } else {
                alert('Error');
            }
      }
    });      
}

function publishSelected() {
    var arr = new Array();
    $('.sel_event').each(function() {
        if($(this).is(':checked')) {
            arr.push($(this).val());    
        }        
    });
    if(arr.length > 1) {
        event_actions('publish', arr.join(','));
    } else {
        event_actions('publish', arr[0]);
    } 
}

function unpublishSelected() {
    var arr = new Array();
    $('.sel_event').each(function() {
        if($(this).is(':checked')) {
            arr.push($(this).val());    
        }        
    });
    if(arr.length > 1) {
        event_actions('unpublish', arr.join(','));
    } else {
        event_actions('unpublish', arr[0]);
    }      
}

function deleteSelected() {
    var arr = new Array();
    $('.sel_event').each(function() {
        if($(this).is(':checked')) {
            arr.push($(this).val());    
        }        
    });
    if(arr.length > 1) {
        event_actions('remove', arr.join(','));
    } else {
        event_actions('remove', arr[0]);
    }       
}

function setOrder(obj) {
    obj_order_field = $(obj).attr('order_field');
    obj_order_dir = $(obj).attr('order_dir');
    if(obj_order_field == order_field) {
        if(order_dir == 'asc') {
            order_dir = 'desc';
        } else {
            order_dir = 'asc';
        }
    } else {
        order_field = obj_order_field;
        order_dir = obj_order_dir;
    }
    get_page();
}
function item_list_page(qty) {
    item_per_page = qty;
    page = 1;
    total_pages = Math.ceil(total_items/item_per_page);
    get_page();
    
}
function remove(id) {
    event_actions('remove', id);
}

function publish(id) {
    event_actions('publish', id);
}

function unpublish(id) {
    event_actions('unpublish', id);
}

function getNextPage() {
    if(page < total_pages) {
        page++;
        get_page();
    }
}
function getFirstPage() {
    if(page != 1) {
        page = 1;
        get_page();        
    }
}
function getPrevPage() {
    if(page > 1) {
        page--;
        get_page();
    }
}
function getLastPage() {
    if(page != total_pages) {
       page = total_pages;
       get_page(); 
    }
}
function update_values() {
    $('#page').text(page);
    $('#total_pages').text(total_pages);
    $('#items_per_p').val(item_per_page);
    $('#items_per_p_input').val(item_per_page);
}
$(function() {
    update_values();
    $('#items_per_p_container li').click(function() {        
        item_list_page($(this).html());
    })
    $('.order_link').click(function() {
        setOrder($(this));
        return false;
    });
    
    $('.order_field').click(function() {
        $('.order_txt').hide();
        $('.order_span').show();
        if($(this).find('.order_span:first').is(':visible')) {
            $(this).find('.order_span:first').hide();
            $(this).find('.order_txt:first').show();
        }
    });
    
    $('.order_txt').blur(function() {
        changeOrder($(this).attr('asocid'), $(this).val());
        $('.order_txt').hide();
        $('.order_span').show();    
    });
 
     $('.order_txt').keyup(function(ev) {
        if(ev.keyCode == 13 || ev.keyCode == 27) {
            changeOrder($(this).attr('asocid'), $(this).val());
            $('.order_txt').hide();
            $('.order_span').show();               
        }        
    });   
    
    $('.order_field').blur(function() {
        if($(this).find('.order_span:first').is(':visible')) {
            $(this).find('.order_span:first').show();
            $(this).find('.order_txt:first').hide();
        }
    });    
});
</script>