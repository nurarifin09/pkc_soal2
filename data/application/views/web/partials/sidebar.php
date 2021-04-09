        <nav class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-brand">
                    PMMB PKC
                </a>
                <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <div class="sidebar-body">
                <ul class="nav">
                    <li class="nav-item nav-category">Menu Utama</li>
                    <li class="nav-item <?= (isset($page_title) && $page_title == 'Dashboard') ? 'active' : ''; ?>">
                        <a href="<?= base_url(); ?>" class="nav-link">
                            <i class="link-icon" data-feather="box"></i>
                            <span class="link-title">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item <?= (isset($page_title) && $page_title == 'Cari Data') ? 'active' : ''; ?>"">
                        <a href=" <?= base_url('home/cari'); ?>" class="nav-link">
                        <i class="link-icon" data-feather="search"></i>
                        <span class="link-title">Cari Data</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>