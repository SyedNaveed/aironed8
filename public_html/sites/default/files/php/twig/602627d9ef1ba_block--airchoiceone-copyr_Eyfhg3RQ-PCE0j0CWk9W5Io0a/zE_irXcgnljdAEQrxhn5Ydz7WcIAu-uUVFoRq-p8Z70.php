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

/* themes/custom/airchoiceone/templates/blocks/block--airchoiceone-copyright-navigation.html.twig */
class __TwigTemplate_156bdc58dbb693b2ec3eb9bd2150b12ac818e8df99f0526145fe4b1aa71eb4f1 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["block" => 38];
        $filters = ["t" => 39, "escape" => 39];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['block'],
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
        // line 36
        echo "<div class=\"copyright center\">
  ";
        // line 38
        echo "  ";
        $this->displayBlock('content', $context, $blocks);
        // line 42
        echo "</div>
";
    }

    // line 38
    public function block_content($context, array $blocks = [])
    {
        // line 39
        echo "    ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Copyright Air Choice One - All Rights Reserved "));
        echo "<span class=\"nophone\">|</span> ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null)), "html", null, true);
        echo "<br><br>
    <a href=\"https://www.delt.net\" rel=\"noreferrer\" target=\"_blank\">";
        // line 40
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Website design by DELT"));
        echo "</a>
  ";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/blocks/block--airchoiceone-copyright-navigation.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  77 => 40,  70 => 39,  67 => 38,  62 => 42,  59 => 38,  56 => 36,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/blocks/block--airchoiceone-copyright-navigation.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/blocks/block--airchoiceone-copyright-navigation.html.twig");
    }
}
