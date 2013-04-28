
{{ content() }}

<div align="right">
	{{ link_to("$plural$/new", "Create $plural$") }}
</div>

{{ form("$plural$/search", "method":"post", "autocomplete" : "off") }}

<div align="center">
    <h1>Search $plural$</h1>
</div>

<table>
$captureFields$
	<tr>
		<td></td>
		<td>{{ submit_button("Search") }}</td>
	</tr>
</table>

</form>
