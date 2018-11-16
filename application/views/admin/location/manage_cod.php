        
       <?php $msg ="";
			  if($this->session->flashdata('success'))
      {
                
        $class = "alert-success";
        $msg .= $this->session->flashdata('success');
      }
      if($this->session->flashdata('error'))
      {
                
        $class = "alert-danger";
        $msg .= $this->session->flashdata('error');
      }
		
		 if($msg!=""){?>
         <br />

        <div class="alert  <?php echo $class;?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button">
                <i class="fa fa-times"></i>
            </button>
           <?php echo $msg;?>                                                          
       </div>
        <?php }?>
            <div class="alert show_msg fade in" style="display:none">

       </div>
        <div class="row">
        <div class="col-sm-12">
        
        
        
        <section class="panel">
            <header class="panel-heading">
            Manage zipcode

              <span class="tools pull-right" style="margin-left:10px;"> <a href="<?php echo base_url();?>AddZipcode"><i class="fa fa-plus-circle"></i> Add Zipcode</a></span>&nbsp;&nbsp;
                 <span class="tools pull-right"> <a id="cod" href="#"><i class="fa fa-edit"></i> Import COD Zipcode</a></span>
             
            </header>
            <div class="panel-body">
          <div class="adv-table" id="main-col">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Zipcode</th>
                 <th>Zip City</th>                                   
                  <th>Date Added</th>
                  <th>Status</th>
                  <th align="center">Actions</th>
                </tr>
              </thead>
               
              <tbody>
            
               <?php  $cnt = 1;
					 if(!empty($cod)){
						
								foreach($cod as $zipcode){
									if($zipcode['cod_status']==1){
										$status = '<label class="label label-success">Active</label>';	
									}else{
										$status = '<label class="label label-danger">Inactive</label>';			
									}
									?>
                    <tr>
                   
                    <td><?php echo $cnt;?></td>
                      <td><?php echo $zipcode['cod_zip'];?></td>
                      <td><?php echo $zipcode['cod_city'];?></td>
                     <td><?php echo date('d,M,Y h:i A',strtotime($zipcode['cod_added_date']));?></td>                      
                      <td><?php echo $status;?></td>
                      <td align="center">
                        <a  href="<?php echo base_url('EditZipcode').'/'.ci_enc($zipcode['cod_zip_id']); ?>"><i title="Edit" class="fa fa-edit"></i></a>
                        <a id="<?php echo $zipcode['cod_zip_id']?>" class="delete_row"  href="#"><i title="Delete" class="fa fa-trash-o"></i></a>
                      </td>
                    </tr>
                     <?php
							 $cnt++;	}
					    }else{
						   echo "No record were found";
						   }
						  
						   ?>
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
echo link_tag('js/advanced-datatable/css/demo_page.css');
echo link_tag('js/advanced-datatable/css/demo_table.css'); ?>

<script type="text/javascript" language="javascript" src="<?php echo base_url();?>js/advanced-datatable/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>js/dynamic_table_init.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>
<script>
 $(document).on("click",".delete_row",function(e){
	
                  e.preventDefault();
                  var id = $(this).attr('id');
                      var r = confirm("Are you really want to delete this zip ?");
                      if (r == true) 
                      {
                        $.ajax({
                          url:"<?php echo base_url(); ?>index.php/cod_zip/delete_zip",    
                          data: {zipid: id},
                          type: "POST",
                          success: function(data){
                            //alert(data);
                            if(data=='0'){
                              alert('Unable to delete record');
                            }else{
                              $(".show_msg").addClass('alert-success');

                              var html = "<button data-dismiss='alert' class='close close-sm' type='button'><i class='fa fa-times'></i></button>Zipcode deleted successfully";
                              $(".show_msg").append(html);
                              $(".show_msg").show();
                              location.reload();
                              $("#dynamic-table").dataTable().fnDraw();
                            }
                          }
                        });

               
                      }else{}
            });
	 $(document).ready(function() {
         $( "#dialog" ).dialog({
            autoOpen: false,
            modal: true,
            height: 400,
            width: 800,

            buttons: [
              {
                text: "Close",
                class:"pull-right btn btn-primary",
                icons: {
                  primary: "ui-icon-heart"
                },
                click: function() {
                  $( this ).dialog( "close" );
                }

                // Uncommenting the following line would hide the text,
                // resulting in the label being used as a tooltip
                //showText: false
              }
            ]
         });
		  $("#zip_import").validate({
    rules: {    
        imp_zip: {
        required: true,
       extension: "csv"
      },
     } 
     
   });
	 });
          $(document).on("click","#cod",function(e){

                            $( "#dialog" ).dialog( "open" );
                               
                
          });
			
			
</script>

<div id="dialog" title="Import zipcode">
 <div class="adv-table">  
 <form class="well" id="zip_import" action="<?php echo base_url('import-zipcode'); ?>" method="post" enctype="multipart/form-data" >
 <table>
 <tr><th>Import csv file</th></tr>
 <tr><td><input type="file" name="imp_zip" id="imp_zip">
</td></tr>
<tr><td>
<button type="submit" class="btn btn-primary" id="btn_status" name="submit" >Import</button>

</td>
</tr>
</table>
  Required CSV Format
<table class="table" border="1">
                                    <thead>
                                      <tr>
                                        <th>Zip code</th>
                                         <th>Zip city</th>                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                         <td>452001</td>
                                         <td>Indore</td>
                                      <tr>
                                        
                                    </tbody>
                                  </table>
</form>
</div>
</div>
  
<script src="<?php echo base_url();?>js/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-image-gallery.min.js"></script>
