
/**
 * import vue-router start
*/
import Vue from 'vue'
import VueRouter from 'vue-router'

var VueTruncate = require('vue-truncate-filter')
Vue.use(VueRouter)

Vue.use(VueTruncate)
/**
 * import vue-router end
*/

require('./bootstrap');

window.Vue = require('vue');

/**
 *  Initialise the component required file start */

/* Main section start */
let Mainheader = require('./components/Mainheader.vue');
let Mainnavbar = require('./components/Mainnavbar.vue');
let Mainbanner = require('./components/Mainbanner.vue');
let Courseinfo = require('./components/Courseinfo.vue');
let Mainservices = require('./components/Mainservices.vue');
let Mainportfolio = require('./components/Mainportfolio.vue');
let Maincounter = require('./components/Maincounter.vue');
let Mainpricing = require('./components/Mainpricing.vue');
let Mainaction = require('./components/Mainaction.vue');
let Mainteam = require('./components/Mainteam.vue');
let Maintestimonial = require('./components/Maintestimonial.vue');
let Mainblog = require('./components/Mainblog.vue');
let Recentshots = require('./components/Recentshots.vue');
let Maincontact = require('./components/Maincontact.vue');
let Mainfooter = require('./components/Mainfooter.vue');
/* Main section end */



/* admin section start */
let Myheader = require('./components/admin/Myheader.vue');
let Leftsidebar = require('./components/admin/Leftsidebar.vue');

let Admin = require('./components/admin/Admin.vue');
let Menubar = require('./components/admin/Menubar.vue');
let Banner = require('./components/admin/Banner.vue');
let Project = require('./components/admin/Project.vue');
/* admin section end */

/* Initialise the component required file start */

const routes = [
    { 
        path: '/admin',
        name: 'admin', 
        component: Admin,
        children: [
            {
                path: 'menubar',
                name: 'admin.menubar', 
                component: Menubar
            },
            { 
                path: 'banner',
                name: 'admin.banner',  
                component: Banner 
            },
            { 
                path: 'project',
                name: 'admin.project',  
                component: Project 
            },
        ] 
    },
    // {
    //     path: '/admin/menubar',
    //     name: 'admin.menubar', 
    //     component: Menubar,
    // },
    // {
    //     path: '/admin/banner',
    //     name: 'admin.banner',
    //     component: Banner,
    // }
  ]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const app = new Vue({
    el: '#app',
    router,
    components:{ Mainheader, Mainnavbar, Mainbanner, Courseinfo, Mainservices, Mainportfolio, Maincounter, Mainpricing, Mainaction, Mainteam, Maintestimonial, Mainblog, Recentshots, Maincontact, Mainfooter, Myheader, Leftsidebar }
});