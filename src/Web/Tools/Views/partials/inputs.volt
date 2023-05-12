{%- macro input(name, placeholder = "", value = "") %}
    {% return text_field(name, "class": "form-control", "id": name, "placeholder": placeholder, "value": value) %}
{%- endmacro %}

{%- macro input_disabled(name, value="") %}
    {% return text_field(name, "class": "form-control disabled", "id": name, "disabled": "disabled", "value": value) %}
{%- endmacro %}
