<div class="container-fluid py-4" id="app">
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <a href="../../apps/wallet">
                <div class="card bg-gradient-warning">
                    <div class="card-body p-3">
                        <div class="row c-pointer text-white">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Capital total</p>
                                    <h5 class="font-weight-bolder text-white mb-0">
                                        $ {{ stats.totalCapital.numberFormat(2) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                    <i class="bi bi-wallet text-lg text-dark opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Inversiones de usuarios</p>
                                <h5 class="font-weight-bolder mb-0">
                                    $ {{ stats.totalDeposit.numberFormat(2)}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Retiros</p>
                                <h5 class="font-weight-bolder mb-0">
                                $ {{ stats.totalWithdraws.numberFormat(2)}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Ganancias de usuarios</p>
                                <h5 class="font-weight-bolder mb-0">
                                    $ {{ stats.totalProfits.numberFormat(2)}}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                Capital invertido por broker 5 días atrás
                </div>
                <div class="card-body">
                    <canvas id="myChart" width="100%" height="425"></canvas>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="row mb-3">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Retiros pendientes</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ stats.pendingWithdraws.numberFormat(0)}}
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Usuarios registrados</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ stats.totalUsers.numberFormat(0)}}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChartPie" width="100%" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="brokers" class="row">
        <div v-for="broker in brokers"
            class="col">
            <div class="card bg-gradient-lisght">
                <div class="card-body">
                    <div class="mb-3">
                        <h5>{{ broker.name }}
                            <span class="text-success text-sm font-weight-bolder">
                                {{ broker.percentaje.numberFormat(2) }} % 
                            </span>
                        </h5>
                    </div>
                
                    <div class="row numbers">
                        <div class="col">
                            <p class="text-sm mb-0 text-capitalize text-dark font-weight-bold">Inversión (AVG)</p>
                            <h5 class="font-weight-bolder text-primary mb-0">
                                $ {{ broker.capitalAvg.numberFormat(2) }} 
                            </h5>
                        </div>
                        <div class="col text-end">
                            <p class="text-sm mb-0 text-capitalize text-dark font-weight-bold">Ganancia (AVG)</p>
                            <h5 class="font-weight-bolder text-primary mb-0">
                                $ {{ broker.gainAvg.numberFormat(2) }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>