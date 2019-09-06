<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $password = ($this->session->userdata['logged_in']['password']);
        $fullname = ($this->session->userdata['logged_in']['fullname']);
        } 
        else {
          redirect('/login', 'refresh');
          // header("location: /login");
        }

?>

<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="<?=base_url('assets/templates/images/user.png')?>" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $fullname;?></div>
                    <!-- <div class="email">john.doe@example.com</div> -->
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li> -->
                            <!-- <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li> -->
                            <li role="seperator" class="divider"></li>
                            <li><a href="<?=base_url('logout')?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class='active'>
                        <a href="<?=base_url()?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>QAN</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url('FrontEnd/mastertemplate')?>">
                                    <i class="material-icons">assignment</i>
                                    <span>CREATE NEW MACHINE BREAKDOWN FORM</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('FrontEnd/dashboard_closed_ticket')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>ALL CLOSED TICKETS</span>
                                </a>
                            </li>
                            
                            <!-- <li>
                                <a href="<?=base_url('DashboardMachineBreakdown')?>">
                                    <i class="material-icons">assignment</i>
                                    <span>Machine Break Down</span>
                                </a>
                            </li>
                            <li>
                            <a href="<?=base_url('DashboardMaterialReviewBoard')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>Material Review Board</span>
                                </a>
                            </li>
                            <li>
                            <a href="<?=base_url('DashboardRootCauseFailure')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>Root Cause Failure Analysis</span>
                                </a>
                            </li>
                            <li>
                            <a href="<?=base_url('DashboardForQAUseOnly')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>Final QA Review</span>
                                </a>
                            </li> -->
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>QPM</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);">
                                    <span>List</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <span>Detail</span>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="header">CONFIGURATION</li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">person</i>
                            <span>Admin</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="<?=base_url('register')?>">
                                    <i class="material-icons">assignment</i>
                                    <span>User Registration Form</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('viewuserinfo')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>View User Details</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=base_url('ViewRolePermission')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>View Role Permission</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="<?=base_url('addnewuserroles')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>Add New User Roles</span>
                                </a>
                            </li> -->
                        </ul
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);"><?=$leftsidebar['title']?></a>
                </div>
                <div class="version">
                    <b>Version: </b> 0.1.0
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->