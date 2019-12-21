{%- include 'partials/inputs.volt' -%}

{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Generate Controller</h3>
            </div>

            <div class="card-body">
                <form role="form" class="form-horizontal" name="generate-controller" method="post" action="{{ url.get(webtools_uri ~ "/controllers/generate") }}">
                    <p>{{ controller_name }} - [{{ controller_path }}]</p>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Controller name</label>
                        <div class="col-sm-10">
                            {{ input("name", "Class name without suffix eg. Users") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="namespace" class="col-sm-2 control-label">Namespace</label>
                        <div class="col-sm-10">
                            {{ input("namespace", 'eg. My\Awesome\Namespace') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="baseClass" class="col-sm-2 control-label">Base class</label>
                        <div class="col-sm-10">
                            {{ input("baseClass", "eg. BaseController") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="basePath" class="col-sm-2 control-label">Project Root</label>
                        <div class="col-sm-10">
                            {{ input("basePath", "The absolute path to the project") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="controllersDir" class="col-sm-2 control-label">Controller Directory</label>
                        <div class="col-sm-10">
                            {{ input("controllersDir", "The absolute path to the controller directory") }}
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label for="force">
                                {{- check_field("force", "value": 1, "id": "force") ~ " Force" -}}
                            </label>
                        </div>
                    </div>

                    <hr />
                    {{ submit_button("Generate", "class": "btn btn-success pull-right") }}
                </form>
            </div>
        </div>
    </div>
</div>
