{% set head_title = '<span class="logo-mini"><strong>' ~ app_mini ~ '</strong></span><span class="logo-lg"><strong>' ~ app_name ~ '</strong></span>' %}

<header class="main-header">
    {{ link_to(webtools_uri, head_title, 'class': 'logo') }}
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    {{ link_to(
                        "https://github.com/phalcon/phalcon-devtools/issues",
                        "Did something go wrong? Try the Github Issues.",
                        'class': 'dropdown-toggle',
                        "local": false
                    ) }}
                </li>
            </ul>
        </div>
    </nav>
</header>
