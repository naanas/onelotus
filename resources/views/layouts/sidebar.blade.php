<nav class="sidebar">
  <div class="sidebar-header">
    <a href=" {{ url('/home') }} " class="sidebar-brand">
      <!----  
    ONE<span>Lotus</span>
    --->
      <img src="{{ asset('assets/images/logo2.png')}}" alt="logo">
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Data Pasien</li>
      <li class="nav-item {{ active_class(['home']) }}">
        <a href="{{ url('/home') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Data Pasien</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['pasien']) }}">
        <a href="{{ url('/pasien') }}" class="nav-link">
          <i class="link-icon" data-feather="file-text"></i>
          <span class="link-title">Rekap Data</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['tambah-pasien']) }}">
        <a href="{{ url('/tambah-pasien') }}" class="nav-link">
          <i class="link-icon" data-feather="plus-square"></i>
          <span class="link-title">Tambah Pasien</span>
        </a>
      </li>
      <li class="nav-item {{ active_class(['result-form']) }}">
        <a href="{{ url('/result-form') }}" class="nav-link">
          <i class="link-icon" data-feather="plus-square"></i>
          <span class="link-title">Formulir</span>
        </a>
      </li>
      <li class="nav-item nav-category">Export</li>
      <li class="nav-item {{ active_class(['export']) }}">
        <a href="{{ url('/export') }}" class="nav-link">
          <i class="link-icon" data-feather="archive"></i>
          <span class="link-title">Export Excel</span>
        </a>
      </li>
      @role('admin')
      <li class="nav-item nav-category">Admin</li>
      <li class="nav-item {{ active_class(['user']) }}">
        <a href="{{ url('/user') }}" class="nav-link">
          <i class="link-icon" data-feather="list"></i>
          <span class="link-title">User Management</span>
        </a>
      </li>
      @endrole
    </ul>
  </div>
</nav>
<!-----
<nav class="settings-sidebar">
  <div class="sidebar-body">
    <a href="#" class="settings-sidebar-toggler">
      <i data-feather="settings"></i>
    </a>
    <h6 class="text-muted">Sidebar:</h6>
    <div class="form-group border-bottom">
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight" value="sidebar-light" checked>
          Light
        </label>
      </div>
      <div class="form-check form-check-inline">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark" value="sidebar-dark">
          Dark
        </label>
      </div>
    </div>
  </div>
</nav>
------>