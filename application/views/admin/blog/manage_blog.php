<div class="wrapper">
  <!-- page heading start-->
  <div class="page-heading">
    <h3>
      Manage Blog
    </h3>
  </div>
  <!-- page heading end-->
   <?php
    $msg = "";
    if ($this->session->flashdata('succ')) {
        $class = "alert-success";
        $msg .= $this->session->flashdata('succ');
    } elseif ($this->session->flashdata('err')) {
        $class = "alert-danger";
        $msg .= $this->session->flashdata('err');
    } else {
        $class = "alert-danger";
        $msg .= validation_errors();
    }
    if ($msg != "") {
        ?>
        <br />
        <div class="alert  <?php echo $class; ?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
            <?php echo $msg; ?></div>
        <?php } ?>
 
  <div class="alert show_msg fade in" style="display:none">
  </div>
  <div class="row">
    <div class="col-sm-12">
      <section class="panel"> 
        <header class="panel-heading">
              Blog List
              <span class="tools pull-right"> <a href="<?php echo base_url();?>AddBlog"><i class="fa fa-plus-circle"></i> Add Blog</a></span>
                
            </header>      
        <div class="panel-body">
          <div class="adv-table" id="main-col">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Title</th> 
                   <th>Image</th>
                   <th>Discription</th>
                    <th>Date</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
              </thead>               
              <tbody>
            
               <?php 
              $cnt = 1;	
             //print_r(blog_details);exit;
              if($blog_details != ''){
                                         foreach ($blog_details as $record){
                                         $b_id = $record->post_id;
                                         $b_title = $record->post_title;
                                         $b_image = $record->post_img;
                                         $b_disc = $record->post_description;
                                         $b_date = $record->added_date;
                                         $b_status = $record->status;

        if($record->status==1){
					$b_status = '<label class="label label-success">Active</label>';	
					}else{
					$b_status = '<label class="label label-warning">Inactive</label>';	
					}
			                ?>
                    <tr>
                    <td><?php echo $cnt; ?></td>
                      <td><?php echo strtoupper($b_title); ?></td>
                      <td><img src="<?php echo MEDIAURL;?>blog/<?php echo $b_image; ?>" width="100px" height="100px"></td> 
                       <td><?php echo strtoupper($b_disc); ?></td>
                      <td><?php echo date('d M Y',strtotime( $b_date)); ?></td>
                      <td><?php echo $b_status; ?> </td>                
                       <td align="center">
                        <a href="<?php echo base_url();?>EditBlogDetails/<?php echo ci_enc($b_id); ?>"><i title="Edit" class="fa fa-edit"></i></a>
                          <a href="<?php echo base_url();?>DeleteBlog/<?php echo ci_enc($b_id); ?>"><i title="Delete" class="fa fa-trash-o" class="delete_row"></i></a></td>
                    </tr>
                     <?php 
                     $cnt++; 
              }  } else {
                     ?>
                    <tr>
                        <th> There is No Record.</th>
                    </tr>
              <?php } ?>
              </tbody>
            </table>
         </div>
        </div>
      </section>
    </div>
  </div>
</div>
    