// import { User } from '../../src/js/user.module.js?t=3'

/* vue */ 
import { BackofficeViewer } from '../../src/js/backofficeViewer.vue.js'
import { ScheduleViewer } from '../../src/js/scheduleViewer.vue.js'

Vue.createApp({
    components : { 
        BackofficeViewer, ScheduleViewer
    },
    data() {
        return {
        }
    },
    methods: {
    },
    mounted() 
    {
    },
}).mount('#app')