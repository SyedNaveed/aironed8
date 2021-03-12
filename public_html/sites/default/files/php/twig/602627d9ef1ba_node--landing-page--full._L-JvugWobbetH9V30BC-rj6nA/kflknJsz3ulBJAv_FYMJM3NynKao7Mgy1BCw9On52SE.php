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

/* themes/custom/airchoiceone/templates/content/node--landing-page--full.html.twig */
class __TwigTemplate_4d90834141f6049a4529699bf1256c74885203a29a965d642d1a5ad841fbea67 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 7, "set" => 13];
        $filters = ["escape" => 9, "without" => 9, "length" => 13];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if', 'set'],
                ['escape', 'without', 'length'],
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
        if (($context["use_icon_and_link_layout"] ?? null)) {
            // line 8
            echo "  <div class=\"contain_2 in\">
    ";
            // line 9
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "field_paragraphs"), "html", null, true);
            echo "
  </div>

  ";
            // line 12
            if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs", []), "isEmpty", [], "method")) {
                // line 13
                echo "    ";
                $context["count"] = twig_length_filter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["node"] ?? null), "field_paragraphs", [])));
                // line 14
                echo "    ";
                if ((($context["count"] ?? null) > 4)) {
                    // line 15
                    echo "    <div class=\"container\">
      <div class=\"row eq\">
    ";
                } else {
                    // line 18
                    echo "    <div class=\"contain\">
      <div class=\"row\">
    ";
                }
                // line 21
                echo "        ";
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_paragraphs", [])), "html", null, true);
                echo "
      </div>
    </div>
  ";
            }
            // line 25
            echo "
  <div class=\"pd\"></div>
";
        } else {
            // line 28
            echo "  <div class=\"child_page_center in\">
    ";
            // line 29
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "field_paragraphs"), "html", null, true);
            echo "

    ";
            // line 31
            if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs", []), "isEmpty", [], "method")) {
                // line 32
                echo "      <div class=\"row\">
        ";
                // line 33
                echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_paragraphs", [])), "html", null, true);
                echo "
      </div>
    ";
            }
            // line 36
            echo "  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/content/node--landing-page--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 36,  110 => 33,  107 => 32,  105 => 31,  100 => 29,  97 => 28,  92 => 25,  84 => 21,  79 => 18,  74 => 15,  71 => 14,  68 => 13,  66 => 12,  60 => 9,  57 => 8,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/content/node--landing-page--full.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/content/node--landing-page--full.html.twig");
    }
}
