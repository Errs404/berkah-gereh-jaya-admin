<!-- Chart Section -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Keuntungan & Bruto Overview</h5>
                <div class="btn-group btn-group-sm" role="group">
                    <button type="button" class="btn btn-outline-primary active" data-chart-period="7d">7D</button>
                    <button type="button" class="btn btn-outline-primary" data-chart-period="30d">30D</button>
                    <button type="button" class="btn btn-outline-primary" data-chart-period="90d">90D</button>
                    <button type="button" class="btn btn-outline-primary" data-chart-period="1y">1Y</button>
                </div>
            </div>
            <div class="card-body">
                <canvas id="revenueChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Activity</h5>
            </div>
            <div class="card-body">
                <div class="activity-feed">
                    <div class="activity-item">
                        <div class="activity-icon bg-primary bg-opacity-10 text-primary">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">New user registered</p>
                            <small class="text-muted">2 minutes ago</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-success bg-opacity-10 text-success">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">Order #1234 completed</p>
                            <small class="text-muted">5 minutes ago</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">Server maintenance scheduled</p>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <p class="mb-1">Server maintenance scheduled</p>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>