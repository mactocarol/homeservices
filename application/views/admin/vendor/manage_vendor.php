<div class="page-heading">
    <h3>
        Manage Vendor
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() ?>dashboard">Home</a>
        </li>
        <li class="active"> Manage Vendor </li>
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
            <?php echo $msg; ?>                                                          </div>
        <?php } ?>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel overs">
                 <header class="panel-heading">
              Vendor List
<!--              <span class="tools pull-right"> <a href="<?php echo base_url();?>AddVendor"><i class="fa fa-plus-circle"></i> Add Vendor</a></span>-->
                <span class="tools pull-right"> <a href="<?php echo base_url();?>vendor/import_vendor"><i class="fa fa-edit"></i> Upload CSV</a></span>
            </header>      
                <div class="panel-body">
                    <section id="flip-scroll">
                        <div class="adv-table" id="main-col">
                            <table class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Vendor Name</th>
                                        <th>Vendor Email</th>
                                         <th>Category</th>
                                          <th>Mobile No</th>
                                          <th>Address</th>
                                          <th>Zipcode</th>
                                          <th>Experience Year</th>
                                           <th>Jonning Date</th>
                                          <th>Vendor Status</th>
                                       <th align="center">Actions</th>
                                    </tr>
                                </thead>
                                  <tbody>
                                    <?php
                                    $cnt = 1;
                                    if ($vender != '') {
                                        foreach ($vender as $user) {
                                            ?>
                                            <tr>
                                                <td><?php echo $cnt; ?></td>
                                                <td><?php echo $user->company; ?></td>
                                                <td><?php echo ucfirst($user->vendor_firstname . ' '.$user->vendor_lastname); ?></td>
                                                <td><?php echo $user->vendor_email; ?></td>
                                                 <td><?php echo $user->vendors_choose_cat; ?></td>
                                                 <td><?php echo $user->mobile; ?></td>
                                                 <td><?php echo $user->address; ?></td>
                                                 <td><?php echo $user->zipcode; ?></td>
                                                 <td><?php echo $user->vendor_experience; ?></td>
                                                <td><?php echo date('d M Y',strtotime($user->vendor_joined_date)); ?></td>
                                               <td><?php if($user->vendor_status == 'active'){ echo '<span class="label label-primary">Active</span>'; }else{ echo '<span class="label label-info">Inactive</span>'; } ?></td>
                                                   <td>
                                                    <a href="<?php echo base_url(); ?>EditVendorDetails/<?php echo $user->v_id; ?>" title="Edit details"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                                    <a href="<?php echo base_url(); ?>DeleteVendor/<?php echo $user->v_id; ?>" title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    
                                                </td>
                                            </tr>
                                                    <?php $cnt++; } }else{?>
                                            <tr>
                                                <td colspan="6">No Record Found.</td>
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

