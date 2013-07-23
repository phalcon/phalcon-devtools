
{{ form("$plural$/create", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("$plural$", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    <tr>
</table>

{{ content() }}

<div align="center">
    <h1>Create $plural$</h1>
</div>

<table>
$captureFields$
    <tr>
        <td></td>
        <td>{{ submit_button("Search") }}</td>
    </tr>
</table>

</form>
