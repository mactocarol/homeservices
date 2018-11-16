<div class="wrapper">
  <!-- page heading start-->
  <div class="page-heading">
    <h3>
      Manage Banner
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
              Banner List
              <span class="tools pull-right"> <a href="<?php echo base_url();?>AddBanner"><i class="fa fa-plus-circle"></i> Add Banner</a></span>
            </header>      
        <div class="panel-body">
          <div class="adv-table" id="main-col">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Banner Type</th>                
                   <th>Image</th>
                   <th>Status</th>
                   <th>Action</th>
                 </tr>
              </thead>               
              <tbody>
            
               <?php 
              $cnt = 1;	
             //print_r($banner_record);exit;
              if($banner_record !='no'){
                                         foreach ($banner_record as $record){
                                         $b_image = $record->banner_image;
                                         $b_title = $record->banner_title;
                                         $b_id = $record->banner_id;
                                        if($record->is_active==1){
					$status = '<label class="label label-success">Active</label>';	
					}else{
					$status = '<label class="label label-warning">Inactive</label>';	
					}
			                ?>
                    <tr>
                    <td><?php echo $cnt; ?></td>
                      <td><?php echo strtoupper($b_title); ?></td>
                      <td><img src="<?php echo MEDIAURL;?>baner/<?php echo $b_image; ?>" width="100px" height="100px"></td>                      
                      <td><?php echo $status; ?> </td>                
                       <td align="center">
                        <a href="<?php echo base_url();?>EditBanner/<?php echo $b_id; ?>"><i title="Edit" class="fa fa-edit"></i></a>
                          <a href="<?php echo base_url();?>DeleteBanner/<?php echo $b_id; ?>"><i title="Delete" class="fa fa-trash-o" class="delete_row"></i></a></td>
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
<?php 
///responsive table
//echo link_tag('js/advanced-datatable/css/demo_page.css');
//echo link_tag('js/advanced-datatable/css/demo_table.css'); ?>
<script type="text/javascript" language="javascript" src="<?php echo JSURL;?>jquery.dataTables.js"></script>
<script src="<?php echo JSURL;?>dynamic_table_init.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="<?php echo JSURL;?>jquery.dataTables.min.js"></script>     
     
     
     
        <script type="text/javascript">
        $(document).ready(function() {        
            $(document).on("click",".delete_row",function(e){
                  e.preventDefault();
                  var id = $(this).attr('id');
                      var r = confirm("Are you really want to delete this banner ?");
                      if (r == true) 
                      {
                        $.ajax({
                          url:"<?php echo base_url(); ?>index.php/banner/delete_banner",    
                          data: {banner_id: id},
                          type: "POST",
                          success: function(data){
                          //alert(data);
                            $(".show_msg").addClass('alert-success');
								location.reload(); 
          var html = "<button data-dismiss='alert' class='close close-sm' type='button'><i class='fa fa-times'></i> </button>Banner Deleted successfully";
                            $(".show_msg").append(html);
                            $(".show_msg").show();
                            $("#dynamic-table").dataTable().fnDraw();
                          }
                        });
               
                      }else{}
            });
          });
</script>     