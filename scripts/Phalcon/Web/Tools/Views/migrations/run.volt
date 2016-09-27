{%- include 'partials/inputs.volt' -%}

<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}

        <div class="box box-success">
            <form role="form" class="form-horizontal" name="generate-migration" method="post" action="{{ url.get("/webtools.php?_url=/migrations/run") }}">
                <div class="box-header with-border">
                    <p class="pull-left">Migrations from: [{{ migration_path }}]</p>
                    {{ submit_button("Run", "class": "btn btn-success pull-right") }}
                </div>
                <div class="box-body">
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
                </div>
            </form>
        </div>
    </div>
</div>
