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

/* modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig */
class __TwigTemplate_bc1c59174be34408a0378c6a67c45e90bbfe219f56cc6ba58266b088e9c3b7f4 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 1, "join" => 50, "keys" => 50, "without" => 57];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape', 'join', 'keys', 'without'],
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
        echo "<form  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null)), "html", null, true);
        echo ">

  <div class=\"row\">
    <div class=\"col-md-6\">
      ";
        // line 5
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "departure", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-md-6\">
      ";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "arrival", [])), "html", null, true);
        echo "
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-md-6\">
      ";
        // line 13
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "from", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-md-6\">
      ";
        // line 16
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "to", [])), "html", null, true);
        echo "
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-md-6\">
      <div class=\"row\">
        <div class=\"col-md-6\">
          ";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "adultCount", [])), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-6\">
          ";
        // line 26
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "childCount", [])), "html", null, true);
        echo "
        </div>
      </div>
     
    </div>
    <div class=\"col-md-6\">
      <div class=\"row\">
        <div class=\"col-md-6\">
          ";
        // line 34
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "infantCount", [])), "html", null, true);
        echo "
        </div>
        <div class=\"col-md-6\">
          ";
        // line 37
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "isRoundtrip", [])), "html", null, true);
        echo "
        </div>
      </div>
     
    </div>
    <div class=\"col-md-12 \">
      ";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["form"] ?? null), "promoCode", [])), "html", null, true);
        echo "
    </div>
  </div>
  
  
  <!-- <div> -->
    <!-- <h3>Form variables</h3> -->
    <!-- ";
        // line 50
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_get_array_keys_filter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null))), ", "), "html", null, true);
        echo " -->
    <!-- <h3>Other variables</h3> -->
    <!-- ";
        // line 52
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_join_filter(twig_get_array_keys_filter($this->sandbox->ensureToStringAllowed($context)), ", "), "html", null, true);
        echo " -->
  <!-- </div> -->
<div class=\"row\">
  <div class=\"col-md-12\">
    ";
        // line 57
        echo "  ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->withoutFilter($this->sandbox->ensureToStringAllowed(($context["form"] ?? null)), "departure", "arrival", "from", "to", "adultCount", "childCount", "infantCount", "isRoundtrip", "promoCode"), "html", null, true);
        echo "
  </div>
  <div class=\"col-md-12\">
    <p class='description'>
      To book an unaccompanied minor or pet, please call 866-435-9847
    </p>
  </div>
</div>
  

</form>";
    }

    public function getTemplateName()
    {
        return "modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  147 => 57,  140 => 52,  135 => 50,  125 => 43,  116 => 37,  110 => 34,  99 => 26,  93 => 23,  83 => 16,  77 => 13,  69 => 8,  63 => 5,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<form  {{ attributes }}>

  <div class=\"row\">
    <div class=\"col-md-6\">
      {{ form.departure }}
    </div>
    <div class=\"col-md-6\">
      {{ form.arrival }}
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-md-6\">
      {{ form.from }}
    </div>
    <div class=\"col-md-6\">
      {{ form.to }}
    </div>
  </div>
  <div class=\"row\">
    <div class=\"col-md-6\">
      <div class=\"row\">
        <div class=\"col-md-6\">
          {{ form.adultCount }}
        </div>
        <div class=\"col-md-6\">
          {{ form.childCount }}
        </div>
      </div>
     
    </div>
    <div class=\"col-md-6\">
      <div class=\"row\">
        <div class=\"col-md-6\">
          {{ form.infantCount }}
        </div>
        <div class=\"col-md-6\">
          {{ form.isRoundtrip }}
        </div>
      </div>
     
    </div>
    <div class=\"col-md-12 \">
      {{ form.promoCode }}
    </div>
  </div>
  
  
  <!-- <div> -->
    <!-- <h3>Form variables</h3> -->
    <!-- {{ form|keys|join(', ') }} -->
    <!-- <h3>Other variables</h3> -->
    <!-- {{ _context|keys|join(', ') }} -->
  <!-- </div> -->
<div class=\"row\">
  <div class=\"col-md-12\">
    {# render other fields  #}
  {{ form|without('departure','arrival','from','to','adultCount','childCount','infantCount','isRoundtrip','promoCode') }}
  </div>
  <div class=\"col-md-12\">
    <p class='description'>
      To book an unaccompanied minor or pet, please call 866-435-9847
    </p>
  </div>
</div>
  

</form>", "modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig", "/var/www/aironem/public_html/modules/custom/airchoice_member/templates/find-a-flight-dashboard-form.html.twig");
    }
}
