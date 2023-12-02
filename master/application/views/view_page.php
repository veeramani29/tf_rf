<!--leftmenu-->
<?php $this->load->view('common/leftmenu');?>
<!--leftmenu-->
 <?php
if($this->router->fetch_method()=='view') { 
$page_title=$view_pages['page_title'];
$expect_url=$view_pages['expect_url'];
$content=$view_pages['content'];

}
?>




 <div id="page_content">
    <div id="page_content_inner">

        <div class="uk-grid blog_article" data-uk-grid-margin>
            <div class="uk-width-medium-3-4">
                <div class="md-card">
                    <div class="md-card-content large-padding">
                        <div class="uk-article">
                            <h1 class="uk-article-title"> <?php echo $page_title;?></p></h1>
                            <p class="uk-article-meta">
                               <?php echo $expect_url;?>
                            </p>
                            <p class="uk-article-lead">Static Page Content</p>
                            <hr class="uk-article-divider">
                            <p>
                                <?php echo $content;?>
                              </p>

                        </div>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</div>

                              
                          
              
              


 
    



       
            
       
             
                
         
            

   
    
<script type="text/javascript">
  


  
$('#product_id').on('change',function(){
      $.ajax({
            type: 'POST',
            url: WEB_URL+"user_subscriptions/get_subscriptions/"+$(this).val(),
            async: true,
            dataType: 'json',
           success: function(data) {

       $('#subscription_id').html(data);
            }
          });
       });



</script>
