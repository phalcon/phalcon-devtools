<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Migrations List</h3>
                {{ link_to("/webtools.php?_url=/migrations/generate", "Generate", 'class': 'btn btn-primary pull-right') }}
            </div>
            <div class="box-body table-responsive no-padding">
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
