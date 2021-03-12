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

/* themes/custom/airchoiceone/templates/aco/contact-information.html.twig */
class __TwigTemplate_bd9098aa77a53bd4d98aefa405d02ac55789486d435383b82d6a2650f5906251 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 23];
        $filters = ["t" => 8, "escape" => 12];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
        echo "<div class=\"col-sm-12\">
  ";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Primary Reservation Contact Information"));
        echo "
</div>
<div class=\"contact_information\">
  <div class=\"col-sm-12\">
    <h5>";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Title"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["honorific"] ?? null)), "html", null, true);
        echo "
  </div>
  <div class=\"col-sm-4\">
    <h5>";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("First Name"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["firstName"] ?? null)), "html", null, true);
        echo "
  </div>
  <div class=\"col-sm-4\">
    <h5>";
        // line 18
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Middle Name"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["middleName"] ?? null)), "html", null, true);
        echo "
  </div>
  <div class=\"col-sm-4\">
    <h5>";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Last Name"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["lastName"] ?? null)), "html", null, true);
        echo "
  </div>
  ";
        // line 23
        if (((( !twig_test_empty(($context["address1"] ?? null)) &&  !twig_test_empty(($context["city"] ?? null))) &&  !twig_test_empty(($context["country"] ?? null))) &&  !twig_test_empty(($context["province"] ?? null)))) {
            // line 24
            echo "    <div class=\"col-sm-4\">
      <h5>";
            // line 25
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Address Line 1"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["address1"] ?? null)), "html", null, true);
            echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
            // line 28
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Address Line 2"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["address2"] ?? null)), "html", null, true);
            echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
            // line 31
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("City"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["city"] ?? null)), "html", null, true);
            echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
            // line 34
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Country"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["country"] ?? null)), "html", null, true);
            echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
            // line 37
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Province/State"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["province"] ?? null)), "html", null, true);
            echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
            // line 40
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Postal Code"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["postalCode"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 43
        echo "  <div class=\"col-sm-4\">
    <h5>";
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Date of Birth"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["birthDate"] ?? null)), "html", null, true);
        echo "
  </div>
  ";
        // line 46
        if ( !twig_test_empty(($context["loyaltyProgram"] ?? null))) {
            // line 47
            echo "    <div class=\"col-sm-4\">
      <h5>";
            // line 48
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Loyalty ID"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["loyaltyProgram"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 51
        echo "  ";
        if ( !twig_test_empty(($context["redressNumber"] ?? null))) {
            // line 52
            echo "    <div class=\"col-sm-4\">
      <h5>";
            // line 53
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Redress Number"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["redressNumber"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 56
        echo "  ";
        if ( !twig_test_empty(($context["knownPassengerNumber"] ?? null))) {
            // line 57
            echo "    <div class=\"col-sm-4\">
      <h5>";
            // line 58
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Known Traveler Number"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["knownPassengerNumber"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 61
        echo "  ";
        if ( !twig_test_empty(($context["phoneNumber"] ?? null))) {
            // line 62
            echo "    <div class=\"new-row col-sm-4\">
      <h5>";
            // line 63
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Phone Number"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["phoneNumber"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 66
        echo "  ";
        if ( !twig_test_empty(($context["mobileNumber"] ?? null))) {
            // line 67
            echo "    <div class=\"col-sm-8\">
      <h5>";
            // line 68
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Mobile Number"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["mobileNumber"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 71
        echo "  ";
        if ( !twig_test_empty(($context["notificationPreferences"] ?? null))) {
            // line 72
            echo "    <div class=\"col-sm-12\">
      <h5>";
            // line 73
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Notification Preferences"));
            echo "</h5>";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["notificationPreferences"] ?? null)), "html", null, true);
            echo "
    </div>
  ";
        }
        // line 76
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/contact-information.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 76,  234 => 73,  231 => 72,  228 => 71,  220 => 68,  217 => 67,  214 => 66,  206 => 63,  203 => 62,  200 => 61,  192 => 58,  189 => 57,  186 => 56,  178 => 53,  175 => 52,  172 => 51,  164 => 48,  161 => 47,  159 => 46,  152 => 44,  149 => 43,  141 => 40,  133 => 37,  125 => 34,  117 => 31,  109 => 28,  101 => 25,  98 => 24,  96 => 23,  89 => 21,  81 => 18,  73 => 15,  65 => 12,  58 => 8,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/contact-information.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/contact-information.html.twig");
    }
}
