<div class="page-heading">
            <h3>
                Profile
            </h3>
            <ul class="breadcrumb">
                <li>
                    <a href="<?php echo base_url();?>admin">home</a>
                </li>
                <li class="active"> Profile </li>
            </ul>
        </div>
        <?php $msg ="";
			if($this->session->flashdata('succ'))
			{
				$class = "alert-danger-suc";
				$msg .= $this->session->flashdata('succ');
			}elseif($this->session->flashdata('err'))
			{
				$class = "alert-danger";
				$msg .= $this->session->flashdata('err');
			}else
			{
				$class = "alert-danger";
				$msg .= validation_errors();
			}
		 if($msg!=""){?>
        <div class="alert alert-block <?php echo $class;?> fade in">
                                <button data-dismiss="alert" class="close close-sm" type="button">
                                    <i class="fa fa-times"></i>
                                </button>
                               <?php echo $msg;?>                                                          </div>
        <?php }?>	
<div class="wrapper">
<?php //echo $error;?>
	<form name="frm" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>changeprofile">
        
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <!--<div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="profile-pic text-center">
                                        <img alt="" src="<?php echo base_url()?>images/photos/user-avatar.png">
                                    </div>
                                </div>
                            </div>
                        </div>-->
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <ul class="p-info">

                                        <li>
                                            <div class="title">First Name</div>
                                            <div class="desk"><input type="text" name="f_name" value="<?php echo ucfirst($records['first_name']); ?>" class="form-control"  required="required"></div>
                                        </li>
                                        
                                        <li>
                                            <div class="title">Last Name</div>
                                            <div class="desk"><input type="text" name="l_name" value="<?php echo ucfirst($records['last_name']); ?>" class="form-control" required="required"></div>
                                        </li>
                                      
                                        <li>
                                            <div class="title">Email</div>
                                            <div class="desk"><input type="email" name="email" value="<?php echo $records['email'];?>" class="form-control" required="required"></div>
                                        </li>   

                                        <li>
                                            <div class="title">Contact Number</div>
                                            <div class="desk"><input type="text" name="contact_number" value="<?php echo $records['contact_number'];?>" class="form-control" required="required"></div>
                                        </li> 

                                        <li>
                                            <div class="title">Address</div>
                                            <div class="desk"><textarea name="address" id="address"><?php echo $records['address'];?></textarea></div>
                                        </li>                                    
                                        
                                        <li>
                                            <div class="title">Change Profile Pic</div>
                                            <div class="desk">
                                             <?php $profile_image = (empty($records['photo_path']))? '' : $records['photo_path'];?>
                                              <img id="banner_image_view" alt=" " src="<?php echo base_url().'images/admin/'.$profile_image;?>" style="width:95%; height:105%; margin-bottom:2px;"/> 
                                            <input type="file" name="upload" class="form-control" onChange="readURL(this,'banner_image_view')"/></div>
                                        </li> 
                                        <li>
 <div class="title">
 
 <input type="hidden" name="edit" id="edit" value="1">
 <!----<a data-target="#myModal_profile" data-toggle="modal"  href="<?php echo base_url();?>home/ChangeProfile">Edit Profile</a>
 ---->
 </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myModal_profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <input type="hidden" id="location_id" value="fdgdfg" />
                                            <h4 class="modal-title">Edit Profile</h4>
                                        </div>
                                        <div class="modal-body row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="profile-desk">
                                        <h1><?php echo $records['first_name']." ".$records['last_name'];?></h1>
                                        <span class="designation">Role: Administrator</span>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                
            </div>
            
            <div align="left">
               	<button type="submit"  class="btn btn-success">Submit</button>
            </div>
			</form>
        </div>
        <script type="text/javascript">
        function readURL(input,item) {
		if (input.files[0]) {	
		document.getElementById(item).style.display = "block";
		//document.getElementById('blah9').style.display = "none";
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+item)
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
		}	
        </script>
<!--body wrapper end-->