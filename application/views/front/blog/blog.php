<!-----banner_img--->
<div id="cms-page-title" class="cms-page-title text-center">
    <div id="cms-page-title-overlay">
        <div class="container">
            <div class="row">
                <div id="cms-page-title-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <h1> Blog</h1>
                </div>
                <div id="cms-breadcrumb-text" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo SITEBASEURL; ?>">Home</a></li>
                        <li class="breadcrumb-item active">Blog</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----banner_end--->

<!----inner_pages_section--->
<div class="inner_pages_section">
    <section class="blog_page padding_60"><!--get in touch sec----->
        <div class="container">
            <div class="row"> 
                <?php
                foreach ($blod_details as $detail) {
                    $id = $detail->post_id;
                    $title = $detail->post_title;
                    $discription = $detail->post_description;
                    $blog_img = $detail->post_img;
                    $date = $detail->update_date;
                    ?>
                    <!---blog1--->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="blog_box">
                            <div class="blog_img">
                                <img src="<?php echo MEDIAURL; ?>blog/thumb/<?php echo $blog_img; ?>">
                                <ul class="info-post">
                                    <li class="month"><?php echo date('d M Y', strtotime($date)); ?></li>
                                </ul>
                                <ul class="entry-meta">
                                    <li><a href="#">By admin </a></li>
                                    <li class="reply"><i class="icon-commets fa fa-comments"></i><a href="#"> 0</a></li>
                                </ul>
                            </div>
                            <div class="list-about__inner">
                                <h2 class="ui-title-inner">
                                    <a href="single_blog.php"><?php echo $title; ?> </a></h2>
                                    <?php echo substr($discription,0,100); ?>
                                <a class="btn btn-default" href="<?php echo SITEBASEURL; ?>BlogDetails/<?php echo ci_enc($id); ?>">Read more</a>        
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <!--pagination--->
<!--            <ul class="pagination">
                <li class="disabled"><a href="#">&laquo;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&raquo;</a></li>
            </ul>-->
            <!--pagination--->
        </div>
    </section><!--get in touch sec----->
</div>
<!----inner_pages_section--->



