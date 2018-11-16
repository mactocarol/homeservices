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
                        <li class="breadcrumb-item"><a href="<?php echo SITEBASEURL.'Blog'; ?>Blog">Blog</a></li>
                        <li class="breadcrumb-item active"><?php echo ucfirst($single_blog->post_title); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<!-----banner_end--->
<!----inner_pages_section--->
<div class="inner_pages_section">

    <section class="single_blog padding_60"><!--get in touch sec----->
        <div class="container">
            <div class="row"> 
                <!---blog left pannel-->
                <?php if($single_blog != 'no'): ?>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="single_blog_box">
                        <div class="single_blog_img">
                            <img src="<?php echo MEDIAURL; ?>blog/<?php echo $single_blog->post_img; ?>">
                            <ul class="single_info-post">
                                <li class="date"><?php echo date('d', strtotime($single_blog->update_date)); ?></li>
                                <li class="month"><?php echo date('M', strtotime($single_blog->update_date)); ?></li>
                            </ul>
                            <ul class="single_entry-meta">
                                <li><a href="#">By admin</a></li>
                                <li class="reply"><i class="icon-commets fa fa-comments"></i><a href="#"> 0</a></li>
                            </ul>
                        </div>

                        <div class="list-about__inner">
                            <h2 class="ui-title-inner">
                                <a href="#"><?php echo $single_blog->post_title; ?></a></h2>
                                <?php echo $single_blog->post_description; ?>
                                   
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-----blog1 end--->
                <!---blog right pannel-->
                <div class="col-md-3 col-sm-3 col-xs-12 sidebar">
                    <div class="single_blog_ul">

<!--                        <div class="widget search-widget">
                            <form action="#">
                                <input class="form-control" placeholder="Search in here" required="" type="search">
                                <button type="submit" class="btn btn-link" title="Search"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <div class="widget">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="fa-ul">
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Nature (4)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Lifestyle (16)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Dancing (12)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Travel (7)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Music (11)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Party (9)</a></li>
                                <li><a href="#"><i class="fa-li fa fa-angle-right"></i>Europe (30)</a></li>
                            </ul>
                        </div>-->

                        <div class="widget">
                            <h3 class="widget-title">Recent Posts</h3>
                            <ul class="posts-list">
                                <?php if(!empty($all_blog)): 
                                    foreach ($all_blog as $blogs):
                                    ?>
                                <li>
                                    <figure>
                                        <a href="<?php echo SITEBASEURL; ?>BlogDetails/<?php echo ci_enc($blogs->post_id); ?>" title="<?php echo $blogs->post_title; ?>"><img src="<?php echo MEDIAURL; ?>blog/thumb/<?php echo $blogs->post_img; ?>" alt="Post" height="70" width="70"></a>
                                    </figure>
                                    <h5><a href="<?php echo SITEBASEURL; ?>BlogDetails/<?php echo ci_enc($blogs->post_id); ?>"><?php echo $blogs->post_title; ?></a></h5>
                                    <span><?php echo date('M d,Y', strtotime($blogs->update_date)); ?></span>
                                </li>
                                <?php endforeach; 
                                endif; ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section><!--get in touch sec----->

</div>
<!----inner_pages_section--->



