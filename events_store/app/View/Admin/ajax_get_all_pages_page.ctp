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
                            case 'latest_event_list': echo 'Latest Event List';break;
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