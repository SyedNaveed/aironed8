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

/* themes/custom/airchoiceone/templates/paragraphs/paragraph--gallery.html.twig */
class __TwigTemplate_dcdc1f97b7b4bf5da858493cbab62ebe7722559e4e7eab019f512d63a33f9c52 extends \Twig\Template
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
        $tags = ["block" => 42];
        $filters = ["escape" => 41];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block'],
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
        echo "<div";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "gallery in"], "method")), "html", null, true);
        echo ">
  ";
        // line 42
        $this->displayBlock('paragraph', $context, $blocks);
        // line 50
        echo "</div>
";
    }

    // line 42
    public function block_paragraph($context, array $blocks = [])
    {
        // line 43
        echo "    ";
        $this->displayBlock('content', $context, $blocks);
        // line 49
        echo "  ";
    }

    // line 43
    public function block_content($context, array $blocks = [])
    {
        // line 44
        echo "      <h2 class=\"center\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_text", [])), "html", null, true);
        echo "</h2>
      <div class=\"fleet_gallery\">
        <div class=\"carousel\">";
        // line 46
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_media", [])), "html", null, true);
        echo "</div>
      </div>
    ";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/paragraphs/paragraph--gallery.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 46,  82 => 44,  79 => 43,  75 => 49,  72 => 43,  69 => 42,  64 => 50,  62 => 42,  57 => 41,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/paragraphs/paragraph--gallery.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/paragraphs/paragraph--gallery.html.twig");
    }
}
