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

/* @bootstrap_for_drupal/includes/footer.html.twig */
class __TwigTemplate_2c3b13ab9fc028ba2c7dd1cc38c5bb203cc3bdc1c0f6c84c51a19901dd4b21ad extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 6];
        $filters = ["escape" => 7];
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
        echo "<!-- FOOTER -->
<footer class=\"py-3 py-lg-5 bg-secondary text-white-50 mt-2 mt-md-5 d-print-none\" id=\"page-footer\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12 col-lg-3 order-3 order-md-3 order-lg-1 mb-3 mb-3\">
        ";
        // line 6
        if ($this->getAttribute(($context["page"] ?? null), "footer_left", [])) {
            // line 7
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_left", [])), "html", null, true);
            echo "
        ";
        }
        // line 9
        echo "      </div>
      <div class=\"col-sm-12 col-md-6 col-lg-5 order-2 order-lg-2 mb-3\">
        ";
        // line 11
        if ($this->getAttribute(($context["page"] ?? null), "footer_center", [])) {
            // line 12
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_center", [])), "html", null, true);
            echo "
        ";
        }
        // line 14
        echo "      </div>
      <div class=\"col-sm-12 col-md-6 col-lg-4 order-1 order-lg-3\">
        ";
        // line 16
        if ($this->getAttribute(($context["page"] ?? null), "footer_right", [])) {
            // line 17
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_right", [])), "html", null, true);
            echo "
        ";
        }
        // line 19
        echo "      </div>
    </div>
  </div>
</footer>
<footer class=\"py-3 justify-content-center d-flex bg-primary text-white-50 d-print-none\" id=\"page-footer-sub\">
  <div class=\"container\">
    <div class=\"row justify-content-center\">
      <div class=\"col-sm-12 col-xl-4 d-flex justify-content-center align-items-center\">
        ";
        // line 27
        if ($this->getAttribute(($context["page"] ?? null), "footer_sub_left", [])) {
            // line 28
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_sub_left", [])), "html", null, true);
            echo "
        ";
        }
        // line 30
        echo "      </div>
      <div class=\"col-sm-12 col-md-6 col-xl-4 d-flex justify-content-center align-items-center\">

        ";
        // line 33
        if ($this->getAttribute(($context["page"] ?? null), "footer_sub_center", [])) {
            // line 34
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_sub_center", [])), "html", null, true);
            echo "
        ";
        }
        // line 36
        echo "      </div>
      <div class=\"col-sm-12 col-md-6 col-xl-4 d-flex justify-content-center align-items-center\">
        ";
        // line 38
        if ($this->getAttribute(($context["page"] ?? null), "footer_sub_right", [])) {
            // line 39
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer_sub_right", [])), "html", null, true);
            echo "
        ";
        }
        // line 41
        echo "      </a>
    </div>
  </div>
</div>
</footer>
<!-- FOOTER -->


<!-- MODAL CONTAINER -->
";
        // line 50
        if ($this->getAttribute(($context["page"] ?? null), "modal_container", [])) {
            // line 51
            echo "  ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "modal_container", [])), "html", null, true);
            echo "
";
        }
        // line 53
        echo "<!-- MODAL CONTAINER -->
";
    }

    public function getTemplateName()
    {
        return "@bootstrap_for_drupal/includes/footer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  156 => 53,  150 => 51,  148 => 50,  137 => 41,  131 => 39,  129 => 38,  125 => 36,  119 => 34,  117 => 33,  112 => 30,  106 => 28,  104 => 27,  94 => 19,  88 => 17,  86 => 16,  82 => 14,  76 => 12,  74 => 11,  70 => 9,  64 => 7,  62 => 6,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<!-- FOOTER -->
<footer class=\"py-3 py-lg-5 bg-secondary text-white-50 mt-2 mt-md-5 d-print-none\" id=\"page-footer\">
  <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-12 col-lg-3 order-3 order-md-3 order-lg-1 mb-3 mb-3\">
        {% if page.footer_left %}
          {{ page.footer_left }}
        {% endif %}
      </div>
      <div class=\"col-sm-12 col-md-6 col-lg-5 order-2 order-lg-2 mb-3\">
        {% if page.footer_center %}
          {{ page.footer_center }}
        {% endif %}
      </div>
      <div class=\"col-sm-12 col-md-6 col-lg-4 order-1 order-lg-3\">
        {% if page.footer_right %}
          {{ page.footer_right }}
        {% endif %}
      </div>
    </div>
  </div>
</footer>
<footer class=\"py-3 justify-content-center d-flex bg-primary text-white-50 d-print-none\" id=\"page-footer-sub\">
  <div class=\"container\">
    <div class=\"row justify-content-center\">
      <div class=\"col-sm-12 col-xl-4 d-flex justify-content-center align-items-center\">
        {% if page.footer_sub_left %}
          {{ page.footer_sub_left }}
        {% endif %}
      </div>
      <div class=\"col-sm-12 col-md-6 col-xl-4 d-flex justify-content-center align-items-center\">

        {% if page.footer_sub_center %}
          {{ page.footer_sub_center }}
        {% endif %}
      </div>
      <div class=\"col-sm-12 col-md-6 col-xl-4 d-flex justify-content-center align-items-center\">
        {% if page.footer_sub_right %}
          {{ page.footer_sub_right }}
        {% endif %}
      </a>
    </div>
  </div>
</div>
</footer>
<!-- FOOTER -->


<!-- MODAL CONTAINER -->
{% if page.modal_container %}
  {{ page.modal_container }}
{% endif %}
<!-- MODAL CONTAINER -->
", "@bootstrap_for_drupal/includes/footer.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\themes\\contrib\\bfd\\templates\\includes\\footer.html.twig");
    }
}
