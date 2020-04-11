<div class="page-header">
    <h1>Search $plural$</h1>
    <p>{{ link_to("$plural$/new", "Create $plural$") }}</p>
</div>

{{ content() }}

{{ flash.output() }}

<form action="$plural$/search" class="form-horizontal" method="get">
    $captureFields$
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ submit_button('Search', 'class': 'btn btn-default') }}
        </div>
    </div>
</form>
