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

/* themes/custom/airchoiceone/images/icons/beach.svg */
class __TwigTemplate_c1c7845dfe047ea2b8cd2fa0a13faadc38866907b0b01406a9873aa5337fa9cb extends \Twig\Template
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
  <path d=\"m91.961 78.668h-7.793v-1.9727l0.57422-4.2812c0.066406-0.48828-0.23047-0.94922-0.70313-1.0898 0 0-11.129-3.3398-11.227-3.3398l-30.293-0.003906-0.20312-0.19922c0.027344-0.09375 0.058594-0.18359 0.058594-0.28125v-31.195c0-0.015626-0.007812-0.027344-0.007812-0.042969 6.3984 0.027343 12.48 0.36719 18.074 1.0352 0.21094 0.027344 0.42578-0.019531 0.60938-0.12109 0.054688-0.03125 5.6758-3.168 10.18-3.168 0.50391 0 0.97266 0.039063 1.4023 0.11719 0.0625 0.011719 0.12109 0.015625 0.18359 0.015625 0.007813 0 0.019532-0.003906 0.019532 0 0.55469 0 1-0.44922 1-1 0-0.47266-0.32813-0.86719-0.76953-0.97266l-31.797-11.695c-0.22266-0.082031-0.46875-0.082031-0.69141 0l-31.758 11.73c-0.46484 0.17188-0.73437 0.65625-0.63281 1.1406s0.53125 0.81641 1.0352 0.79688c0.015625 0 0.45703-0.023437 1.1719-0.023437 5.0938 0 8.918 1.043 10.23 2.7891 0.074219 0.10156 0.17969 0.17188 0.28516 0.23828 0.023438 0.015625 0.042969 0.042969 0.066406 0.058594 0.13672 0.070313 0.28906 0.10547 0.44531 0.10547 0.039063 0 0.082031-0.003906 0.12109-0.007813 0.082031-0.011719 8.043-0.97266 18.84-1.0391 0 0.015625-0.011718 0.03125-0.011718 0.046875v29.559l-8.5-8.3945c-0.39062-0.38672-1.0195-0.38672-1.4102 0.003906l-2.7617 2.7578c-0.38672 0.38672-0.39062 1.0195-0.003907 1.4062 0 0 12.648 12.824 12.684 12.852v0.007812 4.168h-23.918c-0.55078 0-1 0.44531-1 1 0 0.55469 0.44922 1 1 1h75.5c0.55469 0 1-0.44531 1-1 0-0.55469-0.44922-1-1-1zm-24.051-46.266c-3.4141 0.75391-6.582 2.3555-7.5508 2.8711-0.3125-0.035157-0.64062-0.0625-0.95703-0.097657l-13.148-10.738zm-53.652-0.074219 22.695-8.3828-15.41 11.039c-1.7461-1.6094-4.6211-2.3477-7.2852-2.6562zm10.781 2.6133 16.469-11.801 14.293 11.676c-4.5156-0.37891-9.2812-0.57031-14.23-0.57031-6.9961 0.003906-12.926 0.39062-16.531 0.69531zm57.125 43.727h-39.789v-3.9414h29.781l10.012 2.668zm0.058594-3.3281s-9.8516-2.6133-9.9375-2.6133h-30.879l-11.59-11.777 1.3633-1.3633 10.23 10.105c0.1875 0.1875 0.4375 0.28906 0.70312 0.28906h30.555l9.9805 3.0078c-0.003907 0-0.39063 2.2422-0.42578 2.3516z\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/beach.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/beach.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/beach.svg");
    }
}
