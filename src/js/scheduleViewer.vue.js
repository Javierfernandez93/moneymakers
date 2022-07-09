import { User } from '../../src/js/user.module.js?t=3'   

const ScheduleViewer = {
    name : 'scheduleuser-viewer',
    props : [],
    emits : [],
    data() {
        return {
            User : new User,
            schedules : [
                {
                    day: '6 julio - Miércoles',
                    sessions:  [
                        {
                            names: 'Héctor Goméz',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package',
                            time: '20:00',
                            zoomEnabled: true,
                            users: 32,
                        },
                        {
                            names: 'Francisco Hernández',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package 2',
                            time: '21:00',
                            zoomEnabled: true,
                            users: 120,
                        }
                    ]
                },
                {
                    day: '7 julio - Jueves',
                    sessions:  [
                        {
                            names: 'Héctor Goméz',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package',
                            time: '20:00',
                            zoomEnabled: true,
                            users: 32,
                        },
                    ]
                },
                {
                    day: '8 julio - Viernes',
                    sessions:  [
                        {
                            names: 'Héctor Goméz',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package',
                            time: '20:00',
                            zoomEnabled: true,
                            users: 32,
                        },
                        {
                            names: 'Héctor Goméz',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package',
                            time: '20:00',
                            zoomEnabled: true,
                            users: 32,
                        },
                        {
                            names: 'Héctor Goméz',
                            image: 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8b/Jackie_Chan_July_2016.jpg/640px-Jackie_Chan_July_2016.jpg',
                            topic: 'Forex package',
                            time: '20:00',
                            zoomEnabled: true,
                            users: 32,
                        },
                    ]
                },
                {
                    day: '9 julio - Sábado',
                    sessions:  [
                    ]
                },
            ]
        }
    },
    watch : {
        
    },
    methods: {
       
    },
    updated() {
    },
    mounted() 
    {   
    },
    template : `
        <div class="row mb-4">
            <div class="col-12">
                <div class="row mb-3 d-flex align-items-center text-dark fs-3 fw-semibold">
                    <div class="col">
                        <div><i class="bi bi-calendar4-range fs-5"></i> Sesiones disponibles</div>
                    </div>
                    <div class="col-auto text-muted">
                        <span class="px-1"><i class="bi bi-arrow-left-circle-fill"></i></span>
                        <span><i class="bi bi-arrow-right-circle-fill"></i></span>
                    </div>
                </div>
                <div class="row">
                    <div v-for="schedule in schedules" 
                        class="col-xl-3">
                        <div class="fw-semibold text-dark mb-3">{{ schedule.day }}</div>

                        <div
                            v-if="schedule.sessions.length > 0">
                            <div
                                v-for="session in schedule.sessions" 
                                class="card mb-3 cursor-pointer bg-light shadow-none mm-session">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-auto">
                                            <div class="avatar avatar-sm avatar-editable overflow-hidden">
                                                <img :src="session.image" class="w-100 border-radius-lg shadow-sm">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="fw-semibold text-dark">{{session.names}}</div>
                                            <div>{{session.topic}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <span class="badge bg-white text-secondary">
                                                {{session.time}}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row text-xs">
                                        <div class="col">
                                            <div v-if="session.zoomEnabled"
                                                class="text-primary">
                                                <u>Por Zoom.com</u>
                                            </div>
                                        </div>
                                        <div class="col text-end">
                                            <div class="fw-semiold">Inscritos <span class="fw-bold">{{session.users}}</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-else>
                            <div class="card opacity-25">
                                <div class="card-body text-center">
                                    Sin evento
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
}

export { ScheduleViewer } 