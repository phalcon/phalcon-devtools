<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$", "Go Back") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>
        Create $plural$
    </h1>
</div>

{{ content() }}

{{ form("$plural$/create", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button('Save', 'class': 'btn btn-default') }}
    </div>
</div>

</form>
