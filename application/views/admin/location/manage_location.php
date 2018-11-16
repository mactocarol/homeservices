<div class="page-heading">
    <h3>
        Manage Location
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() ?>dashboard">Home</a>
        </li>
        <li class="active"> Manage Location </li>
    </ul>
</div>
<!-- page heading end-->
<div class="wrapper">
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
            <?php echo $msg; ?>                                                          
        </div>
        <?php } ?>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                 <header class="panel-heading">
              Location List
              
              <span class="tools pull-right"> <a href="<?php echo base_url();?>ImportCSV"><i class="fa fa-edit"></i> Upload CSV</a></span>
              <span class="tools pull-right"> <a href="<?php echo base_url();?>AddLocation"><i class="fa fa-plus-circle"></i> Add Location</a></span>&nbsp;&nbsp;&nbsp;&nbsp;
                
            </header>      
                <div class="panel-body">
                    <section id="flip-scroll">
                        <div class="adv-table" id="main-col">
                            <table class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Zip Code</th>
                                        <th>Date</th>
                                       <th align="center">Actions</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                    <?php
                                    $cnt = 1;
                                    if ($get_location != '') {
                                        foreach ($get_location as $location) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
<!--                                                <td><?php echo ucfirst($location->location_name); ?></td>-->
                                                <td><?php echo ucfirst($location->city); ?></td>
<!--                                                <td><?php echo ucfirst($location->state); ?></td>-->
                                                <td><?php echo ucfirst($location->zip_code); ?></td>
<!--                                                <td><?php echo ucfirst($location->country); ?></td>-->
                                                <td><?php echo date('d M Y',strtotime($location->last_update_date)); ?></td>
                                                   <td>
                                                    <a href="<?php echo base_url(); ?>EditLocation/<?php echo $location->id; ?>" title="Edit details"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                    <a href="<?php echo base_url(); ?>DeleteLocation/<?php echo $location->id; ?>" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    
                                                </td>
                                            </tr>
                                                    <?php $cnt++; } }else{?>
                                            <tr>
                                                <td colspan="8">No Record Found.</td>
                                            </tr>
                                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </div>
</div>



<!--dynamic table-->
<?php
///responsive table
//echo link_tag('js/advanced-datatable/css/demo_page.css');
//echo link_tag('js/advanced-datatable/css/demo_table.css');
?>

<script type="text/javascript" language="javascript" src="<?php echo JSURL; ?>jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo JSURL; ?>DT_bootstrap.js"></script>
<!--dynamic table initialization -->
<script src="<?php echo JSURL; ?>dynamic_table_init.js"></script>
<script type="text/javascript">
jQuery(document).ready(function () {
    $(document).on("hidden.bs.modal", function (e) {
        $(e.target).removeData("bs.modal").find(".modal-content").empty();
    });
});

function Delconfirm() 
{
    if (confirm("Do you realy want to delete this Information ?")) 
    {
        return true;
    } else 
    {
        return false;
    }
}

function active_user(id)
{
    var active = 'active_' + id;
    var block = 'block_' + id;
    var span_active = 'span_active_' + id;
    var span_block = 'span_block_' + id;
    var r = confirm("Are you really want to publish this page ?");
    if (r == true)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>pages/active_pages",
            data: {pageid: id},
            type: "POST",
            success: function (data)
            {
                //$("#subcategory").html(data);
                document.getElementById(active).style.display = 'none';
                document.getElementById(block).style.display = 'inline';
                document.getElementById(span_active).style.display = 'inline';
                document.getElementById(span_block).style.display = 'none';
            }
        });
    }
    else
    {
    }
}

function block_user(id)
{
    var active = 'active_' + id;
    var block = 'block_' + id;
    var span_active = 'span_active_' + id;
    var span_block = 'span_block_' + id;
    var r = confirm("Are you really want to unpublish this page ?");
    if (r == true)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/pages/block_pages",
            data: {pageid: id},
            type: "POST",
            success: function (data)
            {
                document.getElementById(active).style.display = 'inline';
                document.getElementById(block).style.display = 'none';
                document.getElementById(span_active).style.display = 'none';
                document.getElementById(span_block).style.display = 'inline';
            }
        });
    }
    else
    {
    }
}

function search_result()
{
    $('#loadingmessage').show();
    var country_name = document.getElementById("ajax_country").value;
    var name = document.getElementById('ajax_uname').value;
    var status = document.getElementById('ajax_status').value;
    var from_date = document.getElementById('from').value;
    var to_date = document.getElementById('to').value;
    if ((from_date) && (!to_date))
    {
        document.getElementById('error').style.display = 'inline';
    }
    else if ((!from_date) && (to_date))
    {
        document.getElementById('error').style.display = 'inline';
    }
    else
    {
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/users/search_criteria",
            data: {country: country_name, uname: name, status: status, from: from_date, to: to_date},
            type: "POST",
            success: function (data) {
                $("#main-col").html(data);
            }
        });
    }
}
</script>

