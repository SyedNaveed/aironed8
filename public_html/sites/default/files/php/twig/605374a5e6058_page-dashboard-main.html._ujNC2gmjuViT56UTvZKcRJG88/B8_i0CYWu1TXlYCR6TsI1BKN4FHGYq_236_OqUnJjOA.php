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

/* modules/custom/airchoice_member/templates/page-dashboard-main.html.twig */
class __TwigTemplate_9f854ddc4ceaa767006dd383f0c5033478bd265c47044288fe5b2b4835cd61c3 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = ["escape" => 6];
        $functions = ["path" => 9];

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
                ['path']
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
        echo "<section class=\"col-8 margin-auto\">
<h1>Dashboard</h1>

<div class=\"row\">
    <div class=\"col-5\">
        ";
        // line 6
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "findFlightForm", [])), "html", null, true);
        echo "
    </div>
    <div class=\"col-7\">
        <a class=\"btn btn-primary\" href=\"";
        // line 9
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("<front>"));
        echo "\">
            Book a flight
        </a>
        <a class=\"btn btn-primary\" href=\"";
        // line 12
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->getPath("<front>"));
        echo "\">
            Book a Car
        </a>

        <div>
            <h1>Upcoming Flights</h1>
        </div>
    </div>
</div>


</section>";
    }

    public function getTemplateName()
    {
        return "modules/custom/airchoice_member/templates/page-dashboard-main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 12,  68 => 9,  62 => 6,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<section class=\"col-8 margin-auto\">
<h1>Dashboard</h1>

<div class=\"row\">
    <div class=\"col-5\">
        {{ data.findFlightForm }}
    </div>
    <div class=\"col-7\">
        <a class=\"btn btn-primary\" href=\"{{ path(\"<front>\") }}\">
            Book a flight
        </a>
        <a class=\"btn btn-primary\" href=\"{{ path(\"<front>\") }}\">
            Book a Car
        </a>

        <div>
            <h1>Upcoming Flights</h1>
        </div>
    </div>
</div>


</section>", "modules/custom/airchoice_member/templates/page-dashboard-main.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\modules\\custom\\airchoice_member\\templates\\page-dashboard-main.html.twig");
    }
}
