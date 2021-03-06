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

/* themes/custom/airchoiceone_new/templates/frontpage/page--front.html.twig */
class __TwigTemplate_e4e7836f60934eda9e4b1459bf7f89a0d3d9657376b81c0686b98b657e09cf8e extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["include" => 47, "if" => 53];
        $filters = ["escape" => 55];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['include', 'if'],
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
        // line 45
        echo "
<!-- HEADER-->
";
        // line 47
        $this->loadTemplate("@bootstrap_for_drupal/includes/header.html.twig", "themes/custom/airchoiceone_new/templates/frontpage/page--front.html.twig", 47)->display($context);
        // line 48
        echo "<!-- HEADER-->

";
        // line 51
        echo "<div id=\"banner-section\" class=\"banner-front\">
  <!-- CONTENT BEFORE -->
    ";
        // line 53
        if ($this->getAttribute(($context["page"] ?? null), "banner_section", [])) {
            // line 54
            echo "        
        ";
            // line 55
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "banner_section", [])), "html", null, true);
            echo "
    
    ";
        }
        // line 58
        echo "  
  <!-- CONTENT BEFORE -->
  
</div>
";
        // line 63
        echo "
<!-- MAIN -->
<main role=\"main\">
  <a id=\"main-content\" tabindex=\"-1\"></a>
  ";
        // line 68
        echo "  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col col-print-12\">

          <!-- CONTENT BEFORE -->
          ";
        // line 73
        if ($this->getAttribute(($context["page"] ?? null), "content_before", [])) {
            // line 74
            echo "            <aside class=\"mt-2 mt-md-3\" id=\"content-before\">
              ";
            // line 75
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_before", [])), "html", null, true);
            echo "
            </aside>
          ";
        }
        // line 78
        echo "          
          <!-- CONTENT BEFORE -->

          <!-- MAIN CONTENT -->
          <section class=\"py-2 py-md-3\" id=\"page-content\">
            ";
        // line 83
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content", [])), "html", null, true);
        echo "
          </section>
          <!-- MAIN CONTENT -->

          <!-- CONTENT AFTER -->
          ";
        // line 88
        if ($this->getAttribute(($context["page"] ?? null), "content_after", [])) {
            // line 89
            echo "            <aside  id=\"content-after\">
              ";
            // line 90
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_after", [])), "html", null, true);
            echo "
            </aside>
          ";
        }
        // line 93
        echo "        </div>
        <!-- CONTENT AFTER --> 

      </div>
    </div>
  </div>
</main>
<!-- MAIN -->

<div id=\"full-witdh-container\" class=\"full-width-container\">
  <!-- CONTENT BEFORE -->
    ";
        // line 104
        if ($this->getAttribute(($context["page"] ?? null), "full_width", [])) {
            // line 105
            echo "        
      ";
            // line 106
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "full_width", [])), "html", null, true);
            echo "
    
    ";
        }
        // line 109
        echo "  
  <!-- CONTENT BEFORE -->
  
</div>

<div id=\"content-area-second\" class=\"content-area-second container\">
  <!-- CONTENT BEFORE -->
    ";
        // line 116
        if ($this->getAttribute(($context["page"] ?? null), "content_area_second", [])) {
            // line 117
            echo "        
      ";
            // line 118
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "content_area_second", [])), "html", null, true);
            echo "
    
    ";
        }
        // line 121
        echo "  <!-- CONTENT BEFORE -->
