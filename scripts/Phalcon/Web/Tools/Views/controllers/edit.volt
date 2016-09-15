<div class="row">
    <div class="col-sm-12">
        <div class="box box-warning">
            <div class="box-header with-border">
                <code>{{ controller_name }} - [{{ controller_path }}]</code>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Save</button>
            </div>
            <div class="box-body">
                <form role="form" method="post" action="{{ url.get("/webtools.php?_url=/controllers/update") }}">
                    <div class="form-group">
                        {{ text_area("code", "cols": 50, "rows": 25, "class": "form-control") }}
                        {{ hidden_field("name") }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{ assets.outputJs('codemirror') }}





