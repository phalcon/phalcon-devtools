<footer class="main-footer">
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-right hidden-xs">
                <b>Version</b> {{ ptools_version }}
            </div>
            <strong>{{ app_name }}</strong>.
            Copyright &copy; {{ copy_date }} {{ link_to(phalcon_url, phalcon_team, false) }}. All rights reserved.
        </div>
        <div class="col-sm-12">
            <div class="pull-right hidden-xs">
                <b>Version</b> {{ lte_version }}
            </div>
            <strong>{{ lte_name }}</strong>.
            Copyright &copy; {{ lte_date }} {{ link_to(lte_url, lte_team, false) }}. All rights reserved.
        </div>
    </div>
</footer>
