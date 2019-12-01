<section class="content-header">
    <div class="container-fluid">
    {%- if page_title is defined and page_title is not empty -%}
        <h1>
            {{- page_title }}&nbsp;

            {%- if page_subtitle is defined and page_subtitle is not empty -%}
                <small>{{ page_subtitle -}}</small>
            {%- endif -%}
        </h1>
    {%- endif -%}
    </div>
</section>
