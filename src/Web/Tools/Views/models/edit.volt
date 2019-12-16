{{ flashSession.output() }}

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ model_name }} - [{{ model_path }}]</h3>
            </div>
            <div class="card-body">
                <form role="form" name="edit-model" method="post" action="{{ url.get(webtools_uri ~ "/models/update") }}">
                    <div class="form-group">
                        {{ text_area("code", "cols": 50, "rows": 25, "class": "form-control") }}
                        {{ hidden_field("path") }}
                    </div>

                    <hr/>
                    {{ submit_button("Save", "class": "btn btn-success pull-right") }}
                </form>
            </div>
        </div>
    </div>
</div>

{{ assets.outputJs('codemirror') }}
