<template>
    <!-- Main sidebar -->
    <div class="sidebar sidebar-main">
        <div class="sidebar-content">

            <!-- User menu -->
            <div class="sidebar-user">
                <div class="category-content">
                    <div class="media">
                        <a href="#" class="media-left"><img src="/admin_assets/images/demo/users/face11.jpg" class="img-circle img-sm" alt=""></a>
                        <div class="media-body">
                            <span class="media-heading text-semibold">Md. Imran Hossain</span>
                            <div class="text-size-mini text-muted">
                                <i class="icon-pin text-size-small"></i> &nbsp;Dhaka, Bangladesh
                            </div>
                        </div>

                        <div class="media-right media-middle">
                            <ul class="icons-list">
                                <li>
                                    <a href="#"><i class="icon-cog3"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /user menu -->


            <!-- Main navigation -->
            <div class="sidebar-category sidebar-category-visible">
                <div class="category-content no-padding">
                    <ul class="navigation navigation-main navigation-accordion">

                        <!-- Main -->
                        <li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
                        <li><router-link to="/admin"><i class="icon-home4"></i> <span>Dashboard</span></router-link></li>
                        <li><router-link to="/admin/menubar"><i class="icon-menu3"></i> Menubar</router-link></li>
                        <li><router-link to="/admin/banner"><i class="icon-image2"></i> Banner</router-link></li>
                        <li><router-link to="/admin/project"><i class="icon-image2"></i> Projects</router-link></li>
                        <li>
                            <a href="#"><i class="icon-wrench3"></i> <span>Front-End Settings</span></a>
                            <ul>
                                <li><router-link to="/admin/menubar"> Menubar</router-link></li>
                                <!-- <li>
                                    <a href="#">Menu Setting</a>
                                    <ul>
                                        <li><router-link to="/admin/Menubar">List Menubar</router-link></li>
                                        <li><a href="invoice_grid.html">Create Menubar</a></li>
                                    </ul>
                                </li> -->
                            </ul>
                        </li>


                    </ul>
                </div>
            </div>
            <!-- /main navigation -->

        </div>
    </div>
    <!-- /main sidebar -->
</template>
