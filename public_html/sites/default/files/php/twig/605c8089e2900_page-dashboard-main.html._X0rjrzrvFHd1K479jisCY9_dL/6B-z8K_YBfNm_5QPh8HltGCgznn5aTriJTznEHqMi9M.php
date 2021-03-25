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
class __TwigTemplate_79a7bd965dd857082efab13ff802eec0949c14cbe2d9d2100f67c16c00342faa extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["for" => 180];
        $filters = ["escape" => 140];
        $functions = ["dump" => 184];

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape'],
                ['dump']
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
        echo "<!-- dashboard left side start  -->
<div class=\"dash_side\">
\t<h2>Welcome, Jason</h2>
\t<span class=\"openclose\"><i class=\"fas fa-chevron-right\"></i>
\t<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></span>
\t<div class=\"ticket ticket_purp purp\">
\t\t<h4>Next Flight</h4>
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"ticket_divider\"></div>

\t\t<div class=\"row rnp\">
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t<line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t</svg>

\t\t</div>

\t\t<div class=\"ticket_flight_time\">
\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t</div>

\t</div>


\t<div class=\"row row_squares\">
\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/check-in/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 38.417 36.557\">
\t\t\t\t\t\t<path id=\"plane\" d=\"M25.077,23.713,15.62,38.8c0,.106-.106.106-.213.106H11.688a.282.282,0,0,1-.319-.319l4.676-14.877H6.055L3.292,27.432c0,.106-.106.106-.213.106H.316A.282.282,0,0,1,0,27.219L1.909,20.63,0,14.041a.34.34,0,0,1,.319-.319H3.079c.106,0,.213,0,.213.106l2.763,3.719h9.989L11.369,2.671a.34.34,0,0,1,.319-.319h3.719c.106,0,.213,0,.213.106l9.457,15.09H35.385c4.038,0,4.038,6.163,0,6.163H25.077Z\" transform=\"translate(0.003 -2.352)\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t</svg>
\t\t\t\t\t<h4>Check In</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>


\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/flight-status/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 42 38.683\">
\t\t\t\t\t\t<path id=\"status\" d=\"M8.432,29.925a1.535,1.535,0,0,1,1.41-1.534l5.458-.46,2.854-6.851v0A2.021,2.021,0,0,1,22,21.442L24.24,32.073l4.516-20.552a2.018,2.018,0,0,1,1.931-1.586,1.994,1.994,0,0,1,2,1.509L37.073,28l4.667.452v0a1.556,1.556,0,0,1-.034,3.1l-6.176.477a2.025,2.025,0,0,1-1.969-1.5l-2.646-9.987L26.188,42.1v0a2.028,2.028,0,0,1-3.959-.017L19.383,28.635l-.86,2.08a2.014,2.014,0,0,1-1.865,1.242l-6.791-.494v0a1.546,1.546,0,0,1-1.435-1.538Zm.989-6.64h3.761a2,2,0,1,0,0-3.992H9.421a2,2,0,0,0,0,3.992ZM22.508,12.144H9.421a2,2,0,0,0,0,3.994H22.508a2,2,0,1,0,0-3.994Zm0-7.147H9.421a2,2,0,0,0,0,3.992H22.508a2,2,0,1,0,0-3.992ZM3.137,5a2,2,0,1,0,1.414.586A2,2,0,0,0,3.137,5Zm0,7.152a.831.831,0,1,0,0-.005Zm0,7.152a2,2,0,1,0,2,2A2,2,0,0,0,3.137,19.3Z\" transform=\"translate(-1.139 -4.995)\"></path>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>Flight Status</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/booked-flights/\">
\t\t\t\t<div class=\"side_menu_square my_flights_svg\">
\t\t\t\t\t<svg viewBox=\"0 0 37.144 20.429\">
\t\t\t\t\t\t<path id=\"np_movie-ticket_1780027_000000\" d=\"M10,28v5.107a5.107,5.107,0,0,1,0,10.215v5.107H34.608V28Zm26.465,0V48.429H47.144V43.322a5.107,5.107,0,0,1,0-10.215V28Z\" transform=\"translate(-10 -28)\"></path>
\t\t\t\t\t</svg>
\t\t\t\t\t<h4>Find Flights</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>