</div>
<!-- FOOTER -->
";
        // line 124
        $this->loadTemplate("@bootstrap_for_drupal/includes/footer.html.twig", "themes/custom/airchoiceone_new/templates/frontpage/page--front.html.twig", 124)->display($context);
        // line 125
        echo "<!-- FOOTER -->
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone_new/templates/frontpage/page--front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 125,  185 => 124,  180 => 121,  174 => 118,  171 => 117,  169 => 116,  160 => 109,  154 => 106,  151 => 105,  149 => 104,  136 => 93,  130 => 90,  127 => 89,  125 => 88,  117 => 83,  110 => 78,  104 => 75,  101 => 74,  99 => 73,  92 => 68,  86 => 63,  80 => 58,  74 => 55,  71 => 54,  69 => 53,  65 => 51,  61 => 48,  59 => 47,  55 => 45,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * Theme override to display a single page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.html.twig template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - base_path: The base URL path of the Drupal installation. Will usually be
 *   \"/\" unless you have installed Drupal in a sub-directory.
 * - is_front: A flag indicating if the current page is the front page.
 * - logged_in: A flag indicating if the user is registered and signed in.
 * - is_admin: A flag indicating if the user has permission to access
 *   administration pages.
 *
 * Site identity:
 * - front_page: The URL of the front page. Use this instead of base_path when
 *   linking to the front page. This includes the language domain or prefix.
 *
 * Page content (in order of occurrence in the default page.html.twig):
 * - node: Fully loaded node, if there is an automatically-loaded node
 *   associated with the page and the node ID is the second argument in the
 *   page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - page.header: Items for the header region.
 * - page.primary_menu: Items for the primary menu region.
 * - page.secondary_menu: Items for the secondary menu region.
 * - page.highlighted: Items for the highlighted content region.
 * - page.help: Dynamic help text, mostly for admin pages.
 * - page.content: The main content of the current page.
 * - page.sidebar_first: Items for the first sidebar.
 * - page.sidebar_second: Items for the second sidebar.
 * - page.footer: Items for the footer region.
 * - page.breadcrumb: Items for the breadcrumb region.
 *
 * @see template_preprocess_page()
 * @see html.html.twig
 */
#}

<!-- HEADER-->
{% include '@bootstrap_for_drupal/includes/header.html.twig' %}
<!-- HEADER-->

{# banner section  start  #}
<div id=\"banner-section\" class=\"banner-front\">
  <!-- CONTENT BEFORE -->
    {% if page.banner_section %}
        
        {{ page.banner_section }}
    
    {% endif %}
  
  <!-- CONTENT BEFORE -->
  
</div>
{# banner section  end   #}

<!-- MAIN -->
<main role=\"main\">
  <a id=\"main-content\" tabindex=\"-1\"></a>
  {# link is in html.html.twig #}
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col col-print-12\">

          <!-- CONTENT BEFORE -->
          {% if page.content_before %}
            <aside class=\"mt-2 mt-md-3\" id=\"content-before\">
              {{ page.content_before }}
            </aside>
          {% endif %}
          
          <!-- CONTENT BEFORE -->

          <!-- MAIN CONTENT -->
          <section class=\"py-2 py-md-3\" id=\"page-content\">
            {{ page.content }}
          </section>
          <!-- MAIN CONTENT -->

          <!-- CONTENT AFTER -->
          {% if page.content_after %}
            <aside  id=\"content-after\">
              {{ page.content_after }}
            </aside>
          {% endif %}
        </div>
        <!-- CONTENT AFTER --> 

      </div>
    </div>
  </div>
</main>
<!-- MAIN -->

<div id=\"full-witdh-container\" class=\"full-width-container\">
  <!-- CONTENT BEFORE -->
    {% if page.full_width %}
        
      {{ page.full_width }}
    
    {% endif %}
  
  <!-- CONTENT BEFORE -->
  
</div>

<div id=\"content-area-second\" class=\"content-area-second container\">
  <!-- CONTENT BEFORE -->
    {% if page.content_area_second %}
        
      {{ page.content_area_second }}
    
    {% endif %}
  <!-- CONTENT BEFORE -->
</div>
<!-- FOOTER -->
{% include '@bootstrap_for_drupal/includes/footer.html.twig' %}
<!-- FOOTER -->
", "themes/custom/airchoiceone_new/templates/frontpage/page--front.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\themes\\custom\\airchoiceone_new\\templates\\frontpage\\page--front.html.twig");
    }
}
