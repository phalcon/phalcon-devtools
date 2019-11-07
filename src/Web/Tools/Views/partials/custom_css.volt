{%- if custom_css is defined and custom_css is true -%}
    {{- assets.outputCss('custom_css') -}}
{%- endif -%}
