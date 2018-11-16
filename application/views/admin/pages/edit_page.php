<div class="row">
    <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Edit Page
                    </header>
                    <div class="panel-body">
                        <span style="color:red"><?php echo $this->session->flashdata('Register_error'); ?></span>
                        <?php //foreach($records as $rec) {?>
                        <form role="form" action="" method="POST" enctype="multipart/form-data" name="myForm">
                            
                            <div class="form-group">
                               <label for="Title"><b>Title</b></label>
                               <input type="text" class="form-control" id="title" name="title" placeholder="Enter Page Title" required="required" value="<?php echo $records->page_title; ?>">
                            </div>
                            
                            <div class="form-group">
                               <label for="Content"><b>Page Content</b></label>
                                <?php $display = $records->page_content; ?>
				<?php echo $this->ckeditor->editor('description',$display);?> 
				<?php echo form_error('description','<p class="error">'); ?>
                            </div>
                            <div class="form-group">
                               <label for="Meta Title"><b>Meta Title</b></label>
                               <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" required value="<?php echo $records->meta_title; ?>">
                            </div>
                            <div class="form-group">
                               <label for="Meta Description"><b>Meta Description</b></label>
                               <textarea class="form-control" id="meta_desc" name="meta_desc" cols="12" rows="3" required="required"><?php echo $records->meta_description; ?></textarea>
                            </div>
                            <div class="form-group">
                               <label for="exampleInputEmail1"><b>Meta Keyword</b></label>
                               <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Enter Meta Keyword" required="required" value="<?php echo $records->meta_keyword; ?>">
                            </div>
                            
                            <div class="form-group" id="parent_page_div">
                               <label for="exampleInputEmail1"><b>Status</b></label>
                               <select class="form-control" name="status" id="status" required>
                                   <option value="0">Select Status</option>
                                    <option value="1" <?php if($records->is_active == '1'){ echo 'selected="selected"'; } ?>>Active</option>
                                    <option value="0" <?php if($records->is_active == '0'){ echo 'selected="selected"'; } ?>>Inactive</option>
                               </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    	<?php //} ?>
                    </div>
                </section>
            </div>
</div>

