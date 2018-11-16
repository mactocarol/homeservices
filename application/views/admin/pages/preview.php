<div class="row">
    <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                      Page Preview
                    </header>
                    <div class="panel-body">
                      


<?php
	foreach($records as $rec)
	{
?>

    
    <div class="main-row"  >
		<div class="col-lg-12">
        <div class="page-heading">
            <?php echo ucfirst($rec->title); ?>
        </div>
        <div class="wrapper">
            <?php echo ucfirst($rec->page_content); ?>
        </div>
 		</div>
    </div>
 


<?php } ?>


                    </div>
                </section>
            </div>
</div>