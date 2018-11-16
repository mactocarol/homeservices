<!-----banner--->
<section class="slider main_pages">
    <img src="<?php echo FRONTIMG; ?>banner1.png" alt="First slide" height="1000" width="334">
</section>
<!-----banner end--->	
<div class="inner_pages_section">
    <section class="inner_service_pg padding_60">
        <div class="container">
            <div class="inner_services">
                <?php echo $get_single_record[0]->cat_desc; ?>
                <div class="price_table">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="price_box">
                                <div class="top_title">
                                    <h5><?php echo $get_single_record[0]->cat_name;  ?></h5>
                                </div>
                                <div class="img_kitcen_dv">
                                    <img src="<?php echo MEDIAURL; ?>category/thumb/<?php echo $get_single_record[0]->cat_picture;  ?>">
                                    <ul>
                                        <li>Verified professionals</li>
                                        <li> Up front & fair price </li>
                                        <li>30 days service warranty </li>
                                        <li>Accidental damage warranty</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="price_box">
                                <div class="top_title">
                                    <h5>PRICE LIST</h5>
                                </div>
                                <div id="no-more-tables">
                                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Category</th>
                                                <th>Price / Unit</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>
                                            <tr>
                                                <td data-title="Category">Kitchen</td>
                                                <td data-title="Price / Unit">1,500</td>

                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="price_box">
                                <div class="top_title">
                                    <h5>DROP YOUR QUERY HERE!</h5>
                                </div>
                                <div class="form_dv_book">
                                    <form>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input class="form-control" placeholder="jyoti" type="Text">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control" placeholder="9479944384" type="Text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <input class="form-control" placeholder="jyoti.caroldata@gmail.com" type="Text">
                                                </div>
                                                <div class="col-xs-6">
                                                    <input class="form-control" placeholder="Enter a landmark near you." type="Text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <textarea class="form-control" rows="4" id="comment"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
