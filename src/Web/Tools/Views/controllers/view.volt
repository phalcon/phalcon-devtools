<div class="row">
    <div class="col-sm-12">
        {{ content() }}
        {{ flashSession.output() }}
        <div class="box box-warning">
            <div class="box-header with-border">
                <p>{{ controller_name }} - [{{ controller_path }}]</p>
            </div>
            <div class="box-body">
                <form role="form">
                    <div class="form-group">
                        {{ text_area("code", "cols": 50, "rows": 25, "class": "form-control") }}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{ assets.outputJs('codemirror') }}
