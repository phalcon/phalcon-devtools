<div class="row">
    <nav>
        <ul class="pager">
            <li class="previous">{{ a(url("$plural$/index"), "Go Back") }}</li>
            <li class="next">{{ a(url("$plural$/new"), "Create") }}</li>
        </ul>
    </nav>
</div>

<div class="page-header">
    <h1>Search result</h1>
</div>

{{ content() }}

<div class="row">
    <table class="table table-bordered">
        <thead>
            <tr>
    $headerColumns$
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        {% for $singularVar$ in page.getItems() %}
            <tr>
    $rowColumns$
                <td>{{ a(url("$plural$/edit/"~$singularVar$.$pk$), "Edit") }}</td>
                <td>{{ a(url("$plural$/delete/"~$singularVar$.$pk$), "Delete") }}</td>
            </tr>
        {% endfor %}
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-sm-1">
        <p class="pagination" style="line-height: 1.42857;padding: 6px 12px;">
            {{ page.getCurrent()~"/"~page.getTotalItems() }}
        </p>
    </div>
    <div class="col-sm-11">
        <nav>
            <ul class="pagination">
                <li>{{ a(url("$plural$/search"), "First", ["class": "page-link", 'id': 'first']) }}</li>
                <li>{{ a(url("$plural$/search?page="~page.getPrevious()), "Previous", ["class": "page-link", 'id': 'previous']) }}</li>
                <li>{{ a(url("$plural$/search?page="~page.getNext()), "Next", ["class": "page-link", 'id': 'next']) }}</li>
                <li>{{ a(url("$plural$/search?page="~page.getLast()), "Last", ["class": "page-link", 'id': 'last']) }}</li>
            </ul>
        </nav>
    </div>
</div>
