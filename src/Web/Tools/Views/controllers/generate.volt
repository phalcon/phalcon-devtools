{%- include 'partials/inputs.volt' -%}

<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}

        <div class="box box-success">
            <form role="form" class="form-horizontal" name="generate-controller" method="post" action="{{ url.get("/webtools.php?_url=/controllers/generate") }}">
                <div class="box-header with-border">
                    <p class="pull-left">{{ controller_name }} - [{{ controller_path }}]</p>
                    {{ submit_button("Generate", "class": "btn btn-success pull-right") }}
                </div>
                <div class="box-body">
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
                </div>
            </form>
        </div>
    </div>
</div>
