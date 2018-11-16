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
                                    <th>Plan Title</th>  
                                    <th>Plan Category</th>
                                    <th>Plan</th>
                                    <th>Extra</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>               
                            <tbody>
                               <?php if($plan_record != 'no'){
                                   $i =1;
                                foreach ($plan_record as $plan){
                                    ?>
                            <td><?php echo $i; ?></td>
                                <td><?php echo $plan->plan_title; ?></td>
                                <td><?php echo $plan->plan_cat; ?></td>
                                <td><?php $full_plan = json_decode($plan->plan);
                                foreach ($full_plan as $plans):?>
                                    <b>Place</b>:&nbsp; <?php  echo $plans->place; ?>/<b>Month Plan:</b>&nbsp;<?php  echo $plans->three_month; ?>/
                                    <b>Price:</b>&nbsp;<?php  echo $plans->three_price; ?>/<b>Month Plan:</b>&nbsp;<?php  echo $plans->six_month; ?>/
                                    <b>Price:</b>&nbsp;<?php  echo $plans->six_price; ?>/<b>Month Plan:</b>&nbsp;<?php  echo $plans->twale_month; ?>/
                                    <b>Price:</b>&nbsp;<?php  echo $plans->twale_price; ?><br/><br/>
                                    <?php //echo $plans->place;
                                endforeach;
                                ?></td>
                                <td>
                                    <?php $full_extra = json_decode($plan->extra);?>
                                    <?php foreach ($full_extra as $plans_new):?>
                                    <b>Extra</b>:&nbsp; <?php  echo $plans_new->extra; ?>/&nbsp;
                                    <b>Price:</b>&nbsp;<?php  echo $plans_new->extra_price; ?><br/><br/>
                                    <?php  endforeach;   ?>
                                </td>
                                <td><?php echo $plan->plan_date; ?>
                                    
                                </td>
                                <td><a href="">Edit</a></td>
                                <?php $i++;} } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
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