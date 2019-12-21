<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Edit $plural$</h1>
</div>

{{ content() }}

<form action="$plural$/save" class="form-horizontal" method="post">
    $captureFields$
    {{ hidden_field("id") }}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ submit_button('Send', 'class': 'btn btn-default') }}
        </div>
    </div>
</form>
