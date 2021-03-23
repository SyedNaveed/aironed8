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

/* themes/custom/airchoiceone_new/templates/content/node--contact_us.html.twig */
class __TwigTemplate_02ba84863ed882534666d79fe845c7e9677c06ef0fec835a674f89e2143e702c extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 7];
        $functions = ["drupal_entity" => 20, "drupal_view" => 32];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                ['drupal_entity', 'drupal_view']
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
        echo "<article";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "container_push_right show_flow in contact-ussection"], "method")), "html", null, true);
        echo ">
<div class=\"container main-form-section\">
    <div class=\"row\">
      <div class=\"col-lg-4 col-md-4 col-sm-4 space contact-form-section-left\">
      ";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["content"] ?? null), "body", [])), "html", null, true);
        echo "
    </div>
      <div class=\"col-lg-7 col-md-7 col-sm-7 contact-form-section-right\">
      
        ";
        // line 16
        echo "        ";
        // line 17
        echo "        ";
        // line 18
        echo "        ";
        // line 19
        echo "        <div class=\"contact-form-section-right-inner\">
          ";
        // line 20
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("webform", "contact_us"), "html", null, true);
        echo "
        </div>
        
      
      </div>
    </div>
</div>
  
    
  
    <div class=\"container faq-section\">
    <div class=\"faq-section-inner\">
      ";
        // line 32
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, views_embed_view("faq", "block_1"), "html", null, true);
        echo "
    </div>
     
    </div>
  
</article>
<div class=\"pd nt nopro\"></div>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone_new/templates/content/node--contact_us.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 32,  79 => 20,  76 => 19,  74 => 18,  72 => 17,  70 => 16,  63 => 11,  55 => 7,);
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
 * Default theme implementation to display a About Us page node.
 */
#}
<article{{ attributes.addClass('container_push_right show_flow in contact-ussection') }}>
<div class=\"container main-form-section\">
    <div class=\"row\">
      <div class=\"col-lg-4 col-md-4 col-sm-4 space contact-form-section-left\">
      {{ content.body }}
    </div>
      <div class=\"col-lg-7 col-md-7 col-sm-7 contact-form-section-right\">
      
        {# {{ drupal_entity('contact_us_webforn_block', 'contact_us') }} #}
        {# {{drupal_form(webform_submission_contact_us_node_63_add_form. args) }} #}
        {# {{drupal_form( webform_submission_contact_us_node_63_add_form ) }} #}
        {# {{ drupal_entity_form('node', 63) }} #}
        <div class=\"contact-form-section-right-inner\">
          {{ drupal_entity('webform', 'contact_us') }}
        </div>
        
      
      </div>
    </div>
</div>
  
    
  
    <div class=\"container faq-section\">
    <div class=\"faq-section-inner\">
      {{ drupal_view('faq', 'block_1') }}
    </div>
     
    </div>
  
</article>
<div class=\"pd nt nopro\"></div>
", "themes/custom/airchoiceone_new/templates/content/node--contact_us.html.twig", "/var/www/aironem/public_html/themes/custom/airchoiceone_new/templates/content/node--contact_us.html.twig");
    }
}
