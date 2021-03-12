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

/* themes/custom/airchoiceone/templates/content/node--flight-destinations-page--full.html.twig */
class __TwigTemplate_52cad32fdcf638cb76756f7ab34fe555673b1694f77551d8d324cd40d9488595 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 26];
        $filters = ["escape" => 10, "t" => 17];
        $functions = ["drupal_menu" => 15];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape', 't'],
                ['drupal_menu']
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
        echo "<div class=\"container_push_right in\">
  <div class=\"row\">
    <div class=\"col-lg-6 space destionations_page\">
      ";
        // line 10
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "body", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-lg-6\">
      <div class=\"form_right\">
        <div class=\"hero_home_form_title\">
          ";
        // line 15
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("booking", 1, 1, false), "html", null, true);
        echo "
          <div class=\"book_connect_btn\">
            <button class=\"blue_btn book_connect\">";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Book Connecting Flight"));
        echo "</button>
            <span class=\"book_connect_dd\">
              ";
        // line 19
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("book", 1, 1, false), "html", null, true);
        echo "
            </span>
          </div>
          <h2 class=\"white\">";
        // line 22
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Book your flight"));
        echo "</h2>
        </div>
        <div class=\"divide20 nophone\"></div>

        ";
        // line 26
        if ($this->getAttribute(($context["content"] ?? null), "book_flight_form", [], "any", true, true)) {
            // line 27
            echo "          <div class=\"row form_row\">
            ";
            // line 28
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "book_flight_form", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 31
        echo "      </div>
    </div>
  </div>
</div>

";
        // line 36
        if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs", []), "isEmpty", [], "method")) {
            // line 37
            echo "  <div class=\"container\">
    ";
            // line 38
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_paragraphs", [])), "html", null, true);
            echo "
  </div>
";
        }
        // line 41
        echo "
<div class=\"pd\"></div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/content/node--flight-destinations-page--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 41,  114 => 38,  111 => 37,  109 => 36,  102 => 31,  96 => 28,  93 => 27,  91 => 26,  84 => 22,  78 => 19,  73 => 17,  68 => 15,  60 => 10,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/content/node--flight-destinations-page--full.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/content/node--flight-destinations-page--full.html.twig");
    }
}
