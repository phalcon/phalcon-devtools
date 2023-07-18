{%- include 'partials/inputs.volt' -%}

{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Generate Migration</h3>
            </div>
            <div class="card-body">
                <p>New model will be placed at: [{{ migrations_dir }}]</p>

                <form role="form" class="form-horizontal" name="generate-migration" method="post" action="{{ url.get(webtools_uri ~ "/migrations/generate") }}">
                    <div class="form-group">
                        <label for="oldVersion" class="col-sm-2 control-label">Current Version</label>
                        <div class="col-sm-10">
                            {{ input_disabled("oldVersion", old_version) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="version" class="col-sm-2 control-label">New version</label>
                        <div class="col-sm-10">
                            {{ input("version", 'Leave empty to automatically add new version') }}
                            <span class="help-block">Version to migrate</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tableName" class="col-sm-2 control-label">Table name</label>
                        <div class="col-sm-10">
                            {{ select_static(["tableName", tables, 'useEmpty': false, "id": "tableName", "class": "form-control"]) }}
                            <span class="help-block">Table to migrate. <em>Default: all</em></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="basePath" class="col-sm-2 control-label">Project Root</label>
                        <div class="col-sm-10">
                            {{ input("basePath", "The absolute path to the project", base_path) }}
                            <span class="help-block">Directory where the project was created</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="migrationsDir" class="col-sm-2 control-label">Migrations Dir</label>
                        <div class="col-sm-10">
                            {{ input("migrationsDir", "The absolute path to the model directory", migrations_dir) }}
                            <span class="help-block">The absolute path to the migrations directory</span>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label for="exportData">
                                {{- check_field("exportData", "value": 1, "id": "exportData") ~ " Export data" -}}
                            </label>
                        </div>
                    </div>

                    <div class="choose_type_data" id="choose_type_data" style="margin-right: -125px; display: none;">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="radio">
                                <label for="exportData">
                                    <input type="radio" name="exportDataType" value="oncreate"> oncreate
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="radio">
                                <label for="exportData">
                                    <input type="radio" name="exportDataType" value="always"> always
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label for="noAi">
                                {{- check_field("noAi", "value": 1, "id": "noAi") ~ " Disable auto increment" -}}
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label for="force">
                                {{- check_field("force", "value": 1, "id": "force") ~ " Force" -}}
                            </label>
                        </div>
                    </div>

                    <hr/>
                    {{ submit_button("Generate", "class": "btn btn-success pull-right") }}
                </form>
            </div>
        </div>
    </div>
</div>
