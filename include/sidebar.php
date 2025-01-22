<aside class="left-sidebar">
  <!-- Sidebar scroll-->
  <div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
      <a href="index.php" class="text-nowrap logo-img">
        <img src="../assets/W.png" width="180" alt="" />
      </a>
      <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
        <i class="ti ti-x fs-8"></i>
      </div>
    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
      <ul id="sidebarnav">
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Home</span>
        </li>
        <li class="sidebar-item">
          <a class="sidebar-link" href="index.php" aria-expanded="false">
            <span>
              <i class="ti ti-layout-dashboard"></i>
            </span>
            <span class="hide-menu">Dashboard</span>
          </a>
        </li>
        <li class="nav-small-cap">
          <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
          <span class="hide-menu">Content</span>
        </li>
        <?php if($session['role'] == 'siswa'){ ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="riwayat-kunjungan.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">RIWAYAT HOME VISIT</span>
          </a>
        </li>
        <?php } ?>
        <?php if($session['role'] == 'admin'){ ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="data-siswa.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">KELOLA SISWA/I</span>
          </a>
        </li>
        <?php } ?>
        <?php if($session['role'] == 'guru_bk'){ ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="data-siswa.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">DATA SISWA/I</span>
          </a>
        </li>
        <?php } ?>
        <?php if($session['role'] == 'admin'){ ?>
        <li class="sidebar-item">
          <a class="sidebar-link" href="data-guru.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">KELOLA DATA GURU BK</span>
          </a>
        </li>
        <?php  } ?>
        <?php if($session['role'] == 'guru_bk'){ ?>

        <li class="sidebar-item">
          <a class="sidebar-link" href="data-home-visit.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">KELOLA HOME VISIT</span>
          </a>
        </li>
        <?php  } ?>
        <?php if($session['role'] == 'guru_bk' || $session['role'] == 'kepala_sekolah'){ ?>

        <li class="sidebar-item">
          <a class="sidebar-link" href="data-laporan-visit.php" aria-expanded="false">
            <span>
              <i class="ti ti-article"></i>
            </span>
            <span class="hide-menu">CETAK LAPORAN</span>
          </a>
        </li>
        <?php  } ?>

      </ul>

    </nav>
    <!-- End Sidebar navigation -->
  </div>
  <!-- End Sidebar scroll-->
</aside>