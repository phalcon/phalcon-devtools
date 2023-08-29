<div class="page-header">
    <h1>Search $plural$</h1>
    <p>{{ a(url("$plural$/new"), "Create $plural$") }}</p>
</div>

{{ content() }}

{{ flash.output() }}

<form action="{{ url('$plural$/search') }}" class="form-horizontal" method="get">
    $captureFields$
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ inputSubmit('search', 'Search', ['class': 'btn btn-primary']) }}
        </div>
    </div>
</form>
