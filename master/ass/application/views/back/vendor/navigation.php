<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header"></li>           
            
                        <!--Menu list item-->
                        <li <?php if($page_name=="DASHBOARD"){?> class="active-link" <?php } ?> 
                        	style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a href="<?php echo base_url(); ?>index.php/vendor/">
                                <i class="fa fa-dashboard"></i>
                                <span class="menu-title">
									<?php echo translate('DASHBOARD');?>
                                </span>
                            </a>
                        </li>
                        
            			<?php
                        	if( $this->crud_model->vendor_permission('product') || 
									$this->crud_model->vendor_permission('stock') ){
						?>
                        <!--Menu list item-->
                        <li <?php if( $page_name=="product" || 
                                            $page_name=="stock" ){?>
                                                 class="active-sub" 
                                                    <?php } ?> >
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <?php echo translate('my_products');?>
                                    </span>
                                	<i class="fa arrow"></i>
                            </a>
            

                            <!--PRODUCT------------------>
                            <ul class="collapse <?php if( $page_name=="product" || 
                                                            $page_name=="stock" ){?>
                                                                 in
                                                                    <?php } ?> >" >
                                
                                <?php
                                 if($this->crud_model->vendor_permission('product')){
                                

                                ?>
                                    <li <?php if($page_name=="Category"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/product_category">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('product_category');?>
                                        </a>
                                    </li>
                                <?php

                                ?>
                                    <li <?php if($page_name=="sub_caterogy"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/product_sub_category">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('product_sub_category');?>
                                        </a>
                                    </li>
                                <?php

                                ?>
                                    <li <?php if($page_name=="brand"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/product_brand">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('product_brand');?>
                                        </a>
                                    </li>
                                <?php

                                ?>
                                    <li <?php if($page_name=="product"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/product">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('product_list');?>
                                        </a>
                                    </li>
                                <?php
                                    } if($this->crud_model->vendor_permission('stock')){
									}
                                ?>
                            </ul>
                        </li>
                      
            			<?php
							}
						?>  
                        
            <!-- SUPPLIERS -------------->

                        <li <?php if($page_name=="SUPPLIERS"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/manage_suppliers/">
                                <i class="fa fa-truck"></i>
                                <span class="menu-title">
                                    <?php echo translate('SUPPLIERS');?>
                                </span>
                            </a>
                        </li>
            
            <!-- SUPPLIERS -------------->
            
            <!-- PURCHASES -------------->

                        <li <?php if($page_name=="PURCHASES"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/manage_purchases/">
                                <i class="fa fa-truck"></i>
                                <span class="menu-title">
                                    <?php echo translate('PURCHASES');?>
                                </span>
                            </a>
                        </li>
            
            <!-- PURCHASES -------------->

            <!-- CUSTOMERS -------------->

                        <li <?php if($page_name=="CUSTOMERS"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/manage_customers/">
                                <i class="fa fa-truck"></i>
                                <span class="menu-title">
                                    <?php echo translate('CUSTOMERS');?>
                                </span>
                            </a>
                        </li>
            
            <!-- CUSTOMERS -------------->


            <!--SALE-------------------->
						<?php
							if($this->crud_model->vendor_permission('sale')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="SALES"){?> class="active-link" <?php } ?>>
                            <a href="<?php echo base_url(); ?>index.php/vendor/sales/">
                                <i class="fa fa-usd"></i>
                                    <span class="menu-title">
                                		<?php echo translate('SALES');?>
                                    </span>
                            </a>
                        </li>

                        <li <?php if($page_name=="Shop Sales"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/shop_sales">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('shop_sales');?>
                                        </a>
                                    </li>

                        <li <?php if($page_name=="MARKETPLACE_SALES"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/marketplace_sales">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('marketplace_sales');?>
                                        </a>
                                    </li>

                            <li <?php if($page_name=="CLASSIFIED_SALES"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/classified_sales">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('classified_sales');?>
                                        </a>
                                    </li>

                            <li <?php if($page_name=="ALL_SALES"){?> class="active-link" <?php } ?> >
                                        <a href="<?php echo base_url(); ?>index.php/vendor/all_sales">
                                            <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('all_sales');?>
                                        </a>
                                    </li>
                        <?php
							}
						?>
						
                        <?php
							if($this->crud_model->vendor_permission('report')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="report" || 
                                        $page_name=="report_stock" ||
                                            $page_name=="report_wish" ){?>
                                                     class="active-sub" 
                                                        <?php } ?>>
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                    <span class="menu-title">
                                		<?php echo translate('reports');?>
                                    </span>
                                		<i class="fa arrow"></i>
                            </a>
                            
                <!--REPORT-------------------->
                            <ul class="collapse <?php if($page_name=="report" || 
                                                            $page_name=="report_stock" ||
                                                                $page_name=="report_wish" ){?>
                                                                             in
                                                                                <?php } ?> ">

                                 <li <?php if($page_name=="PURCHASE_REPORTS"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/purchase_report/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('product_purchase_report');?>
                                    </a>
                                </li>

                                <li <?php if($page_name=="Complete_purchase_report"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/complete_purchase_report/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('complete_purchase_report');?>
                                    </a>
                                </li>
                                
                                <li <?php if($page_name=="SHOP_SALES_REPORT"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/shop_sales_report/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('shop_sales_report');?>
                                    </a>
                                </li>

                                <li <?php if($page_name=="MARKETPLACE_SALES_REPORT"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/marketplace_sales_report/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('marketplace_sales_report');?>
                                    </a>
                                </li>


                                <li <?php if($page_name=="report"){?> class="active-link" <?php } ?> >
                                	<a href="<?php echo base_url(); ?>index.php/vendor/report/complete_sales_report">
                                    	<i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('complete_sales_report');?>
                                    </a>
                                </li>
                               
                                <li <?php if($page_name=="report"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/report/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('product_compare');?>
                                    </a>
                                </li>

                                <li <?php if($page_name=="report_stock"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/report_stock/">
                                    	<i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('product_stock');?>
                                    </a>
                                </li>
                                <li <?php if($page_name=="report_wish"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/report_wish/">
                                    	<i class="fa fa-circle fs_i"></i>
                                        	<?php echo translate('product_wishes');?>
                                    </a>
                                </li>
                                <li <?php if($page_name=="abondand_carts"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>index.php/vendor/abondand_carts/">
                                        <i class="fa fa-circle fs_i"></i>
                                            <?php echo translate('abondand_carts');?>
                                    </a>
                                </li>
                            </ul>
                        
                        <?php
							}
						?>

                                                
                        <?php
                            if($this->crud_model->vendor_permission('coupon')){
                        ?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="coupon"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/coupon/">
                                <i class="fa fa-tags"></i>
                                    <span class="menu-title">
                                        <?php echo translate('discount_coupon');?>
                                    </span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <?php
                            }
                        ?>
                        
                                                
                        <?php
                            if($this->crud_model->vendor_permission('site_settings')){
                        ?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/site_settings/general_settings/">
                                <i class="fa fa-wrench"></i>
                                    <span class="menu-title">
                                        <?php echo translate('settings');?>
                                    </span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <?php
                            }
                        ?>
                        
                        <?php
                            if($this->crud_model->vendor_permission('business_settings')){
                        ?>
                        <li <?php if($page_name=="business_settings"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/business_settings/">
                                <i class="fa fa-dollar"></i>
                                <span class="menu-title">
                                    <?php echo translate('payment_settings');?>
                                </span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        
                        <?php
                            if($this->crud_model->vendor_permission('business_settings')){
                        ?>
                        <li <?php if($page_name=="package"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/package/">
                                <i class="fa fa-gift"></i>
                                <span class="menu-title">
                                    <?php echo translate('my_packages');?>
                                </span>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                        
            <!-- EMAIL CAMPAIGNING -------------->

                        <li <?php if($page_name=="EMAIL_CAMPAIGNING"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/EMAIL_CAMPAIGNING/">
                                <i class="fa fa-truck"></i>
                                <span class="menu-title">
                                    <?php echo translate('EMAIL_CAMPAIGNING');?>
                                </span>
                            </a>
                        </li>
            
            <!-- SUPPLIERS -------------->
                        <li <?php if($page_name=="manage_vendor"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>index.php/vendor/manage_vendor/">
                                <i class="fa fa-lock"></i>
                                <span class="menu-title">
                                	<?php echo translate('manage_vendor_profile');?>
                                </span>
                            </a>
                        </li>
                </div>
            </div>
        </div>
    </div>
</nav>