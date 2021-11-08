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
                    <!-- <img src="<?=base_url('assets/templates/images/user.png')?>" width="48" height="48" alt="User" /> -->
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
                        <!-- <a href="<?=base_url()?>">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a> -->
                        <?php

                            if(@$this->session->userdata['permission']['QASU1']['de'] OR @$this->session->userdata['permission']['QASU3']['de'] OR @$this->session->userdata['permission']['QASU4']['de'] OR @$this->session->userdata['permission']['QASU5']['de'] OR @$this->session->userdata['permission']['PRODSU2']['de'] OR @$this->session->userdata['permission']['ENGSU3']['de']) 
                            { ?>
                             
                                <a href="<?=base_url('SuperUser/homepage')?>">
                                    <i class="material-icons">home</i>
                                    <span>Home</span>
                                </a>
                      <?php }
                            else{
                                ?>
                                    <a href="<?=base_url()?>">
                                        <i class="material-icons">home</i>
                                        <span>Home</span>
                                    </a>
                            <?php }
                        ?>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">pages</i>
                            <span>QAN</span>
                        </a>
                        <ul class="ml-menu">
                            <?php 
        
                                $hidemenu = '';
                                if(@$this->session->userdata['permission']['S6']['view'] OR @$this->session->userdata['permission']['S6']['de']) {

                                    $hidemenu = 'hidemenu';

                                    echo    '<li id="'.$hidemenu.'">
                                                <a href="FrontEnd/mastertemplate">
                                                    <i class="material-icons">assignment</i>
                                                    <span>CREATE NEW MACHINE BREAKDOWN FORM</span>
                                                </a>
                                            </li>';
                                }
                            ?>
                            <li>
                                <!-- <a href="<?=base_url('FrontEnd/dashboard_closed_ticket')?>">
                                    <i class="material-icons">view_list</i>
                                    <span>ALL CLOSED TICKETS</span>
                                </a> -->

                            <?php

                                if(@$this->session->userdata['permission']['QASU1']['de'] OR @$this->session->userdata['permission']['QASU3']['de'] OR @$this->session->userdata['permission']['QASU4']['de'] OR @$this->session->userdata['permission']['QASU5']['de'] OR @$this->session->userdata['permission']['PRODSU2']['de'] OR @$this->session->userdata['permission']['ENGSU3']['de']) 
                                { ?>
                                
                                    <a href="<?=base_url('SuperUser/dashboard_closed_ticket')?>">
                                        <i class="material-icons">view_list</i>
                                        <span>ALL CLOSED TICKETS</span>
                                    </a>
                                <?php }
                                else{
                                    ?>
                                    <a href="<?=base_url('FrontEnd/dashboard_closed_ticket')?>">
                                        <i class="material-icons">view_list</i>
                                        <span>ALL CLOSED TICKETS</span>
                                    </a>
                                <?php } ?>
                            </li>
                        </ul>
                    </li>
                    <?php
                    
                        $hideconf = '';
                        if(@$this->session->userdata['permission']['C1']['de'] OR @$this->session->userdata['permission']['C1.1']['de'] OR @$this->session->userdata['permission']['C1.2']['de'] OR @$this->session->userdata['permission']['C1.3']['de']OR @$this->session->userdata['permission']['C1.4']['de']) 
                        {

                            $hideconf = 'hideconf';
                        
                        echo    '<li class="header" id="'.$hideconf.'">CONFIGURATION</li>';
                        echo    '<li>
                                    <a href="javascript:void(0);" class="menu-toggle">
                                        <i class="material-icons">person</i>
                                        <span>Administrator</span>
                                    </a>
                                    <ul class="ml-menu">
                                        <li>
                                            <a href="register">
                                                <i class="material-icons">assignment</i>
                                                <span>User Registration Form</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_user_info">
                                                <i class="material-icons">view_list</i>
                                                <span>View User Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_role_permission">
                                                <i class="material-icons">card_membership</i>
                                                <span>User Permission & Role Management</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="view_setting">
                                                <i class="material-icons">settings</i>
                                                <span>Setting Management</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>';
                        }
                    ?>
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