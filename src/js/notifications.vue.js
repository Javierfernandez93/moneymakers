import { User } from '../../src/js/user.module.js?t=3'

/* vue */
import { ProfitViewer } from '../../src/js/profitViewer.vue.js?t=1'

Vue.createApp({
    components : { 
        ProfitViewer
    },
    data() {
        return {
            User : null,
            notifications : {},
        }
    },
    watch : {
        user : {
            handler() {
                
            },
            deep: true
        },
    },
    methods: {
        getNotifications : function() {
            this.User.getNotifications({},(response)=>{
                if(response.s == 1)
                {
                    this.notifications = response.notifications.map((notification)=>{
                        notification['create_date'] = new Date(notification['create_date']*1000).toLocaleDateString()
                        return notification
                    })
                }
            })
        },
    },
    mounted() 
    {
        this.User = new User
        this.getNotifications()
    },
}).mount('#app')