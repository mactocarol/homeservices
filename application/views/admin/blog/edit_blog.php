<div class="wrapper">
    <div class="page-heading">
        <h3> Edit Blog </h3>
    </div>
    <?php
    $msg = "";
    if ($this->session->flashdata('upload_error')) {
        $class = "alert-success";
        $msg .= $this->session->flashdata('upload_error');
    }
    if ($msg != "") {
        ?>
        <br/>
        <div class="alert  <?php echo $class; ?> fade in">
            <button data-dismiss="alert" class="close close-sm" type="button"><i class="fa fa-times"></i></button>
        <?php echo $msg; ?>                                                          
        </div>
<?php } ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading"> 
                    <span class="tools pull-right">  
                        <span class="message"><?php echo MANDATORY; ?></span>
                </header>
                <?php
                //print_r($fetch_recored);exit;
                $title = $fetch_details->post_title;
                $discription = $fetch_details->post_description;
                $image = $fetch_details->post_img;
                $status = $fetch_details->status;
                ?>
                <div class="panel-body"> <span style="color:red"><?php echo validation_errors(); ?> <?php echo $this->session->flashdata('Register_error'); ?></span>
                    <form role="form" class="form-horizontal" action="" method="POST" enctype="multipart/form-data"  name="myForm" id="myForm">
                        <div class="form-group">
                            <label class="control-label col-sm-4">Blog Image<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <?php if(isset($image)){ ?>
                                <img id="banner_image_view" alt="" src="<?php echo MEDIAURL; ?>blog/<?php echo $image; ?>" style="width:20%; height:20%; margin-bottom:2px;"/> 
                                <input type="hidden" name="blog_img" value="<?php echo $image; ?>" />
                                 <?php }else{ ?>
                                <img src="<?php echo MEDIAURL;?>images/no_image.gif" alt="" /> 
                                 <?php } ?>
                                <input type="file" name="post_img" id="banner_img" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Blog Title<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <input type="text" name="post_title" id="banner_title" value="<?php echo $title; ?>"class="form-control" required="required">
                            </div>
                        </div>
                        <div class="form-group" id="category_section" style="<?php //echo $category_display; ?>">
                            <label class="control-label col-sm-4">Discription<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <?php echo $this->ckeditor->editor('post_description',$discription);?> 
				<?php echo form_error('post_description','<p class="error">'); ?>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-sm-4">Status<?php echo ASTRIK; ?></label>
                            <div class="col-sm-7">
                                <select name="status" class="form-control">                  
                                    <option value=<?php if ($status = 1) {echo $value = 1;} ?>><?php if ($status == 1) {echo $type = "Active";} ?></option>  
                                    <option value=<?php if ($status = 0) {echo $value = 0;} ?>><?php if ($status == 0) {echo $type = "Inactive";  } ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-offset-4 col-sm-8">
                            <button type="submit" class="btn btn-primary" name="banner_form" value="banner">Update</button>
                        </div>
                    </form>

                </div>

            </section>

        </div>

    </div>

</div>
<link rel="stylesheet" href="<?php echo base_url() ?>css/auto_select/chosen.css">
<link rel="stylesheet" href="<?php echo base_url() ?>js/docsupport/prism.css">
<script src="<?php echo base_url() ?>js/docsupport/chosen.jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>js/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function () {

        var _URL = window.URL || window.webkitURL;

        $("#user").change(function (e) {

        });

        $("#banner_type").trigger('change');

        var isValidImage = function (value) {

            var file, img;

            var img_height, img_width;

            window.isportrait = false;

            if ((file = value.files[0])) {

                img = new Image();

                img.onload = function () {

                    img_height = Number(this.naturalHeight);

                    img_width = Number(this.naturalWidth);

                    if (img_height < 457 || img_width < 571) {

                    } else {

                    }

                    imageLoaded(img_height, img_width);

                };

                file.src = _URL.createObjectURL(file);

            }

        }

        $.validator.addMethod("isValidImage", function (value, element) {

            return isValidImage(element);

        }, 'Please select a minimun width 571 px and height 457px');

        $("#myForm").validate({
            rules: {
                userfile: {
                    accept: "jpg,png,jpeg,gif",
                }

            },
            messages: {
                userfile: {
                    required: "Select Image",
                    accept: "Only image type jpg/png/jpeg/gif is allowed"

                }

            }

        });

    });



    function readURL(input, item) {

        if (input.files[0]) {

            document.getElementById(item).style.display = "block";

            var reader = new FileReader();

            reader.onload = function (e) {

                $('#' + item)

                        .attr('src', e.target.result);

            };

            reader.readAsDataURL(input.files[0]);

        }

    }



</script>



<script type="text/javascript">

    var config = {
        '.chosen-select': {},
        '.chosen-select-prd': {},
        '.chosen-select-brand': {},
        '.chosen-select-city': {},
        '.chosen-select-deselect': {allow_single_deselect: true},
        '.chosen-select-no-single': {disable_search_threshold: 10},
        '.chosen-select-no-results': {no_results_text: 'Oops, nothing found!'},
        '.chosen-select-width': {width: "95%"}

    }

    for (var selector in config) {

        $(selector).chosen(config[selector]);

    }

</script>