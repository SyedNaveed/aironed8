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

/* themes/custom/airchoiceone/templates/aco/payment-information.html.twig */
class __TwigTemplate_8cce8ba4af91e9461f407cec96e78e6d6d5bd80b2019538e9b1936f42379e217 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["t" => 9, "escape" => 13];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
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
        echo "<div class=\"spacing-bottom new-row\">
  <div class=\"col-sm-12\">
    ";
        // line 9
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Credit Card Details"));
        echo "
  </div>
  <div class=\"contact_information\">
    <div class=\"col-sm-4\">
      <h5>";
        // line 13
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Payment Type"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["payment_type"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Card Number"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["card_number"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Expiry Date"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["expiry"] ?? null)), "html", null, true);
        echo "
    </div>
  </div>
</div>
<div class=\"new-row\">
  <div class=\"col-sm-12\">
    ";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Cardholder Information"));
        echo "
  </div>
  <div class=\"contact_information\">
    <div class=\"col-sm-4\">
      <h5>";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Name"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["name"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Address Line 1"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["address1"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 35
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Address Line 2"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["address2"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 38
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("City"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["city"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 41
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Country"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["country"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Province/State"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["province"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 47
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Postal Code"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["postalCode"] ?? null)), "html", null, true);
        echo "
    </div>
    <div class=\"col-sm-4\">
      <h5>";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Phone Number"));
        echo "</h5>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["phoneNumber"] ?? null)), "html", null, true);
        echo "
    </div>
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/payment-information.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 50,  148 => 47,  140 => 44,  132 => 41,  124 => 38,  116 => 35,  108 => 32,  100 => 29,  93 => 25,  82 => 19,  74 => 16,  66 => 13,  59 => 9,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/payment-information.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/payment-information.html.twig");
    }
}
