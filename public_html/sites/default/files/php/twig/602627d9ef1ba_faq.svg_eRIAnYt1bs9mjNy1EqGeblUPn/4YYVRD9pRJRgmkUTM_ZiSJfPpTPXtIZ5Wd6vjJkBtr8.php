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

/* themes/custom/airchoiceone/images/icons/faq.svg */
class __TwigTemplate_8b43cd600ea3455212f4cbddfb1ccb1763d1db390399130bce554590dcd1c30b extends \Twig\Template
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
  <path d=\"m2.5 100c-0.65234 0-1.293-0.25781-1.7695-0.73047-0.67188-0.67188-0.90625-1.6641-0.60156-2.5664l7.0469-20.902c-4.6992-7.7852-7.1758-16.68-7.1758-25.801 0-27.57 22.43-50 50-50s50 22.43 50 50-22.43 50-50 50c-9.1211 0-18.016-2.4766-25.797-7.1758l-20.906 7.043c-0.26172 0.089843-0.52734 0.13281-0.79688 0.13281zm22.02-12.422c0.46875 0 0.9375 0.13281 1.3438 0.39062 7.2188 4.6016 15.566 7.0312 24.137 7.0312 24.812 0 45-20.188 45-45s-20.188-45-45-45-45 20.188-45 45c0 8.5703 2.4297 16.918 7.0312 24.137 0.40625 0.64062 0.50391 1.4258 0.26172 2.1445l-5.8125 17.238 17.242-5.8125c0.25781-0.085937 0.52734-0.12891 0.79688-0.12891z\" />
  <path d=\"m47.871 67.844c-1.3828 0-2.5-1.1172-2.5-2.5v-3.875c0-7.5195 4.5859-10.91 8.2695-13.633 3.3477-2.4766 5.9922-4.4297 5.9922-9.0078 0-5.9141-3.7578-9.7344-9.5742-9.7344-6.6562 0-9.6875 5.4414-9.6875 10.5 0 1.3828-1.1172 2.5-2.5 2.5-1.3828 0-2.5-1.1172-2.5-2.5 0-7.7031 5.0469-15.5 14.688-15.5 8.582 0 14.574 6.0586 14.574 14.734 0 7.0977-4.4453 10.387-8.0195 13.027-3.4883 2.5781-6.2422 4.6133-6.2422 9.6133v3.875c0 1.3828-1.1211 2.5-2.5 2.5z\" />
  <path d=\"m50.309 74.906c0 3.332-5 3.332-5 0s5-3.332 5 0\" />
</svg>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/images/icons/faq.svg";
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
        return new Source("", "themes/custom/airchoiceone/images/icons/faq.svg", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/images/icons/faq.svg");
    }
}
