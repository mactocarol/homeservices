<div class="row">
    <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Add New Page
                    </header>
                    <div class="panel-body">
                        <span style="color:red"><?php echo $this->session->flashdata('Register_error'); ?></span>
                        
                        <form role="form" onsubmit="return validateForm()" action="<?php echo base_url(); ?>AddPagePost" method="POST" enctype="multipart/form-data" name="myForm">
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Title</b></label>
                               <input type="text" class="form-control" id="title" name="title" placeholder="Enter Page Title" required="required">
                            </div>
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Page Content</b></label>
                               <?php echo $this->ckeditor->editor('description');?> 
				<?php echo form_error('description','<p class="error">'); ?>
                            </div>
                            
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Meta Title</b></label>
                               <input type="text" class="form-control" id="m_title" name="m_title" placeholder="Enter Meta Title" required="required">
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Meta description</b></label>
                               <textarea class="form-control" id="m_desc" name="m_desc" cols="12" rows="3" required="required"></textarea>
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Meta Keyword</b></label>
                               <input type="text" class="form-control" id="m_keyword" name="m_keyword" placeholder="Enter Meta Keyword" required="required">
                            </div>
                            
                            <div class="form-group" id="parent_page_div">
                               <label for="exampleInputEmail1"><b>Status</b></label>
                               <select class="form-control" name="status" id="status" required>
                                   <option value="0">Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                               </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </section>
            </div>
</div>
<script>
	
	function validateForm()
	{
		if((document.myForm.parent_page_id.value=="0") && (document.myForm.child_page.checked))  
		{   
			document.getElementById('error').style.display = 'block';  
			return(false);  
		} 
	 
	}
	function check_display()
	{
		document.getElementById('parent_page_div').style.display = 'block';
	}
	
	function check_non_display()
	{
		document.getElementById('parent_page_div').style.display = 'none';
	}


</script>