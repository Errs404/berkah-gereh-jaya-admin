@extends('layouts.admin')

@section('title', 'Order Management — Berkah Gereh Jaya')
@section('page', 'orders')
@section('body_class', 'order-management')

@push('scripts')
  @vite(['resources/js/pages/orders.js'])
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

  <div x-data="orderTable" x-init="init()">

    {{-- stats / chart block bisa kamu pecah jadi partial juga kalau mau --}}
    {{-- @include('orders.partials.stats') --}}
    {{-- @include('orders.partials.charts') --}}

    <div class="card">
      <div class="card-header">
        {{-- filter toolbar tetap di sini atau dijadikan partial --}}
        ...
      </div>

      <div class="card-body p-0">
        {{-- bulk bar --}}
        ...

        @include('orders.partials.table', ['orders' => $orders])
        @include('orders.partials.pagination', ['orders' => $orders])
      </div>
    </div>

  </div>

  {{-- Modals --}}
  @include('orders.partials.modal-order' /* , ['barangs' => $barangs] */)
  @include('orders.partials.modal-bulk-update')
@endsection
