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
        $tags = ["for" => 20];
        $filters = ["escape" => 6];
        $functions = ["path" => 9, "dump" => 25];

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                ['path', 'dump']
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
        echo "<section class=\"container\">
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
            <div class=\"row\">
            
            ";
        // line 20
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "upcomingFlights", []));
        foreach ($context['_seq'] as $context["_key"] => $context["flight"]) {
            // line 21
            echo "                
            
\t\t\t\t\t\t<div class=\"cm6\">
                            <div class=\"alert alert-info\">
                            variables in fligt ";
            // line 25
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_var_dump($this->env, $context, [0 => $this->sandbox->ensureToStringAllowed($context["flight"])]), "html", null, true);
            echo "</div>
\t\t\t\t\t\t\t<div class=\"ticket ticket_white wbg\">
\t\t\t\t\t\t\t\t<h4>";
            // line 27
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "name", [])), "html", null, true);
            echo "</h4>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_divider\"></div>
\t\t\t\t\t\t\t\t<div class=\"row rnp\">
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t\t\t\t\t\t  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t\t\t\t\t\t\t</svg>\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_flight_time\">
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_bottom_svg\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 188 24.631\">
\t\t\t\t\t\t\t\t\t\t  <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
\t\t\t\t\t\t\t\t\t\t  <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flight'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "\t\t\t\t\t</div>
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
        return array (  158 => 79,  100 => 27,  95 => 25,  89 => 21,  85 => 20,  74 => 12,  68 => 9,  62 => 6,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<section class=\"container\">
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
            <div class=\"row\">
            
            {% for flight in  data.upcomingFlights%}
                
            
\t\t\t\t\t\t<div class=\"cm6\">
                            <div class=\"alert alert-info\">
                            variables in fligt {{ dump(flight) }}</div>
\t\t\t\t\t\t\t<div class=\"ticket ticket_white wbg\">
\t\t\t\t\t\t\t\t<h4>{{ flight.name }}</h4>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_divider\"></div>
\t\t\t\t\t\t\t\t<div class=\"row rnp\">
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"cxs4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\"><div class=\"ticket_time_big\">3:30</div><div class=\"ticket_am_pm\">pm</div></div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t\t\t\t\t\t  <line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t\t\t\t\t\t\t</svg>\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_flight_time\">
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<div class=\"ticket_bottom_svg\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 188 24.631\">
\t\t\t\t\t\t\t\t\t\t  <line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
\t\t\t\t\t\t\t\t\t\t  <path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
{% endfor %}
\t\t\t\t\t</div>
        </div>
    </div>
</div>


</section>", "modules/custom/airchoice_member/templates/page-dashboard-main.html.twig", "E:\\xampp_73\\htdocs\\asdev\\current\\public_html\\modules\\custom\\airchoice_member\\templates\\page-dashboard-main.html.twig");
    }
}
