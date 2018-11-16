<div class="wrapper">
    <!-- page heading start-->
    <div class="page-heading">
        <h3>
            Manage Plan
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
    }else{
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
                    Active Plan List
                    <span class="tools pull-right"> <a href="<?php echo base_url(); ?>AddPlan"><i class="fa fa-plus-circle"></i> Add Plan</a></span>
                </header>      
                <div class="panel-body">
                    <div class="adv-table" id="main-col">
                        <table class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Date</th>
                                    <th>Status</th>
<!--                                    <th>Plan For</th>-->
<!--                                    <th>3 Month</th>
                                    <th>6 Month</th>
                                    <th>12 Month</th>-->
<!--                                    <th>Active on</th>
                                     <th>Status</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>               
                            <tbody>
                                <?php
                                $cnt = 1;
                             //   print_r($plan_record);exit;
                                    if ($plan_record != 'no') {
                                     foreach ($plan_record as $record) {
                                        $p_title = $record->plan_title;
                                        $p_cat = $record->plan_cat;
                                        $p_date =  $record->plan_date;
                                        if ($record->plan_status == 1) {
                                            $status = '<label class="label label-success">Active</label>';
                                        } else {
                                            $status = '<label class="label label-warning">Inactive</label>';
                                        }
                                        ?>
                                        <tr>
                                            <td><?php echo $cnt; ?></td>
                                            <td><?php echo strtoupper($p_title);?></td>
                                            <td><?php echo strtoupper($p_cat);  ?></td>
                                           <td><?php echo $p_date; ?></td>
                                            <td><?php echo $status;  ?></td>
                                            <td align="center">
                                                <a href="<?php echo base_url(); ?>EditPlan/<?php echo $record->plan_id; ?>"><i title="Edit" class="fa fa-edit"></i></a>
                                                <a href="<?php echo base_url(); ?>DeletePlan/<?php echo $record->plan_id; ?>"><i title="Delete" class="fa fa-trash-o" class="delete_row"></i></a></td>
                                        </tr>
                                        <?php
                                        $cnt++;
                                    }
                                } else {
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
//echo link_tag('js/advanced-datatable/css/demo_table.css'); 
?>
<script type="text/javascript" language="javascript" src="<?php echo JSURL; ?>jquery.dataTables.js"></script>
<script src="<?php echo JSURL; ?>dynamic_table_init.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="<?php echo JSURL; ?>jquery.dataTables.min.js"></script>     



<script type="text/javascript">
    $(document).ready(function () {
        $(document).on("click", ".delete_row", function (e) {
            e.preventDefault();
            var id = $(this).attr('id');
            var r = confirm("Are you really want to delete this banner ?");
            if (r == true)
            {
                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/banner/delete_banner",
                    data: {banner_id: id},
                    type: "POST",
                    success: function (data) {
                        //alert(data);
                        $(".show_msg").addClass('alert-success');
                        location.reload();
                        var html = "<button data-dismiss='alert' class='close close-sm' type='button'><i class='fa fa-times'></i> </button>Banner Deleted successfully";
                        $(".show_msg").append(html);
                        $(".show_msg").show();
                        $("#dynamic-table").dataTable().fnDraw();
                    }
                });

            } else {
            }
        });
    });
</script>     