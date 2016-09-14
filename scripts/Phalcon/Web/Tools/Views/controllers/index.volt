<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Controllers List</h3>
            </div>

            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Owner</th>
                        <th>Last modified</th>
                        <th width="10%">Actions</th>
                    </tr>
                    {%- if controllers is empty -%}
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
                                    <h5>
                                        {{- controller.name }}
                                        {% if controller.is_writable is false -%}
                                            <span class="label label-warning">ro</span>
                                        {%- endif -%}
                                    </h5>
                                </td>
                                <td>{{ controller.size ~ ' b'}}</td>
                                <td>{{ controller.owner }}</td>
                                <td>{{ controller.modified_time }}</td>
                                <td>
                                    {% if controller.is_writable is false -%}
                                        {{ link_to(['for': 'controllers-view', 'path': base64_encode(controller.path)],
                                        '<i class="fa fa-eye"></i>', 'class': 'btn btn-default btn-xs') }}
                                    {%- else -%}
                                        {{ link_to(['for': 'controllers-edit', 'path': base64_encode(controller.path)],
                                        '<i class="fa fa-pencil"></i>', 'class': 'btn btn-default btn-xs') }}
                                    {%- endif -%}

                                </td>
                            </tr>
                        {% endfor  %}
                    {%- endif -%}
                </table>
            </div>

        </div>
    </div>
</div>
