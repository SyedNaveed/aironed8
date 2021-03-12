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

/* themes/custom/airchoiceone/images/icons/two-tickets.svg */
class __TwigTemplate_4131bdf53999ce42067cc46e3396581de6318e74d4cace5329c3f3ad2aaacf28 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = [];
        $filters = [];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
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
        echo "<svg width=\"100pt\" height=\"100pt\" version=\"1.1\" viewBox=\"0 0 100 100\" xmlns=\"http://www.w3.org/2000/svg\">
<path d=\"m33.398 68.699h2v3.1992h-2z\"/>
<path d=\"m42.102 72.801h19.801v2h-19.801z\"/>
<path d=\"m42.102 65h19.801v2h-19.801z\"/>
<path d=\"m31.398 33.199l0.39844 0.89844c0.39844 1-0.10156 2.1016-1.1016 2.5-1 0.39844-2.1016-0.10156-2.5-1.1016l-0.39844-0.89844-17.301 6.5 3.5 9.3008v29.898h18.5v-1c0-1.1016 0.89844-1.8984 1.8984-1.8984s1.8984 0.89844 1.8984 1.8984v1l49.707 0.003906v-32.301l3.5-1.3008-11.602-30.898zm-18.297 9.1016l13.699-5.1016c0.80078 1.1016 2.1992 1.8008 3.6016 1.6016l0.19922 0.60156 1.8984-0.69922-0.30078-0.70312c1.1016-0.80078 1.8008-2.1992 1.6016-3.6016l38.699-14.398 10.199 27.102-38.598 14.5c-0.80078-1.1016-2.1992-1.8008-3.6016-1.6016l-0.19922-0.39844-1.8984 0.69922 0.19922 0.39844c-1.1016 0.80078-1.8008 2.1992-1.6016 3.6016l-13.699 5.1016zm66.297 36.098h-41.199c-0.39844-1.3984-1.3984-2.3984-2.8008-2.8008v-0.5h-2v0.5c-1.3984 0.30078-2.3984 1.4023-2.7969 2.8008h-14.602v-22.699l1.8984 5.1016v0.19922h0.10156l0.80078 2.1016h-0.80078v12.801h2v-9.5l1.8984 5.1016v4.5h2v-4.6016l1.8984-0.69922v5.3984h2v-6.1016l11.602-4.3984-0.39844-1.1016c-0.39844-1 0.10156-2.1016 1.1016-2.5s2.1016 0.10156 2.5 1.1016l0.39844 0.89844 2.8008-1.1016h27.699v-2h-22.398l5.1016-1.8984h17.301v-2h-12l5.1016-1.8984h6.8984v-2h-1.6016l7.5-2.8008zm4.6016 0h-2.6016v-28.699l0.80078-0.30078h1.8008zm0.5-32l-10.199-27.098 2.3984-0.89844 10.199 27.102z\"/>
<path d=\"m33.539 41.637l1.125 2.9961-1.8711 0.70313-1.125-2.9961z\"/>
<path d=\"m36.973 50.59l-1.8711 0.70312-1.125-2.9961 1.8711-0.70312z\"/>
<path d=\"m39.141 56.535l-1.8711 0.70312-1.125-2.9961 1.8711-0.70313z\"/>
<path d=\"m68.27 25.633l0.70312 1.8711-29.398 11.035-0.70312-1.8711z\"/>
<path d=\"m71.688 34.871l-29.398 11.035-0.70312-1.8711 29.398-11.035z\"/>
<path d=\"m46.473 56.848l-0.70312-1.8711 18.535-6.9609 0.70312 1.8711z\"/>
<path d=\"m70.324 31.156l-29.398 11.035-0.70312-1.8711 29.398-11.035z\"/>
<path d=\"m42.969 47.637l18.535-6.9609 0.70312 1.8711-18.535 6.9609z\"/>
<path d=\"m21 41.199l-5.5 2.1016 3.3984 9.1992 5.5-2.1016zm-2.8984 3.3008l1.8008-0.69922 2 5.3984-1.8008 0.69922z\"/>
<path d=\"m29.805 64.289l-1.8711 0.70313-4.5-11.984 1.8711-0.70312z\"/>
<path d=\"m21.668 53.633l4.5 11.984-1.8711 0.70312-4.5-11.984z\"/>
<path d=\"m30.293 54.645l3.1289 8.332-1.8711 0.70313-3.1289-8.332z\"/>
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/two-tickets.svg";
    }

    public function getDebugInfo()
    {
        return array (  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/images/icons/two-tickets.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/two-tickets.svg");
    }
}
