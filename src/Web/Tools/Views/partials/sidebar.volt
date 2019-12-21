<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ webtools_uri }}" class="brand-link">
        <img class="brand-image" src="https://assets.phalcon.io/phalcon/images/svg/phalcon-logo-white-105x40.svg" alt="Phalcon DevTools" />
        <span class="brand-text font-weight-light">Web Tools</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">MAIN NAVIGATION</li>

                <li class="nav-item">
                    <a href="/webtools.php/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Home</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-cubes"></i>
                        <p>
                            Controllers
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/controllers/generate">
                                <i class="nav-icon fas fa-cogs"></i>
                                <span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/controllers/list">
                                <i class="nav-icon fas fa-list"></i>
                                <span>List all</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Models
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item ">
                            <a class="nav-link" href="/webtools.php/models/generate">
                                <i class="nav-icon fas fa-cogs"></i> <span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="/webtools.php/models/list">
                                <i class="nav-icon fas fa-list"></i> <span>List all</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-file-code"></i> <span>Scaffold</span>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/scaffold/generate">
                                <i class="nav-icon fas fa-cogs"></i><span>Generate</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-magic"></i> <span>Migrations</span>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/generate">
                                <i class="nav-icon fas fa-cogs"></i><span>Generate</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/list">
                                <i class="nav-icon fas fa-list"></i><span>List all</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/webtools.php/migrations/run">
                                <i class="nav-icon fas fa-play"></i><span>Run</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/webtools.php/info">
                        <i class="nav-icon fas fa-info"></i> <p>System Info</p>
                    </a>
                </li>

                <li class="nav-header">LINKS</li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/phalcon-devtools" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon DevTools</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/incubator" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon Incubator</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://docs.phalcon.io/4.0/en/introduction" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Phalcon Docs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://zephir-lang.com/" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Zephir</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/phalcon/awesome-phalcon" target="_blank">
                        <i class="nav-icon fas fa-book"></i> <p>Awesome Phalcon</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
