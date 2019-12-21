{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">
                    Controllers List<br />
                    <small>All controllers that we managed to find</small>
                </h3>
                <div class="card-tools">
                    {{ link_to(webtools_uri ~ "/controllers/generate", "Generate", 'class': 'btn btn-primary') }}
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Owner</th>
                        <th>Last modified</th>
                        <th width="10%">Actions</th>
                    </tr>
                    {%- if controllers_dir is empty -%}
                        <tr class="warning">
                            <td colspan="5">
                                <p class="text-center">
                                    Sorry, Phalcon WebTools doesn't know where the controllers directory is.<br>
                                    Please add the valid path for <code>controllersDir</code>
                                    in the <code>application</code> section.
                                </p>
                            </td>
                        </tr>
                    {%- else -%}
                        {% for controller in controllers %}
                            <tr>
                                <td>
                                    {{- controller.name }}
                                    {% if controller.is_writable is false -%}
                                        <span class="label label-warning">ro</span>
                                    {%- endif -%}
                                </td>
                                <td>{{ controller.size ~ ' b'}}</td>
                                <td>{{ controller.owner }}</td>
                                <td>{{ controller.modified_time }}</td>
                                <td>
                                    {{ link_to(webtools_uri ~ "/controllers/edit/" ~ rawurlencode(controller.filename),
                                        '<i class="fas fa-pen-square"></i>', 'class': 'btn btn-warning btn-sm') }}
                                </td>
                            </tr>
                        {% endfor  %}
                    {%- endif -%}
                </table>
            </div>
        </div>
    </div>
</div>
