<div class='row box box-transparent'>
    <?php if ($this->session->userdata('sa_logged_in')) { ?>
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>sdadmin/manage_admin'>
                    <div class='header'>
                        <div class='icon-gears'></div>
                    </div>
                    <div class='content'>Manage Admin</div>
                </a>
            </div>
        </div>
        <!-- <div class='col-xs-4 col-sm-2'>
          <div class='box-quick-link blue-background'>
            <a href='<?php echo WEB_URL; ?>domain'>
              <div class='header'>
                <div class='icon-globe'></div>
              </div>
              <div class='content'>Manage Domain</div>
            </a>
          </div>
        </div> 
      
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link orange-background'>
                <a href='<?php echo WEB_URL; ?>b2b/b2b_view'>
                    <div class='header'>
                        <div class='icon-male'></div>
                    </div>
                    <div class='content'>B2B User</div>
                </a>
            </div>
        </div>
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>apartment'>
                    <div class='header'>
                        <div class='icon-building'></div>
                    </div>
                    <div class='content'>Apartment Management</div>
                </a>
            </div>
        </div> 
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>deposit/agent_deposit_overall_view'>
                    <div class='header'>
                        <div class='icon-money'></div>
                    </div>
                    <div class='content'>Agent Deposit</div>
                </a>
            </div>
        </div>
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>promo/promo_view'>
                    <div class='header'>
                        <div class='icon-barcode'></div>
                    </div>
                    <div class='content'>Promo</div>
                </a>
            </div>
        </div>-->
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='#'>
                    <div class='header'>
                        <div class='icon-code'></div>
                    </div>
                    <div class='content'>API Mananagement</div>
                </a>
            </div>
        </div>
        <!--<div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>currency/currency_converter'>
                    <div class='header'>
                        <div class='icon-usd'></div> <div class='icon-exchange'></div> <div class='icon-rupee'></div>
                    </div>
                    <div class='content'>Currency Convertor</div>
                </a>
            </div>
        </div>-->
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>support/support_view'>
                    <div class='header'>
                        <div class='icon-headphones'></div>
                    </div>
                    <div class='content'>Support Ticket</div>
                </a>
            </div>
        </div>


 


       <!-- <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>hotelcrs'>
                    <div class='header'>
                        <div class='icon-building'></div>
                    </div>
                    <div class='content'>Hotel CRS</div>
                </a>
            </div>
        </div>


        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link blue-background'>
                <a href='<?php echo WEB_URL; ?>supplier/suppliers_list'>
                    <div class='header'>
                        <div class='icon-group'></div>
                    </div>
                    <div class='content'>Supplier</div>
                </a>
            </div>
        </div>-->





        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link purple-background'>
                <a href='<?php echo WEB_URL; ?>markup_b2c'>
                    <div class='header'>
                        <div class='icon-code'></div>
                    </div>
                    <div class='content'>Markup Management</div>
                </a>
            </div>
        </div>


 
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link purple-background'>
                <a href='<?php echo WEB_URL; ?>payment'>
                    <div class='header'>
                        <div class='icon-code'></div>
                    </div>
                    <div class='content'>Payment Gateway Charge Management</div>
                </a>
            </div>
        </div>

      
        <div class='col-xs-4 col-sm-2'>
            <div class='box-quick-link purple-background'>
                <a href='<?php echo WEB_URL; ?>orders'>
                    <div class='header'>
                        <div class='icon-building'></div>
                    </div>
                    <div class='content'>Manage orders</div>
                </a>
            </div>
        </div>
    <?php
    } else if ($this->session->userdata('admin_logged_in')) {
        foreach ($this->data['modules'] as $module) {
            ?>
            <div class='col-xs-4 col-sm-2'>
                <div class='box-quick-link blue-background'>
                    <a href='<?php echo WEB_URL; ?><?= $module->url; ?>'>
                        <div class='header'>
                            <?php if ($module->icon == 'currency') { ?>
                                <div class='icon-usd'></div> <div class='icon-exchange'></div> <div class='icon-rupee'></div>
                            <?php } else { ?>
                                <div class='icon-<?= $module->icon; ?>'></div>
        <?php } ?>
                        </div>
                        <div class='content'><?= $module->privilege; ?></div>
                    </a>
                </div>
            </div>
    <?php }
} ?>
</div>

<!-- <div class='col-xs-4 col-sm-2'>
  <div class='box-quick-link blue-background'>
    <a href='#'>
      <div class='header'>
        <div class='icon-comments'></div>
      </div>
      <div class='content'>Comments</div>
    </a>
  </div>
</div>
<div class='col-xs-4 col-sm-2'>
  <div class='box-quick-link green-background'>
    <a href='#'>
      <div class='header'>
        <div class='icon-star'></div>
      </div>
      <div class='content'>Veeeery long title of this quick link</div>
    </a>
  </div>
</div>
<div class='col-xs-4 col-sm-2'>
  <div class='box-quick-link orange-background'>
    <a href='#'>
      <div class='header'>
        <div class='icon-magic'></div>
      </div>
      <div class='content'>Magic</div>
    </a>
  </div>
</div> -->
