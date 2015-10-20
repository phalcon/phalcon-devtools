<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ link_to("$plural$/index", "Go Back") }}</li>
            <li class="next">{{ link_to("$plural$/new", "Create ") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<table class="browse" align="center">
    <thead>
        <tr>
$headerColumns$
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    {% if page.items is defined %}
    {% for $singularVar$ in page.items %}
        <tr>
$rowColumns$
            <td>{{ link_to("$plural$/edit/"~$singularVar$.$pk$, "Edit") }}</td>
            <td>{{ link_to("$plural$/delete/"~$singularVar$.$pk$, "Delete") }}</td>
        </tr>
    {% endfor %}
    {% endif %}
    </tbody>
    <tbody>
        <tr>
            <td>
                <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
                    {{ page.current~"/"~page.total_pages }}
                </p>
            </td>
            <td colspan="6">
                <nav>
                    <ul class="pagination">
                        <li>{{ link_to("$plural$/search", "First") }}</li>
                        <li>{{ link_to("$plural$/search?page="~page.before, "Previous") }}</li>
                        <li>{{ link_to("$plural$/search?page="~page.next, "Next") }}</li>
                        <li>{{ link_to("$plural$/search?page="~page.last, "Last") }}</li>
                    </ul>
                </nav>
            </td>
        </tr>
    </tbody>
</table>
