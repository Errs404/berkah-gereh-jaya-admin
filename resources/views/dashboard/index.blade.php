@extends('layouts.admin')

@section('title', 'Dashboard — Berkah Gereh Jaya')
@section('page', 'dashboard')
@section('body_class', 'admin-layout')

@section('loading')
  <div id="loading-screen" class="loading-screen">
    <div class="loading-spinner">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
  </div>
@endsection

@push('modals')
  @include('partials.modals.icon-demo')
@endpush

@push('scripts')
  {{-- jika pakai Vite --}}
  {{-- @vite(['resources/js/pages/dashboard.js']) --}}

  {{-- jika tidak pakai Vite, kamu bisa taruh di public/assets/dashboard.js --}}
  <script src="{{ asset('assets/dashboard.js') }}"></script>
@endpush

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-0">Dashboard</h1>
      <p class="text-muted mb-0">
        Dashboard modern untuk mengelola distributor, barang, stok, retur, dan laporan bulanan dengan mudah.
      </p>
    </div>
  </div>

  @include('dashboard.partials.stats')
  @include('dashboard.partials.charts')
  @include('dashboard.partials.recent-orders')
@endsection
