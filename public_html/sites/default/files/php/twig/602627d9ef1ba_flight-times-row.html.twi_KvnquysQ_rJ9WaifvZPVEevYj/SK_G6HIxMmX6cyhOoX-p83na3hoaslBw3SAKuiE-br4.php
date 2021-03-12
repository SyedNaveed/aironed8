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

/* themes/custom/airchoiceone/templates/aco/flight-times-row.html.twig */
class __TwigTemplate_2b6c3cbe66d01bb1bbc6ed7c320ee1cd28d46650ebe83f0602134ed2c8c88c6b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 8, "if" => 26];
        $filters = ["escape" => 9, "t" => 27];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for', 'if'],
                ['escape', 't'],
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
        echo "<div class=\"col-md-2 col-sm-4 col-xs-6 bs_depart\">
  ";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["departures"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["flight"]) {
            // line 9
            echo "    <span class=\"book_page_airport\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "flight", [])), "html", null, true);
            echo "</span><br>
    <span class=\"book_page_time\">";
            // line 10
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "time", [])), "html", null, true);
            echo "</span>
    <span class=\"book_page_airport\">";
            // line 11
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "code", [])), "html", null, true);
            echo "</span><br>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flight'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "</div>
<div class=\"col-md-2 col-sm-4 col-xs-6 bs_arrive\">
  ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["arrivals"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["flight"]) {
            // line 16
            echo "    <span class=\"book_page_airport\">&nbsp;</span><br>
    <span class=\"book_page_time\">";
            // line 17
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "time", [])), "html", null, true);
            echo "</span>
    <span class=\"book_page_airport\">";
            // line 18
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "code", [])), "html", null, true);
            echo "</span><br>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flight'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "</div>
<div class=\"col-md-1 col-sm-2 col-xs-12  bs_stops\">
  <span class=\"book_page_time\">";
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["stops"] ?? null)), "html", null, true);
        echo "</span>
</div>
<div class=\"col-md-2 col-sm-4 col-xs-12 bs_refund\">
  ";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["business_price"] ?? null)), "html", null, true);
        echo "
  ";
        // line 26
        if (twig_test_empty(($context["business_price"] ?? null))) {
            // line 27
            echo "    <span class=\"book_page_supersaver\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Sold Out"));
            echo "</span>
  ";
        } else {
            // line 29
            echo "    <span class=\"book_page_airport\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["business_detail"] ?? null)), "html", null, true);
            echo "</span>
  ";
        }
        // line 31
        echo "</div>
<div class=\"col-md-3 col-sm-4 col-xs-12 bs_nonrefund\">
  ";
        // line 33
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["everyday_price"] ?? null)), "html", null, true);
        echo "
  ";
        // line 34
        if (twig_test_empty(($context["everyday_price"] ?? null))) {
            // line 35
            echo "    <span class=\"book_page_supersaver\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Sold Out"));
            echo "</span>
  ";
        } else {
            // line 37
            echo "    <span class=\"book_page_airport\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["everyday_detail"] ?? null)), "html", null, true);
            echo "</span>
  ";
        }
        // line 39
        echo "</div>
<div class=\"col-md-2 col-sm-4 col-xs-12 bs_ss\">
  ";
        // line 41
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["go_your_way_price"] ?? null)), "html", null, true);
        echo "
  ";
        // line 42
        if (twig_test_empty(($context["go_your_way_price"] ?? null))) {
            // line 43
            echo "    <span class=\"book_page_supersaver\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Sold Out"));
            echo "</span>
  ";
        } else {
            // line 45
            echo "    <span class=\"book_page_airport\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["go_your_way_detail"] ?? null)), "html", null, true);
            echo "</span>
  ";
        }
        // line 47
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/flight-times-row.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  174 => 47,  168 => 45,  162 => 43,  160 => 42,  156 => 41,  152 => 39,  146 => 37,  140 => 35,  138 => 34,  134 => 33,  130 => 31,  124 => 29,  118 => 27,  116 => 26,  112 => 25,  106 => 22,  102 => 20,  94 => 18,  90 => 17,  87 => 16,  83 => 15,  79 => 13,  71 => 11,  67 => 10,  62 => 9,  58 => 8,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/flight-times-row.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/flight-times-row.html.twig");
    }
}
