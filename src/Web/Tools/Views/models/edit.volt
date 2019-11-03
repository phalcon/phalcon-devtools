<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}
        <div class="box box-success">
            <form role="form" name="edit-model" method="post" action="{{ url.get("/webtools.php?_url=/models/update") }}">
                <div class="box-header with-border">
                    <p class="pull-left">{{ model_name }} - [{{ model_path }}]</p>
                    {{ submit_button("Save", "class": "btn btn-success pull-right") }}
                </div>
                <div class="box-body">
                    <div class="form-group">
                        {{ text_area("code", "cols": 50, "rows": 25, "class": "form-control") }}
                        {{ hidden_field("path") }}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{ assets.outputJs('codemirror') }}
