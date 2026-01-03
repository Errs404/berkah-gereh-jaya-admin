<!-- Stats Cards with Alpine.js -->
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-lg-6" x-data="statsCounter(12426, 5)">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="stats-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-box-seam"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Terjual (kg)</h6>

                        <h3 class="mb-0">
                            <span x-text="value.toLocaleString()"></span> kg
                        </h3>

                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> +12.5%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="stats-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Bruto</h6>

                        <h3 class="mb-0">
                            Rp 54.320
                        </h3>

                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> +8.2%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Keuntungan</h6>

                        <h3 class="mb-0">
                            Rp 1.852.000
                        </h3>

                        <small class="text-success">
                            <i class="bi bi-arrow-up"></i> +2.1%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-6">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="stats-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Bon</h6>

                        <h3 class="mb-0">1.852</h3>

                        <small class="text-danger">
                            <i class="bi bi-arrow-down"></i> -2.1%
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>