<div class="header-section">

            <!--toggle button start-->
            <a class="toggle-btn"><i class="fa fa-bars"></i></a>
            <!--toggle button end-->

            <!--search start-->
           <div style="background-color:#090;">
            	<form class="searchform" action="index.php" method="post">
                
                <div style="float:left; ">
                <input type="text" class="form-control" name="keyword" placeholder="Search here..." />
            </div>
            <div class="welcome_user">
            Welcome <?php
			 
			echo ucfirst($this->session->userdata('supplier_name'));
			 
			 ?> ! &nbsp;</div>
            
            
            <!--search end-->
		
              
            </form>
            </div>
            <!--search end-->

            <!--notification menu start -->
            <div class="menu-right">
<ul class="notification-menu">
                  
              
                    <li>
                        <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
<!-------------------------------------------- Admin image----------------------------------------------------------->
                           <!-- <img src="<?php echo base_url();?>upload_image/members/user-avatar.png" alt="" />-->
                            <?php echo ucfirst(($this->session->userdata('supplier_name')!="")?$this->session->userdata('supplier_name'):'');?>
                            
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                            <li><a href="#"><i class="fa fa-user"></i>  Profile</a></li>
                            <li><a data-target="" data-toggle="modal"  href="#"><i class="fa fa-user"></i>  Change Password</a></li>
                            
                            <li><a href="<?php echo base_url();?>SupplierLogout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                        </ul>
                    </li>

                </ul>
                
                </div>
            <!--notification menu end -->

 </div>
  <div class="modal fade" id="myModal_changepassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <input type="hidden" id="location_id" value="fdgdfg" />
                                            <h4 class="modal-title">Chnage Password</h4>
                                        </div>

                                        <div class="modal-body row">

                                            
                                         

                                        </div>

                                    </div>
                                </div>
                            </div>
   
<div class="modal fade" id="myModal_feedback1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true" onclick="Status('<?php echo isset($rec->c_id)?$rec->c_id:''; //$rec->c_id; ?>','<?php echo isset($rec->f_status)?$rec->f_status:''; //$rec->f_status; ?>');">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <input type="hidden" id="location_id" value="fdgdfg" />
                                            <h4 class="modal-title">Feedback</h4>
                                        </div>

                                        <div class="modal-body row">

                                            
                                         

                                        </div>

                                    </div>
                                </div>
                            </div>
                            
<script type="text/javascript">
 function Status(id,Str)
 {
	$.ajax({ 
		url: "<?php echo base_url();?>ajax_image/FeedbackStatus",
		data:{c_id:id,f_status:Str},
		type:"POST",
		cache: false,
		async: false,
		success:function(html)
		{
			window.location = "<?php echo base_url();?>";
			$("#dropdown-list normal-list").html(html);
		}
	});
 }
 </script> 
 
 <noscript>
    <style type="text/css">
        #myForm {display:none;}
    </style>
    <div class="noscriptmsg" style="color:#F30;">
    You don't have javascript enabled. Please enable javascript first.
    </div>
</noscript>                    