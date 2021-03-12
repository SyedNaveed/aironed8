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

/* themes/custom/airchoiceone/images/icons/briefcase.svg */
class __TwigTemplate_81d7706b5a3723c8689cdebbe1ba08a5d806a19124d445ebe8b7a6eb2751b798 extends \Twig\Template
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
  <path d=\"m90.625 26.562h-25v-10.938c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703h-28.125c-0.86328 0-1.5625 0.69922-1.5625 1.5625v10.938h-25c-0.86328 0-1.5625 0.69922-1.5625 1.5625v21.875c-0.007812 0.77734 0.55859 1.4453 1.3281 1.5625l3.3594 0.5v32.312c0 0.41406 0.16406 0.8125 0.45703 1.1055s0.69141 0.45703 1.1055 0.45703h71.875c0.41406 0 0.8125-0.16406 1.1055-0.45703s0.45703-0.69141 0.45703-1.1055v-32.312l3.3594-0.5c0.76953-0.11719 1.3359-0.78516 1.3281-1.5625v-21.875c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703zm-53.125-9.375h25v9.375h-25zm46.875 65.625h-68.75v-30.266l26.562 4.0781v4.3125c0 0.41406 0.16406 0.8125 0.45703 1.1055s0.69141 0.45703 1.1055 0.45703h1.5625v7.8125c0 0.41406 0.16406 0.8125 0.45703 1.1055s0.69141 0.45703 1.1055 0.45703h6.25c0.41406 0 0.8125-0.16406 1.1055-0.45703s0.45703-0.69141 0.45703-1.1055v-7.8125h1.5625c0.41406 0 0.8125-0.16406 1.1055-0.45703s0.45703-0.69141 0.45703-1.1055v-4.3125l26.562-4.0781zm-35.938-20.312h3.125v6.25h-3.125zm4.6875-3.125h-7.8125v-9.375h9.375v9.375zm35.938-10.719-31.25 4.7969v-5.0156c0-0.41406-0.16406-0.8125-0.45703-1.1055s-0.69141-0.45703-1.1055-0.45703h-12.5c-0.86328 0-1.5625 0.69922-1.5625 1.5625v5.0156l-31.25-4.7969v-18.969h78.125z\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/briefcase.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/briefcase.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/briefcase.svg");
    }
}
