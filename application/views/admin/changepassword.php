<div class="page-heading">

            <h3>

                Profile

            </h3>

            <ul class="breadcrumb">

                <li>

                    <a href="<?php echo base_url();?>admin">home</a>

                </li>

                <li class="active"> Change Password </li>

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

	<form name="frm" enctype="multipart/form-data" method="post" action="<?php echo base_url();?>admin/ChangePassword">

        

            <div class="row">

                <div class="col-md-4">

                    <div class="row">

                       

                        <div class="col-md-12">

                            <div class="panel">

                                <div class="panel-body">

                                    <ul class="p-info">



                                        <li>

                                            <div class="title">New Password</div>

                                            <div class="desk"><input type="password" name="new_password" value="" class="form-control"  required="required"></div>

                                        </li>

                                        

                                        <li>

                                            <div class="title">Confirm Password</div>

                                            <div class="desk"><input type="password" name="con_password" value="" class="form-control" required="required"></div>

                                        </li>

                                    </ul>

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

       

<!--body wrapper end-->