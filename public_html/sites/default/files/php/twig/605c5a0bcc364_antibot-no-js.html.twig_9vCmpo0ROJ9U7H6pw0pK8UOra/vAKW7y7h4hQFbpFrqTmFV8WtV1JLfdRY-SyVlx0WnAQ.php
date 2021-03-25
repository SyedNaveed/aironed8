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

/* modules/contrib/antibot/templates/antibot-no-js.html.twig */
class __TwigTemplate_4b5ad745e34d3dc7be4f8e1aab351b10201bb277236e13c6aee3f808644fa58a extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 15];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
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
        // line 14
        echo "<noscript>
  <div class=\"antibot-no-js antibot-message antibot-message-warning\">";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["message"] ?? null)), "html", null, true);
        echo "</div>
</noscript>
";
    }

    public function getTemplateName()
    {
        return "modules/contrib/antibot/templates/antibot-no-js.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 15,  55 => 14,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file antibot-no-js.html.twig
 * Theme implementation to present markup inside Antibot-protected forms.
 *
 * The purpose is to show a message to users without Javascript.
 *
 * Available variables:
 * - message: The message text that is shown to non-JS users.
 *
 * @ingroup themeable
 */
#}
<noscript>
  <div class=\"antibot-no-js antibot-message antibot-message-warning\">{{ message }}</div>
</noscript>
", "modules/contrib/antibot/templates/antibot-no-js.html.twig", "/var/www/aironem/public_html/modules/contrib/antibot/templates/antibot-no-js.html.twig");
    }
}
