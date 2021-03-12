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

/* themes/custom/airchoiceone/templates/aco/ticket.html.twig */
class __TwigTemplate_0686b9915246a5848f3f0429451005673b391801b69f78ad027acabc0a4c1d8d extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["trans" => 31];
        $filters = ["t" => 9, "escape" => 12];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['trans'],
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
        echo "<div id=\"your-ticket\" class=\"book_ticket\">
  <div class=\"book_ticket_header\">
    <h2>";
        // line 9
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Your Ticket"));
        echo "</h2>
  </div>

  ";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["flights"] ?? null)), "html", null, true);
        echo "

  <div class=\"book_ticket_body\">
    <h4>";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Summary"));
        echo "</h4>

    <div class=\"row rnp\">
      <div class=\"col-xs-3\">
        <b>";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Guests:"));
        echo "</b>
      </div>
      <div class=\"col-xs-9\">
        ";
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["guests"] ?? null)), "html", null, true);
        echo "
      </div>
    </div>

    <div class=\"row rnp\">
      <div class=\"col-xs-3\">
        <b>";
        // line 28
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Cost:"));
        echo "</b>
      </div>
      <div class=\"col-xs-9\">
        ";
        // line 31
        echo t("<span data-cost>@cost</span> (per passenger)", array("@cost" =>         // line 32
($context["cost"] ?? null), ));
        // line 34
        echo "      </div>
    </div>

    <div class=\"row rnp\">
      <div class=\"col-xs-3\">
        <b>";
        // line 39
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Fees:"));
        echo "</b>
      </div>
      <div class=\"col-xs-9\" data-fees>
        ";
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["fees"] ?? null)), "html", null, true);
        echo "
      </div>
    </div>

    <div class=\"row rnp\">
      <div class=\"col-xs-3\">
        <b>";
        // line 48
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Taxes:"));
        echo "</b>
      </div>
      <div class=\"col-xs-9\" data-taxes>
        ";
        // line 51
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["taxes"] ?? null)), "html", null, true);
        echo "
      </div>
    </div>
  </div>

  <div class=\"book_ticket_total\">
    <h5>";
        // line 57
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Total Cost"));
        echo "</h5>
    <h2 data-total-price>";
        // line 58
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["total"] ?? null)), "html", null, true);
        echo "</h2>
  </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/aco/ticket.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 58,  139 => 57,  130 => 51,  124 => 48,  115 => 42,  109 => 39,  102 => 34,  100 => 32,  99 => 31,  93 => 28,  84 => 22,  78 => 19,  71 => 15,  65 => 12,  59 => 9,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/aco/ticket.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/aco/ticket.html.twig");
    }
}
