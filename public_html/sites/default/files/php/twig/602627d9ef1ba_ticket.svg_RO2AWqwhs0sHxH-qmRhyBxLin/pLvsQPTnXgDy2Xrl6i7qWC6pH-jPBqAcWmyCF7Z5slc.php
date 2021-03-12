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

/* themes/custom/airchoiceone/images/icons/ticket.svg */
class __TwigTemplate_7ad465e5d96c568085d5d227e87a9f2a878e43750f3a7d8b139ddc66f3f6e45d extends \Twig\Template
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
 <path d=\"m9 27v13h1c5.5352 0 10 4.4648 10 10s-4.4648 10-10 10h-1v13h82v-13h-1c-5.5352 0-10-4.4648-10-10s4.4648-10 10-10h1v-13zm2 2h53v7h2v-7h23v9.1875c-6.125 0.53516-11 5.5508-11 11.812 0 6.2578 4.8789 11.246 11 11.781v9.2188h-23v-7h-2v7h-53v-9.2188c6.1211-0.53516 11-5.5234 11-11.781 0-6.2617-4.875-11.277-11-11.812zm53 11v8h2v-8zm0 12v8h2v-8z\"/>
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/ticket.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/ticket.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/ticket.svg");
    }
}
