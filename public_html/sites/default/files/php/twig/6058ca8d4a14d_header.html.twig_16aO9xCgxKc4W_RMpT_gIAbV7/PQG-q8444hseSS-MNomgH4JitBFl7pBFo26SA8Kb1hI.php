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

/* @bootstrap_for_drupal/includes/header.html.twig */
class __TwigTemplate_2bdb9b70be96f5812acca57c405cbc2cea6fb441b153274bc47a8e804011bb73 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 2];
        $filters = ["escape" => 4];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
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
        // line 1
        echo "<!-- HEADER -->
";
        // line 2
        if ($this->getAttribute(($context["page"] ?? null), "header_special", [])) {
            // line 3
            echo "  <header class=\"bg-secondary\" role=\"special-message\">
    ";
            // line 4
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header_special", [])), "html", null, true);
            echo "
  </header>
";
        }
        // line 7
        echo "<header class=\"bg-secondary pt-3 \" role=\"banner-brand\" id=\"header-brand\">
  <div class=\"container\">

    <!-- branding header -->
    <div class=\"d-flex flex-md-column align-items-md-start\">
      <div class=\"d-md-flex\">
        <div class=\"d-none d-md-flex align-items-center\">
          <a class=\"navbar-brand d-flex text-white align-items-center\" href=\"";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
        echo "\"><img class=\"text-white mr-3 logo\" src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["logopath"] ?? null)), "html", null, true);
        echo "\">";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_name"] ?? null)), "html", null, true);
        echo "</a>
        </div>
        <div>
          <p class=\"d-flex align-items-center text-white h-100 pl-md-3 text-center text-md-left slogan\">";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_slogan"] ?? null)), "html", null, true);
        echo "</p>
        </div>
      </div>
    </div>
    <!-- branding header -->

  </div>
</header>
<header class=\"sticky-top d-print-none\" role=\"header-menu\" id=\"header-menu\">
  <nav role=\"main-navigation\" class=\"navbar navbar-dark navbar-expand-md bg-secondary px-0 px-md-3 mb-2 mb-md-0\">
    <div class=\"container\">

      <!-- Sticky bar logo -->
      <div class=\"ml-3 ml-md-0\">
        <a class=\"navbar-brand mr-2 d-flex align-items-center py-0\" href=\"";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["front_page"] ?? null)), "html", null, true);
        echo "\"><img class=\"navbar-brand mr-2 hide-logo logo\" src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["logopath"] ?? null)), "html", null, true);
        echo "\"/>
          <span class=\"d-md-none\">";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["site_name"] ?? null)), "html", null, true);
        echo "</span></a>
      </div>
      <!-- Sticky bar logo -->

      <!-- button collapse -->
      <button data-toggle=\"collapse\" class=\"navbar-toggler ml-auto mr-3 mr-sm-0\" data-target=\"#navigation-container\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <!-- button collapse -->

      <!-- navbar collapse / mobile Menu -->
      <div class=\"collapse navbar-collapse position-relative justify-content-between\" id=\"navigation-container\">

        <!-- nav_main -->
        <div id=\"menu-main\" class=\"search-effect\">
          ";
        // line 48
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "nav_main", [])), "html", null, true);
        echo "
        </div>
        <!-- nav_main -->

        <!-- nav_additional -->
        <div id=\"menu-add\">
          ";
        // line 54
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "nav_add", [])), "html", null, true);
        echo "
        </div>
        <!-- nav_additional -->

      </div>
      <!-- navbar collapse / mobile Menu -->

    </div>
  </nav>
</header>
<!-- HEADER -->
";
    }

    public function getTemplateName()
    {
        return "@bootstrap_for_drupal/includes/header.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  139 => 54,  130 => 48,  111 => 32,  105 => 31,  88 => 17,  78 => 14,  69 => 7,  63 => 4,  60 => 3,  58 => 2,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<!-- HEADER -->
{% if page.header_special %}
  <header class=\"bg-secondary\" role=\"special-message\">
    {{ page.header_special }}
  </header>
{% endif %}
<header class=\"bg-secondary pt-3 \" role=\"banner-brand\" id=\"header-brand\">
  <div class=\"container\">

    <!-- branding header -->
    <div class=\"d-flex flex-md-column align-items-md-start\">
      <div class=\"d-md-flex\">
        <div class=\"d-none d-md-flex align-items-center\">
          <a class=\"navbar-brand d-flex text-white align-items-center\" href=\"{{ front_page }}\"><img class=\"text-white mr-3 logo\" src=\"{{ logopath }}\">{{ site_name }}</a>
        </div>
        <div>
          <p class=\"d-flex align-items-center text-white h-100 pl-md-3 text-center text-md-left slogan\">{{ site_slogan }}</p>
        </div>
      </div>
    </div>
    <!-- branding header -->

  </div>
</header>
<header class=\"sticky-top d-print-none\" role=\"header-menu\" id=\"header-menu\">
  <nav role=\"main-navigation\" class=\"navbar navbar-dark navbar-expand-md bg-secondary px-0 px-md-3 mb-2 mb-md-0\">
    <div class=\"container\">

      <!-- Sticky bar logo -->
      <div class=\"ml-3 ml-md-0\">
        <a class=\"navbar-brand mr-2 d-flex align-items-center py-0\" href=\"{{ front_page }}\"><img class=\"navbar-brand mr-2 hide-logo logo\" src=\"{{ logopath }}\"/>
          <span class=\"d-md-none\">{{ site_name }}</span></a>
      </div>
      <!-- Sticky bar logo -->

      <!-- button collapse -->
      <button data-toggle=\"collapse\" class=\"navbar-toggler ml-auto mr-3 mr-sm-0\" data-target=\"#navigation-container\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"navbar-toggler-icon\"></span>
      </button>
      <!-- button collapse -->

      <!-- navbar collapse / mobile Menu -->
      <div class=\"collapse navbar-collapse position-relative justify-content-between\" id=\"navigation-container\">

        <!-- nav_main -->
        <div id=\"menu-main\" class=\"search-effect\">
          {{ page.nav_main }}
        </div>
        <!-- nav_main -->

        <!-- nav_additional -->
        <div id=\"menu-add\">
          {{ page.nav_add }}
        </div>
        <!-- nav_additional -->

      </div>
      <!-- navbar collapse / mobile Menu -->

    </div>
  </nav>
</header>
<!-- HEADER -->
", "@bootstrap_for_drupal/includes/header.html.twig", "/var/www/aironem/public_html/themes/contrib/bfd/templates/includes/header.html.twig");
    }
}
