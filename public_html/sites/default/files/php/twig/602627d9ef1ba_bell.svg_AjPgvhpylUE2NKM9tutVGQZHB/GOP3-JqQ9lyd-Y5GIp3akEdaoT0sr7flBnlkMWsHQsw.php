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

/* themes/custom/airchoiceone/images/icons/bell.svg */
class __TwigTemplate_bb3ae13f957304b9f836bbb185a097f117e56256dcf8047ea8160e00ef6882d8 extends \Twig\Template
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
        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"46.81\" height=\"51.859\" viewBox=\"0 0 46.81 51.859\">
  <path d=\"M55.652,66.974a7.8,7.8,0,0,1-15.5,0h-10.6a5.048,5.048,0,1,1-.007-10.1.461.461,0,0,0,.455-.459V45.4A17.9,17.9,0,0,1,42.4,28.371v-.864a5.507,5.507,0,1,1,11.014,0v.864A17.905,17.905,0,0,1,65.8,45.4V56.419a.452.452,0,0,0,.455.459,5.048,5.048,0,1,1-.007,10.1Zm-2.782,0H42.939a5.05,5.05,0,0,0,9.931,0ZM44.118,30.738A15.148,15.148,0,0,0,32.76,45.4V56.419a3.213,3.213,0,0,1-3.209,3.212,2.295,2.295,0,1,0,.007,4.589H66.251a2.295,2.295,0,1,0,.007-4.589,3.206,3.206,0,0,1-3.209-3.212V45.4A15.147,15.147,0,0,0,51.691,30.738l-1.033-.265V27.507a2.754,2.754,0,1,0-5.507,0v2.965Z\" transform=\"translate(-24.5 -22)\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/bell.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/bell.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/bell.svg");
    }
}
