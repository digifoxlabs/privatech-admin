<body class="hold-transition layout-top-nav login-page">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand remove-background navbar-light">
            <div class="container">

                <ul class="navbar-nav">
                    <a href="<?= base_url('/') ?>" class="navbar-brand">
                        <img src="<?= base_url('public/assets/frontend/images/web-logo.png') ?>" alt="AdminLTE Logo"
                            class="brand-image img-rectangle elevation-1 my-logo" style="opacity: .8">
                        <span class="brand-text font-weight-dark text-white">PRIVATECH</span>
                    </a>

                </ul>
                
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
                </form>

                <ul class="navbar-nav ml-auto">

                <?php if(session()->get('user_type') == 'client') { ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link text-white" data-toggle="dropdown" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                           
                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="fas fa-inr mr-2"  aria-hidden="true"></i> Subscription                              
                            </a>                          
                            
                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cloud-download mr-2"  aria-hidden="true"></i> Download APK
                                <span class="float-right text-muted text-sm">7 MB</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Profile
                                
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <i class="fas fa-cog mr-2"></i> Settings                   
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer" data-toggle="modal" data-target="#modal-logout">Logout</a>
                        </div>
                    </li>

                    <?php } ?>
                </ul>
            </div>
        </nav>