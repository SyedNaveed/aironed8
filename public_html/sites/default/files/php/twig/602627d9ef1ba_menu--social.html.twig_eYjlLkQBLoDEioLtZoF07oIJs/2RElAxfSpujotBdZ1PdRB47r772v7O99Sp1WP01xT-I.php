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

/* themes/custom/airchoiceone/templates/navigation/menu--social.html.twig */
class __TwigTemplate_f62812454ed123505f27fbde2b03e3c9487b7f7885f05e3749bfb39b42b11f48 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 23, "macro" => 31, "if" => 33, "for" => 34, "set" => 36, "include" => 40];
        $filters = ["escape" => 35, "lower" => 36];
        $functions = ["create_attribute" => 38];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set', 'include'],
                ['escape', 'lower'],
                ['create_attribute']
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
        // line 23
        $context["menus"] = $this;
        // line 24
        echo "
";
        // line 29
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0));
        echo "

";
    }

    // line 31
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 32
            echo "  ";
            $context["menus"] = $this;
            // line 33
            echo "  ";
            if (($context["items"] ?? null)) {
                // line 34
                echo "    ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 35
                    echo "      <li";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "attributes", [])), "html", null, true);
                    echo ">
        ";
                    // line 36
                    $context["key"] = twig_lower_filter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])));
                    // line 37
                    echo "        ";
                    $context["attrs"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "original_link", []), "getOptions", [], "method"), "attributes", []);
                    // line 38
                    echo "        <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                    echo "\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->createAttribute(((($context["attrs"] ?? null)) ? (($context["attrs"] ?? null)) : ([]))), "html", null, true);
                    echo ">
          ";
                    // line 39
                    if ((($context["key"] ?? null) == "facebook")) {
                        // line 40
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/facebook.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 40)->display($context);
                        // line 41
                        echo "          ";
                    } elseif ((($context["key"] ?? null) == "instagram")) {
                        // line 42
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/instagram.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 42)->display($context);
                        // line 43
                        echo "          ";
                    } elseif ((($context["key"] ?? null) == "linkedin")) {
                        // line 44
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/linkedin.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 44)->display($context);
                        // line 45
                        echo "          ";
                    } elseif ((($context["key"] ?? null) == "twitter")) {
                        // line 46
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/twitter.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 46)->display($context);
                        // line 47
                        echo "          ";
                    } elseif ((($context["key"] ?? null) == "yelp")) {
                        // line 48
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/yelp.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 48)->display($context);
                        // line 49
                        echo "          ";
                    } elseif ((($context["key"] ?? null) == "youtube")) {
                        // line 50
                        echo "            ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/youtube.svg", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", 50)->display($context);
                        // line 51
                        echo "          ";
                    } else {
                        // line 52
                        echo "            ";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                        echo "
          ";
                    }
                    // line 54
                    echo "        </a>
      </li>
    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 57
                echo "  ";
            }
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 57,  166 => 54,  160 => 52,  157 => 51,  154 => 50,  151 => 49,  148 => 48,  145 => 47,  142 => 46,  139 => 45,  136 => 44,  133 => 43,  130 => 42,  127 => 41,  124 => 40,  122 => 39,  115 => 38,  112 => 37,  110 => 36,  105 => 35,  87 => 34,  84 => 33,  81 => 32,  67 => 31,  60 => 29,  57 => 24,  55 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/navigation/menu--social.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/navigation/menu--social.html.twig");
    }
}
