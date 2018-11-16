<div class="page-heading">
    <h3>
        Manage Users
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() ?>dashboard">Home</a>
        </li>
        <li class="active"> Manage Users </li>
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
            <section class="panel">
                <header class="panel-heading">
                 </header>
                <div class="panel-body">
                    <section id="flip-scroll">
                        <div class="adv-table" id="main-col">
                            <table class="display table table-bordered table-striped" id="dynamic-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Category Name</th>
                                        <th>Booking For</th>
                                        <th>Booking peroid</th>
                                        <th>Book Date/Time</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <div id='loadingmessage' style='display:none;' align="center">
                                    <img src='<?php base_url(); ?>images/loading_spinner.gif'/>
                                </div>
                                <tbody>
                                    <?php
                                    $cnt = 1;
                                    if ($booking != '') {
                                        foreach ($booking as $customer_book) { ?>
                                                         <tr>
                                                        <td><?php echo $cnt; ?></td>
                                                        <td>
                                                            <?php echo ucfirst($customer_book->first_name); ?> &nbsp; 
                                                            <?php echo ucfirst($customer_book->last_name); ?>
                                                        </td>
                                                        <td><?php echo $customer_book->cat_id; ?></td>
                                                        <td><?php echo $customer_book->plan_hr_badroom .'-'.$customer_book->first_item; ?>
                                                            <?php echo $customer_book->plan_hr_bathroom .'-'.$customer_book->second_item; ?>
                                                             <?php echo $customer_book->livingroom .'-'.$customer_book->thired_item; ?>
                                                        </td>
                                                        <td><?php echo $customer_book->plans; ?></td>
                                                        <td><?php echo $customer_book->booking_date; ?></td>
                                                        <td><?php echo  '$'.$customer_book->amount; ?></td>
                                                        
                                                   </tr>
                                           
                                    <?php  $cnt++; } }  ?>
                             </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </section>
        </di
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

