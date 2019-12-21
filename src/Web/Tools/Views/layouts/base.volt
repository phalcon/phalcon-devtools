{{ get_doctype() }}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ get_title() }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="{{ phalcon_team }}" name="author">
    <link rel="shortcut icon" href="/favicon.ico?v={{ ptools_version }}">
    {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css", false) }}

    {{ assets.outputCss('main_css') }}
    {% block head_custom %}{% endblock %}
</head>

{%- block body_start -%}
<body class="hold-transition sidebar-mini layout-fixed">
{%- endblock -%}

    <div class="wrapper">
        {% block header %}{% endblock %}
        {% block sidebar %}{% endblock %}

        {%- block wrapper_start -%}
        <div class="content-wrapper">
        {%- endblock -%}

            {% block content %}{% endblock %}

        {%- block wrapper_end -%}
            <div class="control-sidebar-bg"></div>
        </div>
        {%- endblock -%}

        {% block footer %}{% endblock %}
    </div>

    {% block footer_js %}{% endblock %}

{%- block body_end -%}
</body>
{%- endblock -%}
</html>
