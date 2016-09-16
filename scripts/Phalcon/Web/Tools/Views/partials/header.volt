{% set head_title = '<span class="logo-mini"><strong>' ~ app_mini ~ '</strong></span><span class="logo-lg"><strong>' ~ app_name ~ '</strong></span>' %}

<header class="main-header">
    {{ link_to(webtools_uri, head_title, 'class': 'logo') }}
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
    </nav>
</header>
