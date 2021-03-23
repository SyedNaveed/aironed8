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

/* modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig */
class __TwigTemplate_e034a85c74440409f6bb2681039a88f1baea9b8f3103bd586d854ab227dbca98 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 1, "join" => 13, "keys" => 13, "without" => 19];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'join', 'keys', 'without'],
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
        echo "<form";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">

  <div class=\"row\">
    <div class=\"col-md-6\">
      ";
        // line 5
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "city_of_origin", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-md-6\">
      ";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "city_of_origin", [])), "html", null, true);
        echo "
    </div>
  </div>
  <div>
    <h3>Form variables</h3>
    ";
        // line 13
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_get_array_keys_filter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null))), ", "), "html", null, true);
        echo "
    <h3>Other variables</h3>
    ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_get_array_keys_filter($this->sandbox->ensureToStringAllowed($context)), ", "), "html", null, true);
        echo "
  </div>

  ";
        // line 19
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null)), "city_of_origin"), "html", null, true);
        echo "

</form>";
    }

    public function getTemplateName()
    {
        return "modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 19,  82 => 15,  77 => 13,  69 => 8,  63 => 5,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<form{{ attributes }}>

  <div class=\"row\">
    <div class=\"col-md-6\">
      {{ form.city_of_origin }}
    </div>
    <div class=\"col-md-6\">
      {{ form.city_of_origin }}
    </div>
  </div>
  <div>
    <h3>Form variables</h3>
    {{ form|keys|join(', ') }}
    <h3>Other variables</h3>
    {{ _context|keys|join(', ') }}
  </div>

  {# render other fields  #}
  {{ form|without('city_of_origin') }}

</form>", "modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\modules\\custom\\airchoice_member\\templates\\find-a-flight-dashboard-form.html.twig");
    }
}
