{{ flashSession.output() }}

<div class="row">
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-body table-responsive">
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
