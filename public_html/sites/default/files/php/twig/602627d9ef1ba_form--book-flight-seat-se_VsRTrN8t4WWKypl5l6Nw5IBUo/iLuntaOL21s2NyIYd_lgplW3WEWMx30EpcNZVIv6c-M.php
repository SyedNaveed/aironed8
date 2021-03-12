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

/* themes/custom/airchoiceone/templates/forms/form--book-flight-seat-selection.html.twig */
class __TwigTemplate_8ca4a4df8caea3479cb87e54406a4383630f71d3838c5a8db49c260710da0b03 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 19, "t" => 31, "without" => 80];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 't', 'without'],
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
        echo "<div class=\"book_page\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-9\">
        <h1 class=\"h2\">";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "title", [])), "html", null, true);
        echo "</h1>
        ";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "tab_buttons", [])), "html", null, true);
        echo "

        <div class=\"divide50\"></div>

        <div class=\"row\">
          <div class=\"col-md-12 col-sm-5\">
            <div class=\"book_page_table\">
              <div class=\"book_page_table_head show_tablet bp_seats\">
                <div class=\"row\">
                  <div class=\"col-md-2 col-sm-12 bpth_br bpth_seat\">
                    <span></span>
                    <h4>";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Selected"));
        echo "</h4>
                  </div>
                  <div class=\"col-md-2 col-sm-12 bpth_br bpth_seat\">
                    <span></span>
                    <h4>";
        // line 35
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Unavailable"));
        echo "</h4>
                  </div>
                  <div class=\"col-md-2 col-sm-12 bpth_br bpth_seat\">
                    <span></span>
                    <h4>";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Occupied"));
        echo "</h4>
                  </div>
                  <div class=\"col-md-2 col-sm-12 bpth_br bpth_seat\">
                    <span></span>
                    <h4>";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Standard"));
        echo "</h4>
                  </div>
                  <div class=\"col-md-2 col-sm-12 bpth_br bpth_seat\">
                    <span></span>
                    <h4>";
        // line 47
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Plus"));
        echo "</h4>
                  </div>
                  <div class=\"col-md-2 col-sm-12 bpth_seat\">
                    <span></span>
                    <h4>";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Premium/Emergency"));
        echo "</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class=\"col-md-4 col-sm-7\">
            ";
        // line 59
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "seats", [])), "html", null, true);
        echo "
          </div>

          <div class=\"col-md-8 col-sm-12\">
            ";
        // line 63
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "seat_selections", [])), "html", null, true);
        echo "

            <div class=\"divide40\"></div>

            <h4 class=\"seat_list_h4\">";
        // line 67
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("To travel in an emergency exit row seat a passenger must:"));
        echo "</h4>
            <ul class=\"seats_list\">
              <li>";
        // line 69
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Be 16 years of age or older."));
        echo "</li>
              <li>";
        // line 70
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Be able to understand the operating instructions."));
        echo "</li>
              <li>";
        // line 71
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Be able to operate the emergency exit without causing themselves bodily harm."));
        echo "</li>
              <li>";
        // line 72
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Be able to visually determine if the exit is safe to open."));
        echo "</li>
              <li>";
        // line 73
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Not require special handling or the use of a mobility aid or medical device."));
        echo "</li>
              <li>";
        // line 74
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Not be traveling with an animal in the cabin."));
        echo "</li>
              <li>";
        // line 75
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Not be solely responsible for another person."));
        echo "</li>
              <li>";
        // line 76
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Not require a seatbelt extender as this presents a tripping hazard."));
        echo "</li>
            </ul>

            <div class=\"seat_buttons center\">
              ";
        // line 80
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["element"] ?? null)), "actions", "tab_buttons", "seats", "seat_selections", "title", "ticket"), "html", null, true);
        echo "
              ";
        // line 81
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "actions", [])), "previous"), "html", null, true);
        echo "
            </div>
            <div class=\"center mbm40\">
              ";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["element"] ?? null), "actions", []), "previous", [])), "html", null, true);
        echo "
            </div>
          </div>
        </div>
      </div>
      <div class=\"col-md-3\">
        ";
        // line 90
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
        return "themes/custom/airchoiceone/templates/forms/form--book-flight-seat-selection.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 90,  189 => 84,  183 => 81,  179 => 80,  172 => 76,  168 => 75,  164 => 74,  160 => 73,  156 => 72,  152 => 71,  148 => 70,  144 => 69,  139 => 67,  132 => 63,  125 => 59,  114 => 51,  107 => 47,  100 => 43,  93 => 39,  86 => 35,  79 => 31,  65 => 20,  61 => 19,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/forms/form--book-flight-seat-selection.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/forms/form--book-flight-seat-selection.html.twig");
    }
}
