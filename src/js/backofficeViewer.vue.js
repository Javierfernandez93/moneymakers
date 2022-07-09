import { User } from '../../src/js/user.module.js?t=3'   

const BackofficeViewer = {
    name : 'backoffice-viewer',
    props : [],
    emits : [],
    data() {
        return {
            User : new User,
            academy: {}
        }
    },
    watch : {
        
    },
    methods: {
        getConfig: function(_config)
        {
            return this.academy.configs.filter((config)=>{
                return config.config == _config
            })[0]['value']
        },
        getAcademyConfig: function()
        {
            this.User.getAcademyConfig({},(response)=>{
                if(response.s == 1)
                {
                    this.academy = response.academy
                    this.academy.logo = this.getConfig('logo')

                    console.log(this.academy)
                }
            })
        }
    },
    updated() {
    },
    mounted() 
    {   
        this.getAcademyConfig()
    },
    template : `
        <div class="row">
            <div class="col-12">
                <div class="card bg-gradient-light">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="row justify-content-center">
                                <div class="col-xl-2">
                                    <img :src="academy.logo" class="img-fluid">
                                </div>
                            </div>
                            <div class="fs-3 fw-semibold">Completa estos pasos </div>
                            <div class="fs-4">para tu independencia financiera</div>
                        </div>

                        <div class="row py-3 d-flex align-items-center">
                            <div class="col-xl-4 cursor-pointer step text-primary fw-semibold">
                                <i class="bi bi-check-circle-fill"></i> Obtener una suscripción
                            </div>
                            <div class="col-xl-4 cursor-pointer step text-muted">
                                <i class="bi bi-clock-history"></i> Edúcate
                            </div>
                            <div class="col-xl-4 cursor-pointer step text-muted">
                                <i class="bi bi-clock-history"></i> Refiere clientes
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
}

export { BackofficeViewer } 