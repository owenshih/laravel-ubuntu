import VueRouter from 'vue-router'
import Store from './store/index.js'


let routes = [
    {
        path: '/',
        name: 'home',
        component: require('./components/Home.vue')
    },

    {
        path: '/register',
        name: 'register',
        component: require('./components/register/register.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: require('./components/auth/login.vue')
    },
    {
        path: '/information',
        name: 'information',
        component: require('./components/personal/information.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/information/password',
        name: 'information.password',
        component: require('./components/personal/password.vue'),
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/website/index_carousel',
        name: 'website.index_carousel',
        component: require('./components/website/index_carousel.vue')
    },
    {
        path: '/website/landspace',
        name: 'website.landspace',
        component: require('./components/website/landspace.vue')
    },
    {
        path: '/website/partner',
        name: 'website.partner',
        component: require('./components/website/partner.vue')
    },
    {
        path: '/website/active_carousel',
        name: 'website.active_carousel',
        component: require('./components/website/active_carousel.vue')
    },
    {
        path: '/website/active_card',
        name: 'website.active_card',
        component: require('./components/website/active_card.vue')
    },
    {
        path: '/website/active_album',
        name: 'website.active_album',
        component: require('./components/website/active_album.vue')
    },
    {
        path: '/website/diary',
        name: 'website.diary',
        component: require('./components/website/diary.vue')
    },
    {
        path: '/website/industry',
        name: 'website.industry',
        component: require('./components/website/industry.vue')
    },
    {
        path: '/website/faq',
        name: 'website.faq',
        component: require('./components/website/faq.vue')
    },
    {
        path: '/message/text_message',
        name: 'message.text_message',
        component: require('./components/message/text_message.vue')
    },
    {
        path: '/hotel',
        name: 'hotel',
        component: require('./components/hotel/index.vue')
    },
    {
        path: '/hotel/cooperation',
        name: 'hotel.cooperation',
        component: require('./components/hotel/cooperation.vue')
    },
    {
        path: '/hotel/create',
        name: 'hotel.create',
        component: require('./components/hotel/create.vue')
    },
    {
        path: '/hotel/:id/edit',
        name: 'hotel.edit',
        component: require('./components/hotel/edit.vue')
    },
    {
        path: '/hotel/console',
        name: 'hotel.console',
        component: require('./components/hotel/console.vue')
    },
    {
        path: '/sales/track',
        name: 'sales.track',
        component: require('./components/sales/track.vue')
    },
    {
        path: '/sales/record',
        name: 'sales.record',
        component: require('./components/sales/record.vue')
    },
    {
        path: '/funding',
        name: 'funding',
        component: require('./components/funding/index.vue')
    },
    {
        path: '/funding/:id/edit',
        name: 'funding.edit',
        component: require('./components/funding/edit.vue')
    },
    {
        path: '/funding/console',
        name: 'funding.console',
        component: require('./components/funding/console.vue')
    }

]


const router = new VueRouter({
    mode:'history',
    routes: routes,
});


// router.beforeEach(function(to,from,next){
//     if(to.meta.requiresAuth){
//         if(Store.state.AuthUser.authenticated){
//             return next()
//         }else{
//             window.location="https://active.tripmatch.net/login";
//             return next()
//         }
//     }else{
//         next()
//     }
// });

export default router

