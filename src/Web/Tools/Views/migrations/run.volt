{%- include 'partials/inputs.volt' -%}

{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Run Migration</h3>
            </div>
            <div class="card-body">
                <p>Migrations from: [{{ migration_path }}]</p>

                <form role="form" class="form-horizontal" name="generate-migration" method="post" action="{{ url.get(webtools_uri ~ "/migrations/run") }}">
                    <div class="form-group">
                        <label for="oldVersion" class="col-sm-2 control-label">Current Version</label>
                        <div class="col-sm-10">
                            {{ input_disabled("oldVersion") }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="basePath" class="col-sm-2 control-label">Project Root</label>
                        <div class="col-sm-10">
                            {{ input("basePath", "The absolute path to the project") }}
                            <span class="help-block">Directory where the project was created</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="migrationsDir" class="col-sm-2 control-label">Migrations Dir</label>
                        <div class="col-sm-10">
                            {{ input("migrationsDir", "The absolute path to the model directory") }}
                            <span class="help-block">The absolute path to the migrations directory</span>
                        </div>
                    </div>

                    <hr/>
                    {{ submit_button("Run", "class": "btn btn-success pull-right") }}
                </form>
            </div>
        </div>
    </div>
</div>
