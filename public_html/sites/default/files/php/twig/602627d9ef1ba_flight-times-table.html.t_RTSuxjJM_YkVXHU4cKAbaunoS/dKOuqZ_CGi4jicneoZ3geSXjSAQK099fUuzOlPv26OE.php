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

/* themes/custom/airchoiceone/templates/aco/flight-times-table.html.twig */
class __TwigTemplate_6b493d1be7f882ba6725ea9b2c217305ba003cdc2c43227ace1c5496c3f7d67e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 21, "if" => 43, "for" => 44];
        $filters = ["escape" => 7, "t" => 12, "raw" => 22, "striptags" => 22];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'if', 'for'],
                ['escape', 't', 'raw', 'striptags'],
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
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">
  <div class=\"book_page_table\">
    <div class=\"book_page_table_head\">
      <div class=\"row\">
        <div class=\"col-sm-2 col-md-2 bpth_br\">
          <h4>";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Depart"));
        echo "</h4>
        </div>
        <div class=\"col-sm-2 col-md-2 bpth_br\">
          <h4>";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Arrive"));
        echo "</h4>
        </div>
        <div class=\"col-md-1 col-sm-2 bpth_br\">
          <h4>";
        // line 18
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Stops"));
        echo "</h4>
        </div>
        <div class=\"col-md-2 col-sm-3 bpth_br hvr_btn\">
            <div class=\"fare_hover\">";
        // line 21
        echo t("<b>Business Fare</b><br>", array());
        // line 22
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["site_settings"] ?? null), "general", []), "flight_selection_page", []), "field_longtext", []), "value", [])), "<li>"));
        echo "
            </div>
            <h4><span>";
        // line 24
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Business"));
        echo "</span></h4>
        </div>
        <div class=\"col-md-3 col-sm-3 bpth_br tab_nonrefund hvr_btn\">
            <div class=\"fare_hover\">";
        // line 27
        echo t("<b>Everyday Fare</b><br>", array());
        // line 28
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["site_settings"] ?? null), "general", []), "flight_selection_page", []), "field_longtext2", []), "value", [])), "<li>"));
        echo "
            </div>
            <h4><span>";
        // line 30
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Everyday"));
        echo "</span></h4>
        </div>
        <div class=\"col-md-2 no_tablet hvr_btn\">
            <div class=\"fare_hover\">";
        // line 33
        echo t("<b>Go Your Way Fare</b><br>", array());
        // line 34
        echo "              ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(strip_tags($this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["site_settings"] ?? null), "general", []), "flight_selection_page", []), "field_longtext3", []), "value", [])), "<li>"));
        echo "
            </div>
            <h4><span>";
        // line 36
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Go Your Way"));
        echo "</span></h4>
        </div>
      </div>
    </div>
  </div>

  <div class=\"book_page_table_values\">
    ";
        // line 43
        if ( !twig_test_empty(($context["flights"] ?? null))) {
            // line 44
            echo "      ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["flights"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["flight"]) {
                // line 45
                echo "        <div class=\"row book_page_table_row\">
          ";
                // line 46
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["flight"]), "html", null, true);
                echo "
        </div>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flight'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 49
            echo "    ";
        } else {
            // line 50
            echo "      <div class=\"row book_page_table_row\">
        <p class=\"book_page_supersaver\">
          ";
            // line 52
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar("There are no flights available for your specifications.");
            echo "
        </p>
      </div>
    ";
        }
        // line 56
        echo "  </div>

  <div class=\"divide60\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/flight-times-table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 56,  154 => 52,  150 => 50,  147 => 49,  138 => 46,  135 => 45,  130 => 44,  128 => 43,  118 => 36,  112 => 34,  110 => 33,  104 => 30,  98 => 28,  96 => 27,  90 => 24,  84 => 22,  82 => 21,  76 => 18,  70 => 15,  64 => 12,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/flight-times-table.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/flight-times-table.html.twig");
    }
}
