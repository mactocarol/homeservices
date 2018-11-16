<table class="display table table-bordered table-striped" id="dynamic-table">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Name </th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Register Through</th>
                            <th>Status</th>
                            <th>Date Added</th>
                            <th align="center">Actions</th>
                        </tr>
                       </thead>
                        <tbody>
                        
                        <?php 
                            $cnt = 1;
                        if(!empty($records) && count($records)) 
						{     
                        	foreach($records as $rec) 
							{ 
						?>
                        <tr>
                            <td><?php echo $cnt;?></td>
                            <td><?php echo (!empty($rec->first_name)) ? $rec->first_name." ".$rec->last_name : '--'; ?></td>
                            <td><?php echo $rec->email_id; ?></td>
                            <td><?php echo (!empty($rec->contact_no)) ? $rec->contact_no : '--'; ?></td>
                            <td><?php echo ucfirst($rec->join_through); ?></td>
                            <td id="statuscell_<?php echo $rec->user_uid; ?>">
								<?php 
									if($rec->status == 1)
									{	
								?>
										<span id="span_active_<?php echo $rec->user_uid; ?>" class="label label-success">Active</span> 
                                        <span id="span_block_<?php echo $rec->user_uid; ?>" class="label label-danger" style="display:none;">Blocked</span> 
                                <?php
									}else{ 
								?>
                                	<span id="span_block_<?php echo $rec->user_uid; ?>" class="label label-success">Active</span> 
                                    <span id="span_active_<?php echo $rec->user_uid; ?>" class="label label-danger" style="display:none;">Blocked</span> 
                                <?php 
									}
                                ?>
                            </td>
                            <td><?php echo $rec->register_date; ?></td>
                             <td>
                                    <a href="<?php echo base_url();?>UserProfile/<?php echo $rec->user_uid; ?>" id='<?php echo $rec->user_uid; ?>' title="View details"><i class="fa fa-eye fa-lg"></i></a>&nbsp;&nbsp;
                                <?php 
                                    if($rec->status == 1){
                                ?>        
                                    <a href="javascript:void(0)" id='block_<?php echo $rec->user_uid; ?>' title="Block this user ?" class="changeStatus" onclick="block_user('<?php echo $rec->user_uid; ?>')"><i class="fa fa-ban fa-lg" id="icon_<?php echo $rec->user_uid; ?>"></i></a>   
                                    
                                    <a href="javascript:void(0)" id='active_<?php echo $rec->user_uid; ?>' title="Active this user ?" class="changeStatus" onclick="active_user('<?php echo $rec->user_uid; ?>')" style="display:none;"><i class="fa fa-check fa-lg" id="icon_<?php echo $rec->user_uid; ?>"></i></a>  
                                    
                                <?php   
                                 } else {
                                ?>    
                                    <a href="javascript:void(0)" class="changeStatus" id='active_<?php echo $rec->user_uid; ?>' title="Activate this user ?" onclick="active_user('<?php echo $rec->user_uid; ?>')"><i class="fa fa-check fa-lg" id="icon_<?php echo $rec->user_uid;?>"></i></a>
                                    
                                     <a href="javascript:void(0)" class="changeStatus" id='block_<?php echo $rec->user_uid; ?>' title="Block this user ?" onclick="block_user('<?php echo $rec->user_uid; ?>')" style="display:none;"><i class="fa fa-ban fa-lg" id="icon_<?php echo $rec->user_uid;?>"></i></a> 
                                        
                                <?php

                                    }

                                 ?>
                             </td>
                           
                        </tr>
                       <?php $cnt++;}
                   }//if close.
                       ?>
                        
            
                        </tbody>
                    </table>
<script src="<?php echo base_url();?>js/dynamic_table_init.js"></script>