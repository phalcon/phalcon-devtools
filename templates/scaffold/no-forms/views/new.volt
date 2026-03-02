<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ a(url("$plural$"), "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Create $plural$</h1>
</div>

{{ content() }}

<form action="{{ url('$plural$/create') }}" method="post">
    $captureFields$
    <div class="row mb-3">
        <div class="col-sm-offset-2 col-sm-10">
            {{ inputSubmit('save', 'Save', ['class': 'btn btn-primary']) }}
        </div>
    </div>
</form>
