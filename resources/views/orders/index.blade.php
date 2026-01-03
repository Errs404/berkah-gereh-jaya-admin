@extends('layouts.admin')

@section('title', 'Order Management — Berkah Gereh Jaya')
@section('page', 'orders')
@section('body_class', 'order-management')

@push('scripts')
  {{-- Paling aman: gunakan public asset dulu --}}
  <script src="{{ asset('assets/js/pages/orders-page.js') }}"></script>
@endpush

@section('content')
  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4 mb-lg-5">
    <div>
      <h1 class="h3 mb-0">Order Management</h1>
      <p class="text-muted mb-0">Track orders, manage fulfillment, and analyze sales</p>
    </div>
    <div class="d-flex gap-2">
      <button type="button" class="btn btn-outline-secondary" data-export-orders>
        <i class="bi bi-download me-2"></i>Export
      </button>
      <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#bulkUpdateModal">
        <i class="bi bi-arrow-repeat me-2"></i>Bulk Update
      </button>
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">
        <i class="bi bi-plus-lg me-2"></i>New Order
      </button>
    </div>
  </div>

  <div x-data="orderTable()" x-init="init()">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col">
            <h5 class="card-title mb-0">Orders</h5>
          </div>
          <div class="col-auto">
            <div class="d-flex gap-2">
              <div class="position-relative">
                <input type="search" class="form-control form-control-sm" placeholder="Search orders..."
                  x-model="searchQuery" @input="filterOrders()" style="width: 200px;">
                <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-2 text-muted"></i>
              </div>

              <select class="form-select form-select-sm" x-model="statusFilter" @change="filterOrders()" style="width: 150px;">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="shipped">Shipped</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body p-0">
        <div class="bulk-actions-bar p-3 bg-light border-bottom"
          x-show="selectedOrders.length > 0" x-transition>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-muted">
              <span x-text="selectedOrders.length"></span> order(s) selected
            </span>
            <div class="d-flex gap-2">
              <button class="btn btn-sm btn-outline-secondary" @click="bulkAction('processing')">
                <i class="bi bi-arrow-clockwise me-1"></i>Mark Processing
              </button>
              <button class="btn btn-sm btn-outline-info" @click="bulkAction('shipped')">
                <i class="bi bi-truck me-1"></i>Mark Shipped
              </button>
              <button class="btn btn-sm btn-outline-success" @click="bulkAction('delivered')">
                <i class="bi bi-check-circle me-1"></i>Mark Delivered
              </button>
            </div>
          </div>
        </div>

        @include('orders.partials.table', ['orders' => $orders])
        @include('orders.partials.pagination', ['orders' => $orders])
      </div>
    </div>
  </div>

  @include('orders.partials.modal-order', ['barangs' => $barangs, 'kode_order' => $kode_order])
  @include('orders.partials.modal-bulk-update')
@endsection
