                <?php foreach($categories as $key => $category):?>
				<tr class="<?php echo ($key%2?'alternate-row':'');?>">
					<td><input id="event_<?php echo $category['Category']['id'];?>" value="<?php echo $category['Category']['id'];?>" class="sel_event"  type="checkbox"/></td>
                    <td><?php echo $category['Category']['id'];?></td>
					<td><?php echo $category['Category']['title'];?></td>
                    <td><?php echo $category['Category']['enabled']?"Yes":"No";?></td>
					<td class="options-width">
					<a href="admin/edit_category/<?php echo $category['Category']['id'];?>" target="_newevent" title="Edit" class="icon-1 info-tooltip"></a>
					<a href="javascript:remove(<?php echo $category['Category']['id'];?>)" title="Delete" class="icon-2 info-tooltip"></a>
					</td>
				</tr>
                <?php endforeach;?>