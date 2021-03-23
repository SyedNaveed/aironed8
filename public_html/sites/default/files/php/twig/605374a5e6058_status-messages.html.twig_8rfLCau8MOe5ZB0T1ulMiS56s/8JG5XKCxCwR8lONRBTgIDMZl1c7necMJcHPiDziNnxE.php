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

/* themes/contrib/bfd/templates/misc/status-messages.html.twig */
class __TwigTemplate_09503fcde2b4b7ed8718f61a52ebcb0722ab60a7544f37c7467a18dcd382ed95 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'messages' => [$this, 'block_messages'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 23, "for" => 24, "set" => 26, "if" => 38];
        $filters = ["escape" => 37, "without" => 37, "length" => 44, "first" => 51];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block', 'for', 'set', 'if'],
                ['escape', 'without', 'length', 'first'],
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
        // line 22
        echo "<div data-drupal-messages=\"data-drupal-messages\">
  ";
        // line 23
        $this->displayBlock('messages', $context, $blocks);
        // line 64
        echo " 
";
    }

    // line 23
    public function block_messages($context, array $blocks = [])
    {
        // line 24
        echo "    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["message_list"] ?? null));
        foreach ($context['_seq'] as $context["type"] => $context["messages"]) {
            // line 25
            echo "      ";
            // line 26
            $context["classes"] = [0 => "alert", 1 => ("alert-" . $this->sandbox->ensureToStringAllowed(            // line 28
$context["type"])), 2 => (((            // line 29
$context["type"] == "error")) ? ("alert-danger") : ("")), 3 => (((            // line 30
$context["type"] == "status")) ? ("alert-primary") : ("")), 4 => (((            // line 31
$context["type"] == "warning")) ? ("alert-warning") : ("")), 5 => "alert-dismissible", 6 => "fade", 7 => "show"];
            // line 37
            echo "      <div role=\"contentinfo\" aria-label=\"";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")), "html", null, true);
            echo "\" ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ($context["classes"] ?? null)], "method")), "role", "aria-label"), "html", null, true);
            echo ">
        ";
            // line 38
            if (($context["type"] == "error")) {
                // line 39
                echo "          <div role=\"alert\">
          ";
            }
            // line 41
            echo "          ";
            if ($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")) {
                // line 42
                echo "            <h2 class=\"visually-hidden\">";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["status_headings"] ?? null), $context["type"], [], "array")), "html", null, true);
                echo "</h2>
          ";
            }
            // line 44
            echo "          ";
            if ((twig_length_filter($this->env, $context["messages"]) > 1)) {
                // line 45
                echo "            <ul class=\"messages__list\">
              ";
                // line 46
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["messages"]);
                foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                    // line 47
                    echo "                <li class=\"messages__item\">";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["message"]), "html", null, true);
                    echo "</li>
              ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 49
                echo "            </ul>
          ";
            } else {
                // line 51
                echo "            ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_first($this->env, $this->sandbox->ensureToStringAllowed($context["messages"])), "html", null, true);
                echo "
          ";
            }
            // line 53
            echo "          ";
            if (($context["type"] == "error")) {
                // line 54
                echo "          </div>
        ";
            }
            // line 56
            echo "        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>
    </div>
    ";
            // line 62
            echo "    ";
            $context["attributes"] = $this->getAttribute(($context["attributes"] ?? null), "removeClass", [0 => ($context["classes"] ?? null)], "method");
            // line 63
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['type'], $context['messages'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "themes/contrib/bfd/templates/misc/status-messages.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  150 => 63,  147 => 62,  140 => 56,  136 => 54,  133 => 53,  127 => 51,  123 => 49,  114 => 47,  110 => 46,  107 => 45,  104 => 44,  98 => 42,  95 => 41,  91 => 39,  89 => 38,  82 => 37,  80 => 31,  79 => 30,  78 => 29,  77 => 28,  76 => 26,  74 => 25,  69 => 24,  66 => 23,  61 => 64,  59 => 23,  56 => 22,);
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
 * Theme override for status messages.
 *
 * Displays status, error, and warning messages, grouped by type.
 *
 * An invisible heading identifies the messages for assistive technology.
 * Sighted users see a colored box. See http://www.w3.org/TR/WCAG-TECHS/H69.html
 * for info.
 *
 * Add an ARIA label to the contentinfo area so that assistive technology
 * user agents will better describe this landmark.
 *
 * Available variables:
 * - message_list: List of messages to be displayed, grouped by type.
 * - status_headings: List of all status types.
 * - attributes: HTML attributes for the element, including:
 *   - class: HTML classes.
 */
#}
<div data-drupal-messages=\"data-drupal-messages\">
  {% block messages %}
    {% for type, messages in message_list %}
      {%
    set classes = [
      'alert',
      'alert-' ~ type,
      type == 'error' ? 'alert-danger',
      type == 'status' ? 'alert-primary',
      type == 'warning' ? 'alert-warning',
      'alert-dismissible',
      'fade',
      'show'
    ]
  %}
      <div role=\"contentinfo\" aria-label=\"{{ status_headings[type] }}\" {{ attributes.addClass(classes)|without('role', 'aria-label') }}>
        {% if type == 'error' %}
          <div role=\"alert\">
          {% endif %}
          {% if status_headings[ type ] %}
            <h2 class=\"visually-hidden\">{{ status_headings[type] }}</h2>
          {% endif %}
          {% if messages | length > 1 %}
            <ul class=\"messages__list\">
              {% for message in messages %}
                <li class=\"messages__item\">{{ message }}</li>
              {% endfor %}
            </ul>
          {% else %}
            {{ messages|first }}
          {% endif %}
          {% if type == 'error' %}
          </div>
        {% endif %}
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>
    </div>
    {# Remove type specific classes. #}
    {% set attributes = attributes.removeClass( classes ) %}
  {% endfor %}
{% endblock messages %} 
", "themes/contrib/bfd/templates/misc/status-messages.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\themes\\contrib\\bfd\\templates\\misc\\status-messages.html.twig");
    }
}
