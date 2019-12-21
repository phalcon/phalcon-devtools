{%- include 'partials/inputs.volt' -%}

{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">We will use templates from: [{{ template_path }}]</h3>
            </div>
            <div class="card-body">
                <form role="form" class="form-horizontal" name="generate-scaffold" method="post" action="{{ url.get(webtools_uri ~ "/scaffold/generate") }}">
                    <div class="form-group">
                        <label for="modelsNamespace" class="col-sm-2 control-label">Model's namespace</label>
                        <div class="col-sm-10">
                            {{ input("modelsNamespace", 'eg. My\Awesome\Namespace') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="schema" class="col-sm-2 control-label">Schema</label>
                        <div class="col-sm-10">
                            {{ input("schema", "Database name") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tableName" class="col-sm-2 control-label">Table name</label>
                        <div class="col-sm-10">
                            {{ select_static(["tableName", tables, 'useEmpty': false, "id": "tableName", "class": "form-control"]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="templateEngine" class="col-sm-2 control-label">Template engine</label>
                        <div class="col-sm-10">
                            {{ select_static(["templateEngine", templateEngines, 'useEmpty': false, "id": "templateEngine", "class": "form-control"]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="basePath" class="col-sm-2 control-label">Project Root</label>
                        <div class="col-sm-10">
                            {{ input("basePath", "The absolute path to the project") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="templatesPath" class="col-sm-2 control-label">Templates path</label>
                        <div class="col-sm-10">
                            {{ input("templatesPath", "The absolute path to the templates") }}
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label for="genSettersGetters">
                                {{- check_field("genSettersGetters", "value": 1, "id": "genSettersGetters") ~ " Add setters and getters" -}}
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
