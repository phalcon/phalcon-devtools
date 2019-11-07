<div class="row">
    <div class="col-xs-12">
        {{ content() }}
        {{ flashSession.output() }}
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table">
                    <tbody>
                        <tr>
                            <th colspan="2" class="text-center">Versions</th>
                        </tr>
                        {% for label, value in info.getVersions() %}
                            <tr>
                                <th>{{ label }}</th>
                                <td>{{ value }}</td>
                            </tr>
                        {% endfor %}
                        <tr>
                            <th colspan="2" class="text-center">URIs</th>
                        </tr>
                        {% for label, value in info.getUris() %}
                            <tr>
                                <th>{{ label }}</th>
                                <td>{{ value }}</td>
                            </tr>
                        {% endfor %}
                        <tr>
                            <th colspan="2" class="text-center">Paths</th>
                        </tr>
                        {% for label, value in info.getDirectories() %}
                            <tr>
                                <th>{{ label }}</th>
                                <td>{{ value }}</td>
                            </tr>
                        {% endfor %}
                        <tr>
                            <th colspan="2" class="text-center">Environment</th>
                        </tr>
                        {% for label, value in info.getEnvironment() %}
                            <tr>
                                <th>{{ label }}</th>
                                <td>{{ value }}</td>
                            </tr>
                        {% endfor %}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
