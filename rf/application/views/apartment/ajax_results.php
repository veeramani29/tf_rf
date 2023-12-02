<!-- dummy page -->
<?php foreach ($apartments as $apartment){?>
<div class="col-md-6">
    <a class="apartlist">
        <div class="flexslider listitem">
            <span class="hrticon icon icon-heart"></span>
            <ul class="slides">
                <li><img src="<?php echo ASSETS;?>images/items/item1.jpg" alt=""/></li>
                <li><img src="<?php echo ASSETS;?>images/items/item2.jpg" alt=""/></li>
                <li><img src="<?php echo ASSETS;?>images/items/item3.jpg" alt=""/></li>
                <li><img src="<?php echo ASSETS;?>images/items/item4.jpg" alt=""/></li>
            </ul>
        </div> 
        <div class="itemlabel myitemlbl">
            <div class="leftpin">
                <div class="pinimg"><img src="<?php echo ASSETS;?>images/user-avatar.jpg"/></div>
                <div class="pindets"><?php echo $apartment->PROP_NAME;?><br/></div>
            </div>
            <div class="ritpin">
                <div class="rumprce">$<strong>123.99</strong></div>
                <div class="pernt">Per night..</div>
            </div>
        </div>
    </a>
</div>
<?php }?>

