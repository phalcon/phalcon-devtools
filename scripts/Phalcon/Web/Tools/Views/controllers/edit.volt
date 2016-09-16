<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}
        <div class="box box-success">
            <form role="form" method="post" action="{{ url.get("/webtools.php?_url=/controllers/update") }}">
                <div class="box-header with-border">
                    <code>{{ controller_name }} - [{{ controller_path }}]</code>
                    <button type="submit" class="btn btn-success pull-right">Save</button>
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





