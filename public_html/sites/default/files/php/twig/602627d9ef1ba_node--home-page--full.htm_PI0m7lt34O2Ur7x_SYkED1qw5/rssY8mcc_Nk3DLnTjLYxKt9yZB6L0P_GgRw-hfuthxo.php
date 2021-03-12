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

/* themes/custom/airchoiceone/templates/content/node--home-page--full.html.twig */
class __TwigTemplate_d2eb88f082924634fef6123db7d56f98da31d8aaf2eab8e93b2d5a9fdb8da43b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 7, "if" => 13];
        $filters = ["escape" => 8, "t" => 23];
        $functions = ["file_url" => 7, "drupal_menu" => 21];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape', 't'],
                ['file_url', 'drupal_menu']
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
        $context["bg"] = (("background-image:url(" . call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_image3", []), 0, [], "array"), "#media", [], "array"), "field_media_image", []), "entity", []), "uri", []), "value", []))])) . ")");
        // line 8
        echo "<article";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "hero hero_home"], "method"), "setAttribute", [0 => "style", 1 => ($context["bg"] ?? null)], "method")), "html", null, true);
        echo ">
  <div class=\"overlay\"></div>
  <div class=\"hero_home_container\">
    <div class=\"hero_home_container_left\">
      <h1 class=\"white h3\">";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null)), "html", null, true);
        echo "</h1>
      ";
        // line 13
        if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_text", []), "isEmpty", [], "method")) {
            // line 14
            echo "        <p class=\"bigp\">";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_text", [])), "html", null, true);
            echo "</p>
      ";
        }
        // line 16
        echo "      ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_links", [])), "html", null, true);
        echo "
      ";
        // line 17
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_links2", [])), "html", null, true);
        echo "
    </div>
    <div class=\"hero_home_container_right\">
      <div class=\"hero_home_form_title\">
        ";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("booking", 1, 1, false), "html", null, true);
        echo "
        <div class=\"book_connect_btn\">
          <button class=\"blue_btn book_connect\">";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Book Connecting Flight"));
        echo "</button>
          <span class=\"book_connect_dd\">
            ";
        // line 25
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("book", 1, 1, false), "html", null, true);
        echo "
          </span>
        </div>
        <h2 class=\"white\">";
        // line 28
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar(t("Book your flight"));
        echo "</h2>
      </div>
      <div class=\"divide20 nophone\"></div>

      ";
        // line 32
        if ($this->getAttribute(($context["content"] ?? null), "book_flight_form", [], "any", true, true)) {
            // line 33
            echo "        <div class=\"row form_row\">
          ";
            // line 34
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "book_flight_form", [])), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 37
        echo "    </div>
  </div>
</article>

";
        // line 41
        if ( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_paragraphs", []), "isEmpty", [], "method")) {
            // line 42
            echo "  <div class=\"destination_slider in\">
    ";
            // line 43
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_paragraphs", [])), "html", null, true);
            echo "
  </div>
";
        }
        // line 46
        echo "
<div class=\"container\">
  <div class=\"row\">
    <div class=\"col-lg-1\"></div>
    <div class=\"col-lg-6 col-sm-7\">
      <div class=\"divide100 nophone nopro nt\"></div>
      <div class=\"divide60 nophone nopro nt\"></div>
      ";
        // line 53
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "body", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-lg-5 col-sm-5\">
      ";
        // line 56
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_image", [])), "html", null, true);
        echo "
    </div>
  </div>
</div>

<div class=\"pd nt nopro\"></div>

<div class=\"shadow_bar homepage_shadow_bar\">
  ";
        // line 64
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalMenu("footer-utility", 1, 1, false), "html", null, true);
        echo "
</div>

";
        // line 67
        if ((( !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_image2", []), "isEmpty", [], "method") &&  !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_text2", []), "isEmpty", [], "method")) &&  !$this->getAttribute($this->getAttribute(($context["node"] ?? null), "field_text3", []), "isEmpty", [], "method"))) {
            // line 68
            echo "  <div class=\"container in\">
    <div class=\"homepage_promo_box\" style=\"background:url(";
            // line 69
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, call_user_func_array($this->env->getFunction('file_url')->getCallable(), [$this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["content"] ?? null), "field_image2", []), 0, [], "array"), "#media", [], "array"), "field_media_image", []), "entity", []), "uri", []), "value", []))]), "html", null, true);
            echo ") center center no-repeat;background-size:cover\">
      <h3 class=\"h2 blue\">";
            // line 70
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_text3", [])), "html", null, true);
            echo "</h3>
      <h2 class=\"h3\">";
            // line 71
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_text2", [])), "html", null, true);
            echo "</h2>
      ";
            // line 72
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "field_link2", [])), "html", null, true);
            echo "
    </div>
  </div>
";
        }
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/content/node--home-page--full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  189 => 72,  185 => 71,  181 => 70,  177 => 69,  174 => 68,  172 => 67,  166 => 64,  155 => 56,  149 => 53,  140 => 46,  134 => 43,  131 => 42,  129 => 41,  123 => 37,  117 => 34,  114 => 33,  112 => 32,  105 => 28,  99 => 25,  94 => 23,  89 => 21,  82 => 17,  77 => 16,  71 => 14,  69 => 13,  65 => 12,  57 => 8,  55 => 7,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/content/node--home-page--full.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/content/node--home-page--full.html.twig");
    }
}
