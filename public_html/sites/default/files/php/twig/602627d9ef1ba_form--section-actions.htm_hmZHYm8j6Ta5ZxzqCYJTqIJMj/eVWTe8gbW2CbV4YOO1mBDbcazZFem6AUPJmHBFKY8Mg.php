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

/* themes/custom/airchoiceone/templates/forms/form--section-actions.html.twig */
class __TwigTemplate_29a916b61f8f8b2ac4e3cf1a31ebfd49a05162ce3cc1451af7cf5a70d8e2e88f extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 19];
        $filters = ["escape" => 15, "without" => 15];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 'without'],
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
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["element"] ?? null)), "actions"), "html", null, true);
        echo "
<div class=\"section__actions\">
  <ul class=\"block-list horizontal-list\">
    <li>";
        // line 18
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button1", [])), "html", null, true);
        echo "</li>
    ";
        // line 19
        if ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button2", [])) {
            // line 20
            echo "      <li>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button2", [])), "html", null, true);
            echo "</li>
    ";
        }
        // line 22
        echo "    ";
        if ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button3", [])) {
            // line 23
            echo "      <li>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button3", [])), "html", null, true);
            echo "</li>
    ";
        }
        // line 25
        echo "    ";
        if ($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button4", [])) {
            // line 26
            echo "      <li>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "button4", [])), "html", null, true);
            echo "</li>
    ";
        }
        // line 28
        echo "  </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/forms/form--section-actions.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  91 => 28,  85 => 26,  82 => 25,  76 => 23,  73 => 22,  67 => 20,  65 => 19,  61 => 18,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/forms/form--section-actions.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/forms/form--section-actions.html.twig");
    }
}
