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

/* themes/custom/airchoiceone/templates/aco/confirmed-itinerary.html.twig */
class __TwigTemplate_313a47c6c01e312f200016c3206b3d925357a4620d7b12f279142826fed92d6c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 53];
        $filters = ["t" => 12, "escape" => 23];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['t', 'escape'],
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
        echo "<div class=\"book_page\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"new-row\">
        <div class=\"col-sm-12\">
          <h1 class=\"h2\">";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Your Confirmed Itinerary"));
        echo "</h1>
          <p>
            ";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("All prices are in United States Dollar. All times are airport local."));
        echo "
            <br>
            ";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Please print this page as confirmation of your reservation."));
        echo "
          </p>
        </div>
      </div>
      <div class=\"new-row section2\">
        <div class=\"seats_overview\">
          <div class=\"col-sm-6\">
            <h4>";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Reservation Number"));
        echo "</h4>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["reservation_number"] ?? null)), "html", null, true);
        echo "
          </div>
          <div class=\"col-sm-6\">
            <h4>";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Authorization Number"));
        echo "</h4>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["authorization_number"] ?? null)), "html", null, true);
        echo "
          </div>
        </div>
      </div>
      <div class=\"new-row section\">
        <div class=\"col-sm-12\">
          <h4 class=\"section__header\">";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Trip Details"));
        echo "</h4>
          ";
        // line 33
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["trip_details"] ?? null)), "html", null, true);
        echo "
        </div>
      </div>
      <div class=\"new-row section\">
        <div class=\"col-sm-12\">
          <h4 class=\"section__header\">";
        // line 38
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Reservation Charges"));
        echo "</h4>
          ";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["charge_summary"] ?? null)), "html", null, true);
        echo "
        </div>
      </div>
      <div class=\"new-row section\">
        <div class=\"col-sm-12\">
          <h4 class=\"section__header\">";
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Contact Information"));
        echo "</h4>
        </div>
        ";
        // line 46
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["contact_information"] ?? null)), "html", null, true);
        echo "
      </div>
      <div class=\"new-row section\">
        <div class=\"col-sm-12\">
          <p>";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Would you like to insure your travel? <a href=\"http://www.travelinsured.com/agency?agency=53604&amp;r=http%3a%2f%2f&amp;p=dwood\" rel=\"noreferrer\" target=\"_blank\">Click here to learn more</a>"));
        echo "</p>
        </div>
      </div>
      ";
        // line 53
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["actions"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["action"]) {
            // line 54
            echo "        <div class=\"new-row section\">
          <div class=\"col-sm-12\">
            ";
            // line 56
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($context["action"]), "html", null, true);
            echo "
          </div>
        </div>
      ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['action'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 60
        echo "    </div>
  </div>
</div>

<div class=\"pd\"></div>
<div class=\"pd\"></div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/confirmed-itinerary.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  161 => 60,  151 => 56,  147 => 54,  143 => 53,  137 => 50,  130 => 46,  125 => 44,  117 => 39,  113 => 38,  105 => 33,  101 => 32,  90 => 26,  82 => 23,  72 => 16,  67 => 14,  62 => 12,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/confirmed-itinerary.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/confirmed-itinerary.html.twig");
    }
}
