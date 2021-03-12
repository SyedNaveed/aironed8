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

/* themes/custom/airchoiceone/templates/aco/baggage-description.html.twig */
class __TwigTemplate_b82c0bb57ba2a8f60a5f4f3925eeab94b7d3e7ffd5fa31f70504b0c1df145b1d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 7];
        $filters = ["escape" => 10];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['trans'],
                ['escape'],
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
        // line 7
        echo "<p>";
        echo t("<strong>Business Fare:</strong> 2 Checked Bags, 1 Carry On and 1 Personal item<br>
<strong>Everyday Fare:</strong> 1 Checked Bags, 1 Carry On and 1 Personal item<br>
<strong>Go Your Way Fare:</strong> 0 Checked Bags, 0 Carry On and 1 Personal item<br>
For more baggage information <a href=\"@site_settings.general.baggage_policies_page.url.toString\" target=\"_blank\">click here</a>.<br>
To view the Fare Rules Information <a href=\"@site_settings.general.purchasing_refunds_page.url.toString\" target=\"_blank\">click here</a>.", array("@site_settings.general.baggage_policies_page.url.toString" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(        // line 10
($context["site_settings"] ?? null), "general", []), "baggage_policies_page", []), "url", []), "toString", [], "method"), "@site_settings.general.purchasing_refunds_page.url.toString" => $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(        // line 11
($context["site_settings"] ?? null), "general", []), "purchasing_refunds_page", []), "url", []), "toString", [], "method"), ));
        echo "</p>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/baggage-description.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 11,  61 => 10,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/baggage-description.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/baggage-description.html.twig");
    }
}
