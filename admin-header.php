 <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="admin-index.php">
                    <span class="sidebar-brand-text align-middle">
                        Blog Post Administrator
                    </span>
                </a>

                <div class="sidebar-user">
                    <div class="d-flex justify-content-center">
                        <div class="flex-grow-1 ps-2">
                                Maxence Medard
                        </div>
                    </div>
                </div>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item">
                        <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="layout"></i> <span
                                class="align-middle">Articles</span>
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-articles.php">Tous les
                                    articles</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-add-article.php">Ajout
                                    d'articles</a></li>
                        </ul>
                    </li>



                    <li class="sidebar-item">
                        <a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Gestions</span>
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-gestion-user.php">Utilisateurs</a>
                            </li>
                            <li class="sidebar-item"><a class="sidebar-link" href="admin-gestion-comment.php">Commentaires</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item">
                            <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="maximize"></i>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </nav>