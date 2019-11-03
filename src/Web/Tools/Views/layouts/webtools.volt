{% extends "layouts/base.volt" %}

{% block header %}
    {% include 'partials/header.volt' %}
{% endblock %}

{% block head_custom %}
    {% include 'partials/custom_css.volt' %}
{% endblock %}

{% block sidebar %}
    {% include 'partials/sidebar.volt' %}
{% endblock %}

{% block content %}
    <div class="content-wrapper">
        {% include 'partials/content_header.volt' %}
        {% include 'partials/content.volt' %}
    </div>
{% endblock %}

{% block footer %}
    {% include 'partials/footer.volt' %}
{% endblock %}

{% block footer_js %}
    {{ assets.outputJs('footer') }}
{% endblock %}
