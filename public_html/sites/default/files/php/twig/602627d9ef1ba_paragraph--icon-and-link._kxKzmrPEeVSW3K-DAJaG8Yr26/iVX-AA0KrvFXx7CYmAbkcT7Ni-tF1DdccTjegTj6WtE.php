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

/* themes/custom/airchoiceone/templates/paragraphs/paragraph--icon-and-link.html.twig */
class __TwigTemplate_a38df87bec1ce04054ae6e01d7a192c13d61ee6d64920c4573efec42fc1faa3b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'paragraph' => [$this, 'block_paragraph'],
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 41, "if" => 45, "include" => 52];
        $filters = ["escape" => 43];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block', 'if', 'include'],
                ['escape'],
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
        // line 41
        $this->displayBlock('paragraph', $context, $blocks);
    }

    public function block_paragraph($context, array $blocks = [])
    {
        // line 42
        echo "  ";
        $this->displayBlock('content', $context, $blocks);
    }

    public function block_content($context, array $blocks = [])
    {
        // line 43
        echo "    <a href=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_link", []), 0, []), "url", [])), "html", null, true);
        echo "\">
      <div";
        // line 44
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">
        ";
        // line 45
        if ((($this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_icon", []), 0, []), "value", []) == "briefcase") || ($this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_icon", []), 0, []), "value", []) == "wheelchair"))) {
            // line 46
            echo "          <div class=\"news_box_icons_inside nbi2\">
        ";
        } elseif (($this->getAttribute($this->getAttribute($this->getAttribute(        // line 47
($context["paragraph"] ?? null), "field_icon", []), 0, []), "value", []) == "beach")) {
            // line 48
            echo "          <div class=\"news_box_icons_inside nbi4\">
        ";
        } else {
            // line 50
            echo "          <div class=\"news_box_icons_inside\">
        ";
        }
        // line 52
        echo "          ";
        $this->loadTemplate((("themes/custom/airchoiceone/images/icons/" . $this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_icon", []), 0, []), "value", [])) . ".svg"), "themes/custom/airchoiceone/templates/paragraphs/paragraph--icon-and-link.html.twig", 52)->display($context);
        // line 53
        echo "          <h4>";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute(($context["paragraph"] ?? null), "field_link", []), 0, []), "title", [])), "html", null, true);
        echo "</h4>
        </div>
      </div>
    </a>
  ";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/paragraphs/paragraph--icon-and-link.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  97 => 53,  94 => 52,  90 => 50,  86 => 48,  84 => 47,  81 => 46,  79 => 45,  75 => 44,  70 => 43,  63 => 42,  57 => 41,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/paragraphs/paragraph--icon-and-link.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/paragraphs/paragraph--icon-and-link.html.twig");
    }
}
