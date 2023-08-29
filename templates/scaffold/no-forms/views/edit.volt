<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ a(url("$plural$"), "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Edit $plural$</h1>
</div>

{{ content() }}

<form action="{{ url('$plural$/save') }}" class="form-horizontal" method="post">
    $captureFields$
    {{ inputHidden("id", $singular$.$pk$) }}

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {{ inputSubmit('save', 'Save', ['class': 'btn btn-primary']) }}
        </div>
    </div>
</form>
