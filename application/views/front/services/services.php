
<section class="slider main_pages">
    <img src="<?php echo MEDIAURL; ?>category/<?php echo $category_data['cat_picture']; ?>" alt="First slide"  width="1000" height="400">
</section>

     
<div class="inner_pages_section">
    <section class="service padding_60">
        <div class="container">
            <div class="inner_services">
                <h3><span><?php echo $category_data['cat_name']; ?></span> </h3>
                <?php if($child_record != 'no'){ 
                    foreach ($child_record as $child):
                    ?>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="services_dv">
                        <img src="<?php echo MEDIAURL; ?>category/<?php echo $child->cat_picture; ?>" height="200" width="200">
                        <div class="caption caption__portfolio">
                            <h3><a href="<?php echo SITEBASEURL; ?>Services/<?php echo $category_data['cat_name']; ?>/<?php echo encode_category($child->cat_name); ?>"><?php echo $child->cat_name; ?></a></h3>
                        </div>
                    </div>
                </div>
                <?php 
                endforeach;
                }else{ ?>
                <p>No Services Available.</p>
                <?php } ?>

                
            </div>
        </div>
    </section>
</div>


