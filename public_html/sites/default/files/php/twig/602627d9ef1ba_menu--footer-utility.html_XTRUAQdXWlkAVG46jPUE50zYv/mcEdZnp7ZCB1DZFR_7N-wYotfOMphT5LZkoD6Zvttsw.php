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

/* themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig */
class __TwigTemplate_889d0e97ce17403f07b21520fe4ff90a1163c15b5a6067d3ce734a57c340196b extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 23, "macro" => 31, "if" => 33, "for" => 39, "include" => 48, "set" => 60];
        $filters = ["escape" => 35];
        $functions = ["create_attribute" => 61];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'include', 'set'],
                ['escape'],
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
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 35
                    echo "      <ul";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "block-list"], "method")), "html", null, true);
                    echo ">
    ";
                } else {
                    // line 37
                    echo "      <ul>
    ";
                }
                // line 39
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
                    // line 40
                    echo "      ";
                    if ($this->getAttribute($context["loop"], "first", [])) {
                        // line 41
                        echo "        <li";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "attributes", [])), "html", null, true);
                        echo ">
      ";
                    } elseif ((($this->getAttribute(                    // line 42
$context["loop"], "index", []) > 1) && ($this->getAttribute($context["loop"], "index", []) < 6))) {
                        // line 43
                        echo "        <li";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => "smallersvg"], "method")), "html", null, true);
                        echo ">
      ";
                    } else {
                        // line 45
                        echo "        <li";
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => "mobileonly"], "method")), "html", null, true);
                        echo ">
      ";
                    }
                    // line 47
                    echo "        ";
                    if (($this->getAttribute($context["loop"], "index", []) == 1)) {
                        // line 48
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/airplane.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 48)->display($context);
                        // line 49
                        echo "        ";
                    } elseif (($this->getAttribute($context["loop"], "index", []) == 2)) {
                        // line 50
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/bell.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 50)->display($context);
                        // line 51
                        echo "        ";
                    } elseif (($this->getAttribute($context["loop"], "index", []) == 3)) {
                        // line 52
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/speech-balloons.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 52)->display($context);
                        // line 53
                        echo "        ";
                    } elseif (($this->getAttribute($context["loop"], "index", []) == 4)) {
                        // line 54
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/tag.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 54)->display($context);
                        // line 55
                        echo "        ";
                    } elseif (($this->getAttribute($context["loop"], "index", []) == 5)) {
                        // line 56
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/headphones.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 56)->display($context);
                        // line 57
                        echo "        ";
                    } else {
                        // line 58
                        echo "          ";
                        $this->loadTemplate("themes/custom/airchoiceone/images/icons/lightbulb.svg", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", 58)->display($context);
                        // line 59
                        echo "        ";
                    }
                    // line 60
                    echo "        ";
                    $context["attrs"] = $this->getAttribute($this->getAttribute($this->getAttribute($context["item"], "original_link", []), "getOptions", [], "method"), "attributes", []);
                    // line 61
                    echo "        <a href=\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                    echo "\"";
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->createAttribute(((($context["attrs"] ?? null)) ? (($context["attrs"] ?? null)) : ([]))), "html", null, true);
                    echo ">
          <h4>";
                    // line 62
                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                    echo "</h4>
        </a>
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
                // line 66
                echo "    </ul>
  ";
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
        return "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  207 => 66,  189 => 62,  182 => 61,  179 => 60,  176 => 59,  173 => 58,  170 => 57,  167 => 56,  164 => 55,  161 => 54,  158 => 53,  155 => 52,  152 => 51,  149 => 50,  146 => 49,  143 => 48,  140 => 47,  134 => 45,  128 => 43,  126 => 42,  121 => 41,  118 => 40,  100 => 39,  96 => 37,  90 => 35,  87 => 34,  84 => 33,  81 => 32,  67 => 31,  60 => 29,  57 => 24,  55 => 23,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/navigation/menu--footer-utility.html.twig");
    }
}
