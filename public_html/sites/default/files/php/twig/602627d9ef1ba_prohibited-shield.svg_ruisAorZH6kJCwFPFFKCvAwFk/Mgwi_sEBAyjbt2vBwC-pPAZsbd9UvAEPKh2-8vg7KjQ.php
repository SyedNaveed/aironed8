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

/* themes/custom/airchoiceone/images/icons/prohibited-shield.svg */
class __TwigTemplate_65e9f7aa4ea1ce88cb7e03648ead881b79435b1723cff5e7be8a3a0bfc164bb7 extends \Twig\Template
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
<path d=\"m84.375 23.438c-13.668 0-20.312-4.6016-20.312-14.062 0-0.86328-0.69922-1.5625-1.5625-1.5625h-25c-0.86328 0-1.5625 0.69922-1.5625 1.5625 0 9.4609-6.6445 14.062-20.312 14.062-0.86328 0-1.5625 0.69922-1.5625 1.5625v28.125c0 16.203 33.664 37.902 35.094 38.816 0.25781 0.16406 0.55078 0.24609 0.84375 0.24609s0.58594-0.082031 0.84375-0.24609c1.4297-0.91406 35.094-22.613 35.094-38.816v-28.125c0-0.86328-0.69922-1.5625-1.5625-1.5625zm-1.5625 29.688c0 13.199-27.602 32.168-32.812 35.633-5.2109-3.4648-32.812-22.434-32.812-35.633v-26.582c13.816-0.36328 21.148-5.6055 21.824-15.605h21.977c0.67969 10 8.0078 15.242 21.824 15.605z\"/>
<path d=\"m50 29.688c-9.4766 0-17.188 7.7109-17.188 17.188s7.7109 17.188 17.188 17.188 17.188-7.7109 17.188-17.188-7.7109-17.188-17.188-17.188zm0 3.125c3.3164 0 6.3594 1.1602 8.7656 3.0859l-19.742 19.742c-1.9258-2.4062-3.0859-5.4492-3.0859-8.7656 0-7.7539 6.3086-14.062 14.062-14.062zm0 28.125c-3.3164 0-6.3594-1.1602-8.7656-3.0859l19.742-19.742c1.9258 2.4062 3.0859 5.4492 3.0859 8.7656 0 7.7539-6.3086 14.062-14.062 14.062z\"/>
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/prohibited-shield.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/prohibited-shield.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/prohibited-shield.svg");
    }
}
