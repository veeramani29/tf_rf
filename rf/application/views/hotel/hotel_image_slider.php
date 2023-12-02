<a href="<?php echo ASSETS."images/hotel_pg.jpg";?>">Click here for more pictures</a>
                  <?php
				  
				 for($i=0;$i<count($hotel_images_val);$i++)
				 {
					 
					 ?>
                   
                            <a href="<?php echo $hotel_images_val[$i][1];?>" title="<?php echo $hotel_images_val[$i][0];?>" />
                       
                   
                   <?php
				 }
				 ?>
                
    
                 
