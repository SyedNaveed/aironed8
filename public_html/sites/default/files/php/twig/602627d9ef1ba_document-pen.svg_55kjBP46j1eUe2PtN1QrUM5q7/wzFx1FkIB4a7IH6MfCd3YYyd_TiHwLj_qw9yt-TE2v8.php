<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/custom/airchoiceone/images/icons/document-pen.svg */
class __TwigTemplate_22fefab3f21fbf9500b8093d6863488e957566ec8a09fc0fd29f8313bea47e71 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = [];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                []
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<svg width=\"100pt\" height=\"100pt\" version=\"1.1\" viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\">
  <path d=\"m4.6875 96.875h68.75c0.41406 0 0.8125-0.16406 1.1055-0.45703s0.45703-0.69141 0.45703-1.1055v-89.062c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703h-68.75c-0.86328 0-1.5625 0.69922-1.5625 1.5625v89.062c0 0.41406 0.16406 0.8125 0.45703 1.1055s0.69141 0.45703 1.1055 0.45703zm1.5625-89.062h65.625v85.938h-65.625z\" />
  <path d=\"m31.25 20.312c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h15.625c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m17.188 42.188h9.375c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-9.375c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625z\" />
  <path d=\"m67.188 39.062h-34.375c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h34.375c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m67.188 45.312h-56.25c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h56.25c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m10.938 54.688h40.625c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-40.625c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625z\" />
  <path d=\"m67.188 51.562h-9.375c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h9.375c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m67.188 57.812h-28.125c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h28.125c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m10.938 60.938h21.875c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-21.875c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625z\" />
  <path d=\"m67.188 64.062h-6.25c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h6.25c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m10.938 67.188h7.8125c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-7.8125c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625z\" />
  <path d=\"m23.438 65.625c0 0.41406 0.16406 0.8125 0.45703 1.1055s0.69141 0.45703 1.1055 0.45703h29.688c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-29.688c-0.86328 0-1.5625 0.69922-1.5625 1.5625z\" />
  <path d=\"m65.625 82.812h-21.875c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h21.875c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m25 17.188h28.125c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625h-28.125c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625z\" />
  <path d=\"m95.312 18.75h-4.6875c0-3.4531-2.7969-6.25-6.25-6.25s-6.25 2.7969-6.25 6.25v56.25c-0.011719 4.418 1.7422 8.6602 4.8789 11.773l0.26562 0.26562v0.003907c0.60938 0.60938 1.6016 0.60938 2.2109 0l0.26562-0.26562v-0.003906c3.1367-3.1133 4.8906-7.3555 4.8789-11.773v-53.125h3.125v14.062h3.125v-15.625c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703zm-10.938-3.125c0.82812 0 1.625 0.32812 2.2109 0.91406 0.58594 0.58594 0.91406 1.3828 0.91406 2.2109h-6.25c0-1.7266 1.3984-3.125 3.125-3.125zm3.125 57.812h-6.25v-51.562h6.25zm-3.125 10.211c-1.6836-2.0117-2.7422-4.4766-3.0352-7.0859h6.0703c-0.29297 2.6094-1.3516 5.0742-3.0352 7.0859z\" />
  <path d=\"m67.188 29.688h-18.75c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h18.75c0.86328 0 1.5625-0.69922 1.5625-1.5625s-0.69922-1.5625-1.5625-1.5625z\" />
  <path d=\"m46.875 71.875c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703h-34.375c-0.86328 0-1.5625 0.69922-1.5625 1.5625s0.69922 1.5625 1.5625 1.5625h34.375c0.41406 0 0.8125-0.16406 1.1055-0.45703s0.45703-0.69141 0.45703-1.1055z\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/document-pen.svg";
    }

    public function getDebugInfo()
    {
        return array (  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/images/icons/document-pen.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/document-pen.svg");
    }
}
