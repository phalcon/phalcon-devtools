{%- macro input(name, placeholder = "") %}
    {% return text_field(name, "class": "form-control", "id": name, "placeholder": placeholder) %}
{%- endmacro %}

{%- macro input_disabled(name) %}
    {% return text_field(name, "class": "form-control disabled", "id": name, "disabled": "disabled") %}
{%- endmacro %}
