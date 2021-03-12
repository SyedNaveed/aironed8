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

/* themes/custom/airchoiceone/templates/forms/form--book-flight-contact-information.html.twig */
class __TwigTemplate_b3c62499cce6940dfe96c0b9c93a595f25811dca4ce510d2ede7b4b8fef5c81e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 19, "t" => 20, "without" => 25];
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
        <p>";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Please fill all the information in English. Fields Marked with * are mandatory."));
        echo "</p>
        <p>";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Please enter first and last names as they appear on the passenger’s Government Issued ID or Passport."));
        echo "</p>
        <div class=\"book_page_contact_form\">
          <div class=\"row\">
            ";
        // line 24
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["element"] ?? null), "passengers", [])), "html", null, true);
        echo "
            ";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["element"] ?? null)), "passengers", "title", "ticket"), "html", null, true);
        echo "
          </div>
        </div>
      </div>
      <div class=\"col-md-3\">
        ";
        // line 30
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
        return "themes/custom/airchoiceone/templates/forms/form--book-flight-contact-information.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 30,  79 => 25,  75 => 24,  69 => 21,  65 => 20,  61 => 19,  55 => 15,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/forms/form--book-flight-contact-information.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/forms/form--book-flight-contact-information.html.twig");
    }
}
