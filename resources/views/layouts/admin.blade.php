<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
  @include('partials.meta')

  <title>@yield('title', 'Berkah Gereh Jaya — Sistem Administrasi & Manajemen')</title>

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('assets/favicon.ico') }}">
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">

  <!-- Preconnect -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Theme Color -->
  <meta name="theme-color" content="#6366f1">

  <!-- PWA Manifest -->
  <link rel="manifest" href="{{ asset('assets/manifest-DTaoG9pG.json') }}">

  <!-- Vendor JS (template kamu) -->
  <script type="module" crossorigin src="{{ asset('assets/vendor-bootstrap-C9iorZI5.js') }}"></script>
  <script type="module" crossorigin src="{{ asset('assets/vendor-charts-DGwYAWel.js') }}"></script>
  <script type="module" crossorigin src="{{ asset('assets/vendor-ui-DjYv-mAO.js') }}"></script>

  <!-- Main JS + CSS (template kamu) -->
  <script type="module" crossorigin src="{{ asset('assets/main-BHbn44Op.js') }}"></script>
  <link rel="stylesheet" crossorigin href="{{ asset('assets/main-QD_VOj1Y.css') }}">

  <!-- Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">

  @stack('styles')
</head>

<body data-page="@yield('page', '')" class="@yield('body_class', 'admin-layout')">

  {{-- Optional loading screen --}}
  @yield('loading')

  <div class="admin-wrapper" id="admin-wrapper">
    @include('partials.header')
    @include('partials.sidebar')

    <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
      <i class="bi bi-list"></i>
    </button>

    <main class="admin-main">
      <div class="container-fluid p-4 p-lg-5">
        @yield('content')
      </div>
    </main>

    @include('partials.footer')
  </div>

  @include('partials.toasts')

  {{-- page modals --}}
  @stack('modals')

  {{-- global script: sidebar toggle --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const toggleButton = document.querySelector('[data-sidebar-toggle]');
      const wrapper = document.getElementById('admin-wrapper');

      if (!toggleButton || !wrapper) return;

      const isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
      if (isCollapsed) {
        wrapper.classList.add('sidebar-collapsed');
        toggleButton.classList.add('is-active');
      }

      toggleButton.addEventListener('click', () => {
        const collapsed = wrapper.classList.toggle('sidebar-collapsed');
        toggleButton.classList.toggle('is-active', collapsed);
        localStorage.setItem('sidebar-collapsed', collapsed ? 'true' : 'false');
      });
    });
  </script>

  @stack('scripts')
</body>
</html>