\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/manage-members/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 31.657 32.45\">
\t\t\t\t\t\t<g id=\"check-in\" transform=\"translate(-8.331 -7.289)\">
\t\t\t\t\t\t\t<path id=\"Path_37\" data-name=\"Path 37\" d=\"M44.495,16A8.706,8.706,0,1,0,35.788,24.7,8.732,8.732,0,0,0,44.495,16Z\" transform=\"translate(-11.627)\"></path>
\t\t\t\t\t\t\t<path id=\"Path_38\" data-name=\"Path 38\" d=\"M27.6,57.14a10.984,10.984,0,0,1-6.886,0,8.852,8.852,0,0,0-9.656,2.612,12.194,12.194,0,0,0-2.73,7.677,2.922,2.922,0,0,0,2.928,2.928h25.8a2.922,2.922,0,0,0,2.928-2.928,12.185,12.185,0,0,0-2.73-7.677A8.862,8.862,0,0,0,27.6,57.14Z\" transform=\"translate(0 -30.618)\"></path>
\t\t\t\t\t\t</g>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>My Members</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/manage-members/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 31.657 32.45\">
\t\t\t\t\t\t<g id=\"check-in\" transform=\"translate(-8.331 -7.289)\">
\t\t\t\t\t\t\t<path id=\"Path_37\" data-name=\"Path 37\" d=\"M44.495,16A8.706,8.706,0,1,0,35.788,24.7,8.732,8.732,0,0,0,44.495,16Z\" transform=\"translate(-11.627)\"></path>
\t\t\t\t\t\t\t<path id=\"Path_38\" data-name=\"Path 38\" d=\"M27.6,57.14a10.984,10.984,0,0,1-6.886,0,8.852,8.852,0,0,0-9.656,2.612,12.194,12.194,0,0,0-2.73,7.677,2.922,2.922,0,0,0,2.928,2.928h25.8a2.922,2.922,0,0,0,2.928-2.928,12.185,12.185,0,0,0-2.73-7.677A8.862,8.862,0,0,0,27.6,57.14Z\" transform=\"translate(0 -30.618)\"></path>
\t\t\t\t\t\t</g>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>My Members</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t</div>
\t<a href=\"/dashboard/\"><button class=\"green btn\">Book a Flight</button></a>
</div>

<!-- dashboard left side end  -->

<div class=\"dashboard-body-setion\">
\t<section class=\"container\">
\t\t<h1>Dashboard</h1>

\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-5\">
\t\t\t\t";
        // line 140
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["data"] ?? null), "findFlightForm", [])), "html", null, true);
        echo "
\t\t\t</div>
\t\t\t<div class=\"col-md-7\">
\t\t\t\t<div class=\"booking-section\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<a class=\" \" href=\"#\">
\t\t\t\t\t\t\t\t<div class=\"book_car_hotel id_hotel\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 44 57.829\">
\t\t\t\t\t\t\t\t\t\t<path id=\"hotel\" d=\"M37,4,35.586,6.946l-3.3.413L34.7,9.6l-.609,3.2L37,11.248,39.907,12.8,39.3,9.6l2.416-2.239-3.3-.413ZM19.086,5.886l-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2L20.7,9.854l1.846-1.571-2.455-.236Zm8.486,0-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571-2.455-.236Zm18.857,0-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571L47.43,8.046Zm8.486,0-1,2.161-2.455.236L53.3,9.854l-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571-2.455-.236ZM15,14.057V61.829H30.086V48H43.914V61.829H59V14.057Zm3.771,3.771h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,27.886h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,37.943h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,48h6.286v6.286H18.771Zm30.171,0h6.286v6.286H48.943Z\" transform=\"translate(-15 -4)\" fill=\"#fff\"></path>
\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t<h3>Book a Hotel</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<a class=\" \" href=\"#\">
\t\t\t\t\t\t\t\t<div class=\"book_car_hotel id_car\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 46.997 38.512\">
\t\t\t\t\t\t\t\t\t\t<g id=\"car\" transform=\"translate(0 -8.99)\">
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_52\" data-name=\"Path 52\" d=\"M2.981,41.824V31.174a12.344,12.344,0,0,1,.567-2.981H.993A.97.97,0,0,1,0,27.2c0-3.407,2.13-4.259,5.111-4.259,1.845-5.254,4.4-11.217,5.822-11.928,5.254-2.7,19.879-2.7,25.131,0,1.419.71,3.976,6.673,5.822,11.928,2.981,0,5.111.852,5.111,4.259a.949.949,0,0,1-.852.993h-2.7a15.893,15.893,0,0,1,.71,2.981v10.65ZM40.608,30.039c-.567,0-7.81.71-8.662,3.551-.285.993.426,1.845,1.845,1.845h6.532a1.577,1.577,0,0,0,1.562-1.562V31.317a1.272,1.272,0,0,0-1.278-1.278Zm-34.219,0c.567,0,7.81.71,8.662,3.551.285.993-.426,1.845-1.7,1.845H6.674a1.577,1.577,0,0,1-1.562-1.562V31.317a1.272,1.272,0,0,1,1.278-1.278ZM8.8,23.792c8.662,3.125,20.872,3.125,29.392,0-.71-3.833-2.556-10.933-7.241-11.076H16.045c-4.685.141-6.532,7.241-7.241,11.076Z\" fill=\"#fff\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_53\" data-name=\"Path 53\" d=\"M6.344,73.715h9.513v5.111a3,3,0,0,1-2.981,2.981H9.184a2.973,2.973,0,0,1-2.84-2.981Z\" transform=\"translate(-3.362 -34.305)\" fill=\"#fff\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_54\" data-name=\"Path 54\" d=\"M83.069,73.715H73.414v5.111A3.1,3.1,0,0,0,76.4,81.808h3.692a3.1,3.1,0,0,0,2.981-2.981Z\" transform=\"translate(-38.911 -34.305)\" fill=\"#fff\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t\t</g>
\t\t\t\t\t\t\t\t\t</svg>

