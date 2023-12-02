<div class="vd_title-section clearfix">
  <div class="row">
    <div class="vd_panel-header col-sm-4">
      <h2>Manage Products</h2>
    </div>
    <div class="col-sm-8" style="text-align:right;">
      <a class="btn vd_btn vd_bg-blue font-semibold" href="products.php?action=add_product">Create Product</a>
    </div>
  </div>
</div>


<div class="vd_content-section clearfix"><div class="row">
              <div class="col-md-12">
                <div class="panel widget">                  
                  <div class="panel-heading vd_bg-grey">
                    <h3 class="panel-title"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span>All Products</h3>
                  </div>
                  <div class="panel-body table-responsive">
                     <table class="table table-striped" id="data-tables">
                      <thead>
                        <tr>
                          <th>Image</th>
                          <th>Tittle</th>
                          <th>Product Id</th>
                          <th>Today's Deal</th>
                          <th>offer</th>
                          <th>Featured</th>
                          <th>Options</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $get_product="SELECT * FROM products WHERE status='1' ";
                          $run_product=mysqli_query($conn,$get_product);
                          while($row_product=mysqli_fetch_array($run_product)){
                            $product_name=$row_product['pro_name'];
                            $pro_id=$row_product['pro_id'];
                            $product_img=$row_product['image_1'];
                            $featured=$row_product['featured'];
                            
                            $deal=$row_product['deal'];
                            
                            $offer=$row_product['offer'];
                            

                          echo "<tr class='odd gradeX'>
                              <td><img src='product_images/$product_img' height='40' width='40' style='border:1px solid black;''></td>
                              <td>$product_name</td>
                              <td><p>$pro_id</p></td>
                              <td><input type='checkbox' data-rel='switch' data-size='mini' data-wrapper-class='yellow' name='remember' id='remember'  > </td>
                              <td><input type='checkbox' data-rel='switch' data-size='mini' data-wrapper-class='yellow' > </td>
                              <td class='center'> <input type='checkbox' data-rel='switch' data-size='mini' data-wrapper-class='yellow' > </td>
                              <td class='menu-action'>
                                <a href='../details.php?pro_id=$pro_id' target='_blank' data-original-title='view' data-toggle='tooltip' data-placement='top' class='btn menu-icon vd_bd-grey vd_grey'> <i class='fa fa-eye'></i> </a> 
                                <a data-original-title='
                                ' data-toggle='tooltip' data-placement='top' class='btn menu-icon  vd_bd-grey vd_grey' name='edit_product' href='edit_products.php?pro_id=$pro_id'> <i class='fa fa-pencil'></i> </a> 
                                <a data-original-title='delete' data-toggle='tooltip' data-placement='top' class='btn menu-icon  vd_bd-grey vd_grey' href='del_product.php?del_pro_id=$pro_id'> <i class='fa fa-times'></i> </a>
                              
                                  <a class='btn menu-icon  vd_bd-grey vd_grey' href='download_material.php?id=$pro_id'style='float:right;padding-right:4px;'>
                                      <i class='ace-icon fa fa-download bigger-130'></i>
                                    </a>


                              </td>

                            </tr>
                           

                            ";

                          }
                          
                        ?>   

                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- Panel Widget --> 
              </div>
              <!-- col-md-12 -->  
            </div>
            </div>