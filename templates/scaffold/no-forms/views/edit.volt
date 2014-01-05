{{ content() }}
{{ form("$plural$/save", "method":"post") }}

<table width="100%">
    <tr>
        <td align="left">{{ link_to("$plural$", "Go Back") }}</td>
        <td align="right">{{ submit_button("Save") }}</td>
    <tr>
</table>

<div align="center">
    <h1>Edit $plural$</h1>
</div>

<table>
$captureFields$
	<tr>
		<td>{{ hidden_field("id") }}</td>
		<td>{{ submit_button("Save") }}</td>
	</tr>
</table>

</form>
