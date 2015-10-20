<div class="page-header">
    <h1>
        Search $plural$
        <small>
            {{ link_to("$plural$/new", "Create $plural$") }}
        </small>
    </h1>
</div>

{{ content() }}


{{ form("$plural$/search", "method":"post", "autocomplete" : "off", "class" : "form-horizontal") }}

$captureFields$
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        {{ submit_button(["Search", "class" : "btn btn-default"]) }}
    </div>
</div>

</form>
