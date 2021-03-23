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

/* themes/contrib/bfd/templates/navigation/menu-local-task.html.twig */
class __TwigTemplate_293d1b07109c9ba67a84515791dcf856286de612ac248ea75a26db4dfc24edff extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 18];
        $filters = ["escape" => 26];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set'],
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
        // line 18
        $context["classes"] = [0 => "nav-item", 1 => "p-0", 2 => "m-2", 3 => ((        // line 22
($context["is_active"] ?? null)) ? ("active") : (""))];
        // line 25
        echo "
<li";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "html", null, true);
        echo ">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["link"] ?? null)), "html", null, true);
        echo "</li>";
    }

    public function getTemplateName()
    {
        return "themes/contrib/bfd/templates/navigation/menu-local-task.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  61 => 26,  58 => 25,  56 => 22,  55 => 18,);
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
 * @file
 * Theme override for a local task link.
 *
 * Available variables:
 * - attributes: HTML attributes for the wrapper element.
 * - is_active: Whether the task item is an active tab.
 * - link: A rendered link element.
 *
 * Note: This template renders the content for each task item in
 * menu-local-tasks.html.twig.
 *
 * @see template_preprocess_menu_local_task()
 */
#}
{%
  set classes = [
    'nav-item',
    'p-0',
    'm-2',
    is_active ? 'active'
  ]
%}

<li{{ attributes.addClass(classes) }}>{{ link }}</li>", "themes/contrib/bfd/templates/navigation/menu-local-task.html.twig", "/var/www/aironem/public_html/themes/contrib/bfd/templates/navigation/menu-local-task.html.twig");
    }
}
