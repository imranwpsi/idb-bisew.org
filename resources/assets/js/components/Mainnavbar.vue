<template>
<nav>
    <div class="megamenu_container">
        <a id="megamenu-button-mobile" href="#">Menu</a><!-- Menu button responsive-->
        <!-- Begin Mega Menu Container -->
        <ul class="megamenu">
            <!-- Begin Mega Menu -->

            <li v-for="menu in menus" :key="menu.id"><a :href="menu.url" :class="{'drop-down-icon':menu.childmenu.length>0}"  class="drop-down">{{ menu.name }}</a>
                <div class="drop-down-container" v-if="menu.url==null">
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-3" v-for="childmenu in menu.childmenu" v-if="menu.id==childmenu.parent_id">
                                    <h5><a href="#"><i class="icon-book"></i>{{ childmenu.name }}</a></h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </li>

            <!-- <li><a href="javascript:void(0)" class="drop-down">IT Scholarship Project</a>
            <div class="drop-down-container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Quick links</h4>
                        <ul class="list-menu">
                            <li><a href="all-courses.html" title="Apply for IT Scholarship">Apply for IT Scholarship</a></li>
                            <li><a href="course-detail.html" title="PIS for IT Project">PIS for IT Project</a></li>
                            <li><a href="staff.html" title="TSP Enlistment for ITP">TSP Enlistment for ITP</a></li>
                            <li><a href="contact.html" title="Career Hub">Career Hub</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project Objective</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project Overview</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project's Outcome</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Features & Benefits</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Training & Assessment</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Training Courses</a></h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </li>

            <li><a href="javascript:void(0)" class="drop-down">Vocational Training</a>
            <div class="drop-down-container">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Quick links</h4>
                        <ul class="list-menu">
                            <li><a href="all-courses.html" title="Apply for Vocational">Apply for Vocational</a></li>
                            <li><a href="course-detail.html" title="PIS for VTP">PIS for VTP</a></li>
                            <li><a href="staff.html" title="TSP Enlistment for VTP">TSP Enlistment for VTP</a></li>
                            <li><a href="contact.html" title="FAQ">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project Objective</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project Overview</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Unique Features</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Project Datasheet</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Selected Trades & Training</a></h5>
                            </div>
                            <div class="col-md-3">
                                <h5><a href="#"><i class="icon-book"></i>Training Courses</a></h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </li> -->

        </ul><!-- End Mega Menu -->
    </div>
</nav>
</template>
<script>
	export default{
        data(){
			return{
                menus:{},
                errors:{},
            }
        },
		mounted(){
			axios.post('admin/getMenu')
			.then((response)=> {
                this.menus = response.data
            })
			.catch((error) => this.errors = error.response.data.errors)
        },
        methods: {
        }
	}
</script>