\t\t\t\t\t\t\t\t\t<h3>Book a Car</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>


\t\t\t\t</div>

\t\t\t\t<div class=\"upcoming-flights-shedule-section\">
\t\t\t\t\t<h2>Upcoming Flights</h2>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t";
        // line 180
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["data"] ?? null), "upcomingFlights", []));
        foreach ($context['_seq'] as $context["_key"] => $context["flight"]) {
            // line 181
            echo "\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<!-- <div class=\"alert alert-info\">
\t\t\t\t\t\t\t\tvariables in fligt
\t\t\t\t\t\t\t\t<pre>";
            // line 184
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, twig_var_dump($this->env, $context, [0 => $this->sandbox->ensureToStringAllowed($context["flight"])]), "html", null, true);
            echo "</pre>
\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t<div class=\"ticket ticket_white wbg\">
\t\t\t\t\t\t\t\t<h4>";
            // line 187
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["flight"], "name", [])), "html", null, true);
            echo "</h4>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_divider\"></div>
\t\t\t\t\t\t\t\t<div class=\"row rnp\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t\t\t\t\t\t\t<line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_flight_time\">
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_bottom_svg\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 188 24.631\">
\t\t\t\t\t\t\t\t\t\t<line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
\t\t\t\t\t\t\t\t\t\t<path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t</svg>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['flight'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 246
        echo "\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>


\t</section>
</div>";
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
        return array (  319 => 246,  254 => 187,  248 => 184,  243 => 181,  239 => 180,  196 => 140,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<!-- dashboard left side start  -->
<div class=\"dash_side\">
\t<h2>Welcome, Jason</h2>
\t<span class=\"openclose\"><i class=\"fas fa-chevron-right\"></i>
\t<i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></span>
\t<div class=\"ticket ticket_purp purp\">
\t\t<h4>Next Flight</h4>
\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"ticket_divider\"></div>

\t\t<div class=\"row rnp\">
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-4\">
\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t</div>
\t\t</div>

\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t<line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t</svg>

\t\t</div>

\t\t<div class=\"ticket_flight_time\">
\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t</div>

\t</div>


\t<div class=\"row row_squares\">
\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/check-in/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 38.417 36.557\">
\t\t\t\t\t\t<path id=\"plane\" d=\"M25.077,23.713,15.62,38.8c0,.106-.106.106-.213.106H11.688a.282.282,0,0,1-.319-.319l4.676-14.877H6.055L3.292,27.432c0,.106-.106.106-.213.106H.316A.282.282,0,0,1,0,27.219L1.909,20.63,0,14.041a.34.34,0,0,1,.319-.319H3.079c.106,0,.213,0,.213.106l2.763,3.719h9.989L11.369,2.671a.34.34,0,0,1,.319-.319h3.719c.106,0,.213,0,.213.106l9.457,15.09H35.385c4.038,0,4.038,6.163,0,6.163H25.077Z\" transform=\"translate(0.003 -2.352)\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t</svg>
\t\t\t\t\t<h4>Check In</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>


\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/flight-status/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 42 38.683\">
\t\t\t\t\t\t<path id=\"status\" d=\"M8.432,29.925a1.535,1.535,0,0,1,1.41-1.534l5.458-.46,2.854-6.851v0A2.021,2.021,0,0,1,22,21.442L24.24,32.073l4.516-20.552a2.018,2.018,0,0,1,1.931-1.586,1.994,1.994,0,0,1,2,1.509L37.073,28l4.667.452v0a1.556,1.556,0,0,1-.034,3.1l-6.176.477a2.025,2.025,0,0,1-1.969-1.5l-2.646-9.987L26.188,42.1v0a2.028,2.028,0,0,1-3.959-.017L19.383,28.635l-.86,2.08a2.014,2.014,0,0,1-1.865,1.242l-6.791-.494v0a1.546,1.546,0,0,1-1.435-1.538Zm.989-6.64h3.761a2,2,0,1,0,0-3.992H9.421a2,2,0,0,0,0,3.992ZM22.508,12.144H9.421a2,2,0,0,0,0,3.994H22.508a2,2,0,1,0,0-3.994Zm0-7.147H9.421a2,2,0,0,0,0,3.992H22.508a2,2,0,1,0,0-3.992ZM3.137,5a2,2,0,1,0,1.414.586A2,2,0,0,0,3.137,5Zm0,7.152a.831.831,0,1,0,0-.005Zm0,7.152a2,2,0,1,0,2,2A2,2,0,0,0,3.137,19.3Z\" transform=\"translate(-1.139 -4.995)\"></path>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>Flight Status</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/booked-flights/\">
\t\t\t\t<div class=\"side_menu_square my_flights_svg\">
\t\t\t\t\t<svg viewBox=\"0 0 37.144 20.429\">
\t\t\t\t\t\t<path id=\"np_movie-ticket_1780027_000000\" d=\"M10,28v5.107a5.107,5.107,0,0,1,0,10.215v5.107H34.608V28Zm26.465,0V48.429H47.144V43.322a5.107,5.107,0,0,1,0-10.215V28Z\" transform=\"translate(-10 -28)\"></path>
\t\t\t\t\t</svg>
\t\t\t\t\t<h4>Find Flights</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>



\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/manage-members/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 31.657 32.45\">
\t\t\t\t\t\t<g id=\"check-in\" transform=\"translate(-8.331 -7.289)\">
\t\t\t\t\t\t\t<path id=\"Path_37\" data-name=\"Path 37\" d=\"M44.495,16A8.706,8.706,0,1,0,35.788,24.7,8.732,8.732,0,0,0,44.495,16Z\" transform=\"translate(-11.627)\"></path>
\t\t\t\t\t\t\t<path id=\"Path_38\" data-name=\"Path 38\" d=\"M27.6,57.14a10.984,10.984,0,0,1-6.886,0,8.852,8.852,0,0,0-9.656,2.612,12.194,12.194,0,0,0-2.73,7.677,2.922,2.922,0,0,0,2.928,2.928h25.8a2.922,2.922,0,0,0,2.928-2.928,12.185,12.185,0,0,0-2.73-7.677A8.862,8.862,0,0,0,27.6,57.14Z\" transform=\"translate(0 -30.618)\"></path>
\t\t\t\t\t\t</g>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>My Members</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t\t<div class=\"col-md-6\">
\t\t\t<a href=\"/manage-members/\">
\t\t\t\t<div class=\"side_menu_square\">
\t\t\t\t\t<svg viewBox=\"0 0 31.657 32.45\">
\t\t\t\t\t\t<g id=\"check-in\" transform=\"translate(-8.331 -7.289)\">
\t\t\t\t\t\t\t<path id=\"Path_37\" data-name=\"Path 37\" d=\"M44.495,16A8.706,8.706,0,1,0,35.788,24.7,8.732,8.732,0,0,0,44.495,16Z\" transform=\"translate(-11.627)\"></path>
\t\t\t\t\t\t\t<path id=\"Path_38\" data-name=\"Path 38\" d=\"M27.6,57.14a10.984,10.984,0,0,1-6.886,0,8.852,8.852,0,0,0-9.656,2.612,12.194,12.194,0,0,0-2.73,7.677,2.922,2.922,0,0,0,2.928,2.928h25.8a2.922,2.922,0,0,0,2.928-2.928,12.185,12.185,0,0,0-2.73-7.677A8.862,8.862,0,0,0,27.6,57.14Z\" transform=\"translate(0 -30.618)\"></path>
\t\t\t\t\t\t</g>
\t\t\t\t\t</svg>

\t\t\t\t\t<h4>My Members</h4>
\t\t\t\t</div>
\t\t\t</a>
\t\t</div>

\t</div>
\t<a href=\"/dashboard/\"><button class=\"green btn\">Book a Flight</button></a>
</div>

<!-- dashboard left side end  -->

<div class=\"dashboard-body-setion\">
\t<section class=\"container\">
\t\t<h1>Dashboard</h1>

\t\t<div class=\"row\">
\t\t\t<div class=\"col-md-5\">
\t\t\t\t{{ data.findFlightForm }}
\t\t\t</div>
\t\t\t<div class=\"col-md-7\">
\t\t\t\t<div class=\"booking-section\">
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<a class=\" \" href=\"#\">
\t\t\t\t\t\t\t\t<div class=\"book_car_hotel id_hotel\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 44 57.829\">
\t\t\t\t\t\t\t\t\t\t<path id=\"hotel\" d=\"M37,4,35.586,6.946l-3.3.413L34.7,9.6l-.609,3.2L37,11.248,39.907,12.8,39.3,9.6l2.416-2.239-3.3-.413ZM19.086,5.886l-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2L20.7,9.854l1.846-1.571-2.455-.236Zm8.486,0-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571-2.455-.236Zm18.857,0-1,2.161-2.455.236,1.846,1.571-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571L47.43,8.046Zm8.486,0-1,2.161-2.455.236L53.3,9.854l-.53,2.318,2.141-1.2,2.141,1.2-.53-2.318,1.846-1.571-2.455-.236ZM15,14.057V61.829H30.086V48H43.914V61.829H59V14.057Zm3.771,3.771h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,27.886h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,37.943h6.286v6.286H18.771Zm10.057,0h6.286v6.286H28.829Zm10.057,0h6.286v6.286H38.886Zm10.057,0h6.286v6.286H48.943ZM18.771,48h6.286v6.286H18.771Zm30.171,0h6.286v6.286H48.943Z\" transform=\"translate(-15 -4)\" fill=\"#fff\"></path>
\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t\t<h3>Book a Hotel</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<a class=\" \" href=\"#\">
\t\t\t\t\t\t\t\t<div class=\"book_car_hotel id_car\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 46.997 38.512\">
\t\t\t\t\t\t\t\t\t\t<g id=\"car\" transform=\"translate(0 -8.99)\">
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_52\" data-name=\"Path 52\" d=\"M2.981,41.824V31.174a12.344,12.344,0,0,1,.567-2.981H.993A.97.97,0,0,1,0,27.2c0-3.407,2.13-4.259,5.111-4.259,1.845-5.254,4.4-11.217,5.822-11.928,5.254-2.7,19.879-2.7,25.131,0,1.419.71,3.976,6.673,5.822,11.928,2.981,0,5.111.852,5.111,4.259a.949.949,0,0,1-.852.993h-2.7a15.893,15.893,0,0,1,.71,2.981v10.65ZM40.608,30.039c-.567,0-7.81.71-8.662,3.551-.285.993.426,1.845,1.845,1.845h6.532a1.577,1.577,0,0,0,1.562-1.562V31.317a1.272,1.272,0,0,0-1.278-1.278Zm-34.219,0c.567,0,7.81.71,8.662,3.551.285.993-.426,1.845-1.7,1.845H6.674a1.577,1.577,0,0,1-1.562-1.562V31.317a1.272,1.272,0,0,1,1.278-1.278ZM8.8,23.792c8.662,3.125,20.872,3.125,29.392,0-.71-3.833-2.556-10.933-7.241-11.076H16.045c-4.685.141-6.532,7.241-7.241,11.076Z\" fill=\"#fff\" fill-rule=\"evenodd\"></path>
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_53\" data-name=\"Path 53\" d=\"M6.344,73.715h9.513v5.111a3,3,0,0,1-2.981,2.981H9.184a2.973,2.973,0,0,1-2.84-2.981Z\" transform=\"translate(-3.362 -34.305)\" fill=\"#fff\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t\t\t<path id=\"Path_54\" data-name=\"Path 54\" d=\"M83.069,73.715H73.414v5.111A3.1,3.1,0,0,0,76.4,81.808h3.692a3.1,3.1,0,0,0,2.981-2.981Z\" transform=\"translate(-38.911 -34.305)\" fill=\"#fff\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t\t</g>
\t\t\t\t\t\t\t\t\t</svg>

\t\t\t\t\t\t\t\t\t<h3>Book a Car</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>


\t\t\t\t</div>

\t\t\t\t<div class=\"upcoming-flights-shedule-section\">
\t\t\t\t\t<h2>Upcoming Flights</h2>
\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t{% for flight in data.upcomingFlights%}
\t\t\t\t\t\t<div class=\"col-md-6\">
\t\t\t\t\t\t\t<!-- <div class=\"alert alert-info\">
\t\t\t\t\t\t\t\tvariables in fligt
\t\t\t\t\t\t\t\t<pre>{{ dump(flight) }}</pre>
\t\t\t\t\t\t\t</div> -->
\t\t\t\t\t\t\t<div class=\"ticket ticket_white wbg\">
\t\t\t\t\t\t\t\t<h4>{{ flight.name }}</h4>
\t\t\t\t\t\t\t\t<div class=\"row\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">STL</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Depart</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_divider\"></div>
\t\t\t\t\t\t\t\t<div class=\"row rnp\">
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_big\">JKS</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">Jackson, TN</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_depart_arrive\">Arrive</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"col-md-4\">
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_time_big\">3:30</div>
\t\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_am_pm\">pm</div>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t<div class=\"ticket_city_small\">St. Louis, MO</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_dash\"><svg height=\"1\" viewBox=\"0 0 385.908 1\">
\t\t\t\t\t\t\t\t\t\t<line id=\"Line_104\" data-name=\"Line 104\" x2=\"384.908\" transform=\"translate(0.5 0.5)\" fill=\"none\" stroke=\"#ccc\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 3\"></line>
\t\t\t\t\t\t\t\t\t</svg>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_flight_time\">
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">3</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">hrs</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_big\">29</div>
\t\t\t\t\t\t\t\t\t<div class=\"ticket_ft_sm\">min</div>
\t\t\t\t\t\t\t\t</div>

\t\t\t\t\t\t\t\t<div class=\"ticket_bottom_svg\">
\t\t\t\t\t\t\t\t\t<svg viewBox=\"0 0 188 24.631\">
\t\t\t\t\t\t\t\t\t\t<line id=\"Line_53\" data-name=\"Line 53\" x2=\"187\" transform=\"translate(0.5 11.885)\" fill=\"none\" stroke=\"#9952f5\" stroke-linecap=\"round\" stroke-width=\"1\" stroke-dasharray=\"0 2\"></line>
\t\t\t\t\t\t\t\t\t\t<path id=\"np_plane_2045803_000000\" d=\"M16.9,16.744,10.523,26.911c0,.072-.072.072-.143.072H7.874a.19.19,0,0,1-.215-.215l3.15-10.024H4.079L2.217,19.25c0,.072-.072.072-.143.072H.212A.19.19,0,0,1,0,19.107l1.288-4.439L0,10.228a.229.229,0,0,1,.215-.215H2.074c.072,0,.143,0,.143.072L4.079,12.59h6.73L7.659,2.567a.229.229,0,0,1,.215-.215H10.38c.072,0,.143,0,.143.072L16.9,12.59h6.945a2.077,2.077,0,0,1,0,4.153H16.9Z\" transform=\"translate(81.061 -2.352)\" fill=\"#7316ea\" fill-rule=\"evenodd\">
\t\t\t\t\t\t\t\t\t\t</path>
\t\t\t\t\t\t\t\t\t</svg>

\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t\t{% endfor %}
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>


\t</section>
</div>", "modules/custom/airchoice_member/templates/page-dashboard-main.html.twig", "/var/www/aironem/public_html/modules/custom/airchoice_member/templates/page-dashboard-main.html.twig");
    }
}
