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

/* themes/custom/airchoiceone/images/icons/speech-balloons.svg */
class __TwigTemplate_39c7b492cee3256e40535c4bd14f519d4e318843595f5cf67a24502e60341778 extends \Twig\Template
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
        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"74.84\" height=\"48.815\" viewBox=\"0 0 74.84 48.815\">
  <path d=\"M39.049,38.93H22.836a1.144,1.144,0,1,0,0,2.289H39.049a1.144,1.144,0,0,0,0-2.289Z\" transform=\"translate(-9.176 -24.259)\" />
  <path d=\"M39.049,45.836H22.836a1.144,1.144,0,1,0,0,2.289H39.049a1.144,1.144,0,0,0,0-2.289Z\" transform=\"translate(-9.176 -25.09)\" />
  <path d=\"M82.305,49.743c0-11.341-7.773-18.11-20.795-18.11a26.1,26.1,0,0,0-11.543,2.347c-2.567-7.44-9.911-11.725-20.739-11.725-13.629,0-21.763,6.77-21.763,18.11,0,7.464,3.45,13.7,8.812,16.007l-1.148,3.852a1.14,1.14,0,0,0,1.1,1.467,1.128,1.128,0,0,0,.543-.137l6.375-3.45a47.388,47.388,0,0,0,6.083.368,28.154,28.154,0,0,0,12.416-2.529c2.44,7.584,9.591,11.907,19.863,11.907a43.67,43.67,0,0,0,5.78-.364l6.048,3.436A1.145,1.145,0,0,0,75,69.616l-1.1-3.88c5.117-2.309,8.406-8.547,8.406-15.994Zm-58.95,6.083a1.95,1.95,0,0,0-1.206.22l-4.034,2.186.44-1.481A1.964,1.964,0,0,0,17.4,54.358c-4.643-1.856-7.643-7.351-7.643-14,0-10.056,7.1-15.821,19.478-15.821s19.478,5.766,19.478,15.821-7.1,15.821-19.478,15.821a43.975,43.975,0,0,1-5.88-.357Zm49.393,7.921a1.978,1.978,0,0,0-1.117,2.368l.409,1.443-3.732-2.12a1.9,1.9,0,0,0-1.2-.23,40.646,40.646,0,0,1-5.595.361C51.985,65.568,45.7,61.746,43.7,54.8,48.4,51.712,51,46.77,51,40.368a20.894,20.894,0,0,0-.4-4.127,23.37,23.37,0,0,1,10.914-2.32c11.76,0,18.505,5.766,18.505,15.821,0,6.653-2.856,12.151-7.272,14Z\" transform=\"translate(-7.465 -22.254)\" />
  <path d=\"M75.412,49.59H59.962a1.144,1.144,0,0,0,0,2.289h15.45a1.144,1.144,0,1,0,0-2.289Z\" transform=\"translate(-13.64 -25.541)\" />
  <path d=\"M75.412,56.5H59.962a1.144,1.144,0,0,0,0,2.289h15.45a1.144,1.144,0,1,0,0-2.289Z\" transform=\"translate(-13.64 -26.372)\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/speech-balloons.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/speech-balloons.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/speech-balloons.svg");
    }
}
