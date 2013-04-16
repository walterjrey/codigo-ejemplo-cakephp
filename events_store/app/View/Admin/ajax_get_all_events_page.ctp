                <?php foreach($events as $key => $event):?>
				<tr class="<?php echo ($key%2?'alternate-row':'');?>">
					<td><input id="event_<?php echo $event['Event']['id'];?>" value="<?php echo $event['Event']['id'];?>" class="sel_event"  type="checkbox"/></td>
                    <td><?php echo $event['Event']['id'];?></td>
					<td><?php echo $event['Event']['title'];?></td>
					<td><?php echo $event['Event']['place_name'];?></td>
					<td><?php echo $event['Event']['address'];?></td>
					<td><?php echo ($event['Event']['status'] == 1?'Published':'Unpublished');?></td>
					<td><?php echo date("d/m/Y", strtotime($event['Event']['event_start_at']));?></td>
					<td class="options-width">
					<a href="admin/edit_event/<?php echo $event['Event']['id'];?>" target="_newevent" title="Edit" class="icon-1 info-tooltip"></a>
					<a href="javascript:remove(<?php echo $event['Event']['id'];?>)" title="Delete" class="icon-2 info-tooltip"></a>
					<a href="javascript:publish(<?php echo $event['Event']['id'];?>)" title="Edit" class="icon-3 info-tooltip"></a>
					<a href="javascript:unpublish(<?php echo $event['Event']['id'];?>)" title="Edit" class="icon-4 info-tooltip"></a>
					<a href="" title="Edit" class="icon-5 info-tooltip"></a>
					</td>
				</tr>
                <?php endforeach;?>