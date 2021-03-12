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

/* themes/custom/airchoiceone/images/icons/tag.svg */
class __TwigTemplate_62d5979542aa867a91d26199005268d632701a499ea5e9238339ca406205c6dc extends \Twig\Template
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
        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"48.816\" height=\"48.815\" viewBox=\"0 0 48.816 48.815\">
  <path d=\"M48.157,5,34.68,5.2a9.936,9.936,0,0,0-6.913,2.926L6.656,29.236a5.66,5.66,0,0,0,0,8l14.92,14.92a5.662,5.662,0,0,0,8,0L50.691,31.047a9.933,9.933,0,0,0,2.924-6.913l.2-13.39A5.661,5.661,0,0,0,48.157,5ZM28.045,50.624a3.491,3.491,0,0,1-4.934,0L8.19,35.7a3.494,3.494,0,0,1,0-4.937l2.759-2.759L30.8,47.865ZM51.444,24.1a7.774,7.774,0,0,1-2.288,5.411l-17.2,17.2L12.1,26.861l17.2-17.2a7.79,7.79,0,0,1,5.413-2.29l13.443-.2a3.491,3.491,0,0,1,3.487,3.54Z\" transform=\"translate(-4.999 -5)\" />
  <path d=\"M67.1,18.492a5.361,5.361,0,1,0,3.79,1.57A5.329,5.329,0,0,0,67.1,18.492Zm2.256,7.621a3.191,3.191,0,1,1,0-4.515A3.173,3.173,0,0,1,69.354,26.113Z\" transform=\"translate(-30.963 -11.174)\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/tag.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/tag.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/tag.svg");
    }
}
