{{ get_doctype() }}
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    {{ get_title() }}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta content="{{ phalcon_team }}" name="author">
    <link rel="shortcut icon" href="/favicon.ico?v={{ ptools_version }}">
    {{ stylesheet_link("https://fonts.googleapis.com/css?family=Roboto:400,500,700,900&subset=latin,cyrillic-ext,cyrillic", false) }}
    {% block head_icons %}
        {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css", false) }}
        {{ stylesheet_link("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css", false) }}
    {% endblock %}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    {{ assets.outputJs('js_ie') }}
    <![endif]-->
    {{ assets.outputCss('main_css') }}
    {% block head_custom %}{% endblock %}
</head>
{%- block body_start -%}
    <body class="hold-transition skin-blue sidebar-mini">
{%- endblock -%}
    {%- block wrapper_start -%}
        <div class="wrapper">
    {%- endblock -%}
        {% block header %}{% endblock %}
        {% block sidebar %}{% endblock %}
        {% block content %}{% endblock %}
        {% block footer %}{% endblock %}
        {% block sidebar_right %}{% endblock %}
    {%- block wrapper_end -%}
            <div class="control-sidebar-bg"></div>
        </div>
    {%- endblock -%}
    {% block footer_js %}{% endblock %}
{%- block body_end -%}
    </body>
{%- endblock -%}
</html>
