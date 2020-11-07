window.Vue = require('vue');
import VueRouter from "vue-router";
Vue.use(VueRouter)
const routes = [



//Backends
{
//Settings
path:"/admin/configuration",
name:"settings",
component: require('./components/dashboard/settings/index').default
},
{
//category
path:"/admin/category",
name:"category",
component: require('./components/dashboard/category/index').default
},
//Area
{
path:"/admin/area",
name:"area",
component: require('./components/dashboard/area/index').default
},
//Area
{
    path:"/admin/packages",
    name:"packages",
    component: require('./components/dashboard/packages').default
    },
//Users

{
    path:"/admin/users",
    name:"users",
    component: require('./components/dashboard/users/index').default
    },
    //Business
    //Profile 

    

            {
                path:"/add/feild",
                name:"add.feild",
                component: require('./components/feilds/tables').default
                },
                
        //end profile
    //Front
    //post



        //end post
        //uer account
    

        {
            path:"/user/account/",
            name:"user.account",
            component: require('./components/user/account').default
            },


]
    const router = new VueRouter({
        mode: 'history',
        routes,
    
    })
    
    
    export default router;