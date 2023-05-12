{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <p>{{ model_name }} - [{{ models_dir }}]</p>
            </div>
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        {{ text_area("code", "value": model_code, "cols": 50, "rows": 25, "class": "form-control") }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{ assets.outputJs('codemirror') }}
