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

/* themes/custom/airchoiceone/templates/content/node--flight-destination-page--full.html.twig */
class __TwigTemplate_bdb8c2d76c0e6816550f5655b33af04228581170dcd5a2a82e18aba078688085 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 19, "trans" => 41];
        $filters = ["escape" => 10, "t" => 12];
        $functions = ["drupal_menu" => 10];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'trans'],
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
        echo "<div class=\"rel single_dest\">
  <div class=\"hero_destinations_form\" id=\"myHeader\">
    <div class=\"hero_home_form_title\">
      ";
        // line 10
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("booking", 1, 1, false), "html", null, true);
        echo "
      <div class=\"book_connect_btn\">
        <button class=\"blue_btn book_connect\">";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Book Connecting Flight"));
        echo "</button>
        <span class=\"book_connect_dd\">
          ";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("book", 1, 1, false), "html", null, true);
        echo "
        </span>
      </div>
      <h1 class=\"white h2\">";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
        echo "</h1>
    </div>
    ";
        // line 19
        if ($this->getAttribute(($context["content"] ?? null), "book_flight_form", [], "any", true, true)) {
            // line 20
            echo "      <div class=\"row form_row\">
        ";
            // line 21
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "book_flight_form", [])), "html", null, true);
            echo "
      </div>
    ";
        }
        // line 24
        echo "  </div>

  <div class=\"single_dest_hero\">
    <div class=\"row rnp\">
      <div class=\"col-lg-6\">
        ";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_banner_image", [])), "html", null, true);
        echo "
      </div>
      <div class=\"col-lg-6\"></div>
    </div>
  </div>

  <div class=\"container_push_right\">

    <div class=\"pd\"></div>
    <div class=\"row rnp\">
      <div class=\"col-lg-5 col-sm-12 space\">

        <h2>";
        // line 41
        echo t("From @node.field_city.0.value, enjoy affordable flights to and from:", array("@node.field_city.0.value" => $this->getAttribute($this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_city", []), 0, []), "value", []), ));
        echo "</h2>

        ";
        // line 43
        if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs", []), "isEmpty", [], "method")) {
            // line 44
            echo "          <div class=\"destionations_icons\">
            ";
            // line 45
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_paragraphs", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 48
        echo "
        ";
        // line 49
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "body", [])), "html", null, true);
        echo "

        ";
        // line 51
        if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_iframe", []), "isEmpty", [], "method")) {
            // line 52
            echo "          <div class=\"destination_map\">
            ";
            // line 53
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_iframe", [])), "html", null, true);
            echo "
          </div>
        ";
        }
        // line 56
        echo "      </div>
    </div>
  </div>
  <div class=\"pd\"></div>
  <div id=\"moredestinations\"></div>
</div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/content/node--flight-destination-page--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  149 => 56,  143 => 53,  140 => 52,  138 => 51,  133 => 49,  130 => 48,  124 => 45,  121 => 44,  119 => 43,  114 => 41,  99 => 29,  92 => 24,  86 => 21,  83 => 20,  81 => 19,  76 => 17,  70 => 14,  65 => 12,  60 => 10,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/content/node--flight-destination-page--full.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/content/node--flight-destination-page--full.html.twig");
    }
}
