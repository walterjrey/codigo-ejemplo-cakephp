                <?php foreach($users as $key => $user):?>
				<tr class="<?php echo ($key%2?'alternate-row':'');?>">
					<td><input id="user_<?php echo $user['User']['id'];?>" value="<?php echo $user['User']['id'];?>" class="sel_event"  type="checkbox"/></td>
                    <td><?php echo $user['User']['id'];?></td>
					<td><?php echo $user['User']['email'];?></td>
					<td>
                    <?php 
                        switch($user['User']['level']) {
                            case 1:
                             echo 'Normal User';
                            break; 
                            case 2:
                             echo 'Moderator';
                            break; 
                            case 3:
                             echo 'Administrator';
                            break; 
                            case 5:
                             echo 'Super Admin';
                            break;                                                                                     
                        }
                    ?>
                    </td>
					<td><?php echo ($user['User']['status'] == 1?'Active':'Inactive');?></td>
					<td><?php echo date("d/m/Y H:i:s", strtotime($user['User']['created']));?></td>
					<td class="options-width">
					<a href="admin/edit_user/<?php echo $user['User']['id'];?>" target="_newevent" title="Edit" class="icon-1 info-tooltip"></a>
					<a href="javascript:remove(<?php echo $user['User']['id'];?>)" title="Delete" class="icon-2 info-tooltip"></a>
					<a href="javascript:publish(<?php echo $user['User']['id'];?>)" title="Edit" class="icon-3 info-tooltip"></a>
					<a href="javascript:unpublish(<?php echo $user['User']['id'];?>)" title="Edit" class="icon-4 info-tooltip"></a>
					<a href="" title="Edit" class="icon-5 info-tooltip"></a>
					</td>
				</tr>
                <?php endforeach;?>