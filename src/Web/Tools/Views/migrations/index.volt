{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Migrations List
                    <br/>
                    <small>All migrations that we managed to find</small>
                </h3>
                <div class="card-tools">
                    {{ link_to(webtools_uri ~ "/migrations/generate", "Generate", 'class': 'btn btn-primary pull-right') }}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Version</th>
                        <th>Migration</th>
                        <th>Size</th>
                        <th>Owner</th>
                        <th>Last modified</th>
                    </tr>
                    </thead>
                    <tbody>
                    {%- if migrations_dir is empty -%}
                        <tr class="warning">
                            <td colspan="1">
                                <p class="text-center">
                                    Sorry, Phalcon WebTools doesn't know where the migrations directory is.<br>
                                    Please add the valid path for <code>migrationsDir</code>
                                    in the <code>application</code> section.
                                </p>
                            </td>
                        </tr>
                    {%- else -%}
                        {% for version, migration_files in migrations %}
                            {% set rowspan = count(migration_files) %}
                            {% set start   = rowspan > 1 %}
                            {% for file in migration_files %}
                                <tr title="{{ version }}">
                                    {% if rowspan <= 1 %}
                                        <th class="migration-version">{{ version }}</th>
                                    {% else %}
                                        {% if start is true %}
                                            <th rowspan="{{ rowspan }}" class="migration-version">{{ version }}</th>
                                            {% set start = false %}
                                        {%- endif -%}
                                    {%- endif -%}
                                    <td>{{ file.name }}</td>
                                    <td>{{ file.size }} b</td>
                                    <td>{{ file.owner }}</td>
                                    <td>{{ file.modified_time }}</td>
                                </tr>
                            {% endfor  %}
                        {% endfor  %}
                    {%- endif -%}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
