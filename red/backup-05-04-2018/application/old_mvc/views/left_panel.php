<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;z-index:0;min-height:0px;">
    <div class="navbar-default sidebar" style="margin-top:0px;" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <div style="clear:both;"></div>
                <li>
                    <a href="<?php echo site_url(); ?>/home/dashboard"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/home/searchengine"><i class="fa fa-edit fa-fw"></i> Search Engine</a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/home/user_profile"><i class="fa fa-dashboard fa-fw"></i> Manage Profile<span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/home/manage_deposit"><i class="fa fa-table fa-fw"></i> Manage Deposit's<span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>/home/markup_list"><i class="fa fa-edit fa-fw"></i> Manage Markups<span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Manage Sub-Agents<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="<?php echo site_url(); ?>/home/subagent_list">Sub-Agent List</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/home/add_subagent">Add Sub-Agent</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/home/subagent_markup">Sub-Agent Markup</a>
                        </li>
                        <li>
                            <a href="<?php echo site_url(); ?>/home/subagent_deposit">Sub-Agent Deposit's</a>
                        </li>
                    </ul>
                </li>
<!--                <li>
                    <a href="#"><i class="fa fa-dashboard fa-fw"></i> Credit and Debit Notes<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="#">Credit Notes</a>
                        </li>
                        <li>
                            <a href="#">Debit Notes</a>
                        </li>
                    </ul>
                </li>-->
<!--                <li>
                    <a href="#"><i class="fa fa-table fa-fw"></i> Agent Ledger<span class="fa arrow"></span></a>
                </li>-->
                <li>
                    <a href="#"><i class="fa fa-dashboard fa-fw"></i> Manage Bookings<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="<?php echo site_url(); ?>/home/mybookings">My Bookings</a>
                        </li>
                        <li>
                            <a href="#">Sub-Agent Bookings</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>