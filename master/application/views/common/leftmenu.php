 <!-- main sidebar -->
    <aside id="sidebar_main">
        
        <div class="sidebar_main_header">
            <div class="sidebar_logo">
                <a href="index.html" class="sSidebar_hide"><img src="<?php echo LOGO;?>" alt="" height="15" width="71"/></a>
                <a href="index.html" class="sSidebar_show"><img src="<?php echo LOGO;?>" alt="" height="32" width="32"/></a>
            </div>
            <div class="sidebar_actions">
                <select id="lang_switcher" name="lang_switcher">
                    <option value="gb" selected>English</option>
                </select>
            </div>
        </div>
        
        <div class="menu_section">
            <ul>
                <li class="<?php echo ($this->router->fetch_class()=='dashboard')?'current_section':'';?>" title="Dashboard">
                    <a href="<?php echo base_url('dashboard');?>">
                        <span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
                        <span class="menu_title">Dashboard</span>
                    </a>
                </li>

                <li class="<?php echo ($this->router->fetch_class()=='admin')?'current_section':'';?>" title="Admin">
                    <a href="<?php echo base_url('admin');?>">
                         <i class="material-icons md-36">&#xE87C;</i>
                        <span class="menu_title">Admin</span>
                    </a>
                </li>

                <li class="<?php echo ($this->router->fetch_class()=='users')?'current_section':'';?>" title="Users">
                    <a href="<?php echo base_url('users');?>">
                         <i class="material-icons md-36">&#xE87C;</i>
                        <span class="menu_title">Users</span>
                    </a>
                </li>



                <li class="<?php echo ($this->router->fetch_class()=='pages')?'current_section':'';?>" title="Pages">
                    <a href="<?php echo base_url('pages');?>">
                         <i class="material-icons md-36">&#xE24D;</i>
                        <span class="menu_title">Pages</span>
                    </a>
                </li>
               
                <!-- <li>
                    <a href="#">
                        <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                        <span class="menu_title">Forms</span>
                    </a>
                    <ul>
                        <li><a href="forms_regular.html">Regular Elements</a></li>
                        <li><a href="forms_advanced.html">Advanced Elements</a></li>
                        <li><a href="forms_file_input.html">File Input</a></li>
                        <li><a href="forms_file_upload.html">File Upload</a></li>
                        <li><a href="forms_validation.html">Validation</a></li>
                        <li><a href="forms_wizard.html">Wizard</a></li>
                        <li class="menu_subtitle">WYSIWYG Editors</li>
                        <li><a href="forms_wysiwyg_ckeditor.html">CKeditor</a></li>
                        <li><a href="forms_wysiwyg_tinymce.html">TinyMCE</a></li>
                    </ul>
                </li> -->
               
               
                
            </ul>
        </div>
    </aside><!-- main sidebar end -->

<!--leftmenu-->

 