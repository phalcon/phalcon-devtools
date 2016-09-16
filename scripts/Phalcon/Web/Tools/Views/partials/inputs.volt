{%- macro input(name, placeholder = "") %}
    {% return text_field(name, "class": "form-control", "id": name, "placeholder": placeholder) %}
{%- endmacro %}
