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

/* themes/custom/airchoiceone/templates/forms/form--book-flight-confirm.html.twig */
class __TwigTemplate_15d2bf6db005e8dd6b06e6d3a2df305ee9a2b9911e764f3dd8dc3c91513455d3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 19, "t" => 22, "without" => 58];
        $functions = ["path" => 26];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 't', 'without'],
                ['path']
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
        echo "<div class=\"book_page\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-9\">
        <h1 class=\"h2\">";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "title", [])), "html", null, true);
        echo "</h1>
        <div class=\"new-row section spacing-bottom row\">
          <div class=\"col-sm-12\">
            <h4 class=\"section__header\">";
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Trip Details"));
        echo "</h4>
            ";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "trip_details", [])), "html", null, true);
        echo "
          </div>
          <div class=\"col-sm-12 section3 text-align-right\">
            <p>";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("To change any of the above selections, "));
        echo "<a href=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("aco_book_flight.book_flight.step", ["step" => "flight-selection"]));
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("click here"));
        echo "</a>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("."));
        echo "</p>
          </div>
        </div>
        <div class=\"new-row section spacing-bottom\">
          <div class=\"col-sm-12\">
            <h4 class=\"section__header\">";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Reservation Charges"));
        echo "</h4>
            ";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "charge_summary", [])), "html", null, true);
        echo "
          </div>
          <div class=\"col-sm-12 section3 text-align-right\">
            <p>";
        // line 35
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("To change any of the above selections, "));
        echo "<a href=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("aco_book_flight.book_flight.step", ["step" => "flight-selection"]));
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("click here"));
        echo "</a>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("."));
        echo "</p>
          </div>
        </div>
        <div class=\"new-row section spacing-bottom\">
          <div class=\"col-sm-12\">
            <h4 class=\"section__header\">";
        // line 40
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Contact Information"));
        echo "</h4>
          </div>
          ";
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "contact_information", [])), "html", null, true);
        echo "
          <div class=\"col-sm-12 section3 text-align-right\">
            <p>";
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("To change any of the above selections, "));
        echo "<a href=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("aco_book_flight.book_flight.step", ["step" => "contact-information"]));
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("click here"));
        echo "</a>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("."));
        echo "</p>
          </div>
        </div>
        <div class=\"new-row section spacing-bottom\">
          <div class=\"col-sm-12\">
            <h4 class=\"section__header\">";
        // line 49
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Payment Information"));
        echo "</h4>
          </div>
          ";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "payment_information", [])), "html", null, true);
        echo "
          <div class=\"col-sm-12 section3 text-align-right\">
            <p>";
        // line 53
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("To change any of the above selections, "));
        echo "<a href=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("aco_book_flight.book_flight.step", ["step" => "purchase"]));
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("click here"));
        echo "</a>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("."));
        echo "</p>
          </div>
        </div>
        <div class=\"new-row section spacing-bottom\">
          <div class=\"col-sm-12\">
            ";
        // line 58
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["element"] ?? null)), "trip_details", "charge_summary", "contact_information", "payment_information", "title", "ticket"), "html", null, true);
        echo "
          </div>
        </div>
      </div>
      <div class=\"col-md-3\">
        ";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "ticket", [])), "html", null, true);
        echo "
      </div>
    </div>
  </div>
</div>

<div class=\"pd\"></div>
<div class=\"pd\"></div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/forms/form--book-flight-confirm.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 63,  163 => 58,  149 => 53,  144 => 51,  139 => 49,  125 => 44,  120 => 42,  115 => 40,  101 => 35,  95 => 32,  91 => 31,  77 => 26,  71 => 23,  67 => 22,  61 => 19,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/forms/form--book-flight-confirm.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/forms/form--book-flight-confirm.html.twig");
    }
}
