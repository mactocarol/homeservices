<div class="wrapper">
    <div class="page-heading">
        <ul class="breadcrumb">
            <li>
                <a href="#">Admin</a>
            </li>
            <li class="active">Dashboard</li>
        </ul>
    </div>
    <div class="clearfix"></div>
    <!-- page heading end-->
    <!--body wrapper start-->
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <!--statistics start-->
                <div class="row state-overview">
                    <div class="col-md-4">
                        <div class="panel red" onclick="javascript:window.location.href = '<?php echo base_url('ManageUser'); ?>'" style="cursor:pointer;">
                            <div class="symbol">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="state-value">
                                <div class="title"><?php //echo $total_u ?>&nbsp;&nbsp;<font color="white">Users</font></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--statistics end-->
            </div>
            <div class="alert show_msg fade in" style="display:none">
            </div>
            <div class="row">
                <div class="col-sm-12">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="panel">
            </div>
        </div>
    </div>
</div>
</div>

