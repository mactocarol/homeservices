<!-----banner_img--->
<div id="cms-page-title" class="cms-page-title text-center">
    <div id="cms-page-title-overlay">
        <div class="container">
            <div class="row">
                <div id="cms-page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h1> SERVICES</h1>
                </div>
                <div id="cms-breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $terms_data->page_title; ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----banner_end--->
<!----inner_pages_section--->
<div class="inner_pages_section">
	<section class="terms padding_60">
		<div class="container">
			<div class="inner_terms">
<?php echo $terms_data->page_content; ?>
	</div>
		</div>
	</section>
</div>
	
