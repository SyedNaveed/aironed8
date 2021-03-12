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

/* themes/custom/airchoiceone/templates/layout/html.html.twig */
class __TwigTemplate_510fdcb01497a657fa7c1df3e04b6bed8e26913d021579e65836e940d6058572 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["set" => 26, "if" => 43];
        $filters = ["clean_id" => 26, "escape" => 28, "safe_join" => 31];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['clean_id', 'escape', 'safe_join'],
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
        // line 26
        $context["node_class"] = ((($context["node_type"] ?? null)) ? ((" is-node node-" . \Drupal\Component\Utility\Html::getId($this->sandbox->ensureToStringAllowed(($context["node_type"] ?? null))))) : (" not-node"));
        // line 27
        echo "<!DOCTYPE html>
<html";
        // line 28
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["html_attributes"] ?? null), "addClass", [0 => "no-js"], "method")), "html", null, true);
        echo ">
  <head>
    <head-placeholder token=\"";
        // line 30
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
    <title>";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->env->getExtension('Drupal\Core\Template\TwigExtension')->safeJoin($this->env, $this->sandbox->ensureToStringAllowed(($context["head_title"] ?? null)), " | "));
        echo "</title>
    <meta charset=\"utf-8\">
    <meta name=\"theme-color\" content=\"#fe0000\" />
    <meta name=\"msapplication-navbutton-color\" content=\"#fe0000\">
    <meta name=\"apple-mobile-web-app-status-bar-style\" content=\"#fe0000\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"author\" content=\"DELT\">
    <meta name=\"format-detection\" content=\"telephone=no\">
    <link rel=\"stylesheet\" href=\"https://use.typekit.net/dsw4ivk.css\">
    <link rel=\"stylesheet\" href=\"https://use.typekit.net/iys1vay.css\">
    <css-placeholder token=\"";
        // line 41
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
    <js-placeholder token=\"";
        // line 42
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
";
        // line 43
        if (($context["is_live"] ?? null)) {
            // line 44
            echo "<script>
(function(h,o,t,j,a,r){
h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
h._hjSettings={hjid:1566436,hjsv:6};
a=o.getElementsByTagName('head')[0];
r=o.createElement('script');r.async=1;
r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
a.appendChild(r);
})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KJWDXL3');</script>
<!-- End Google Tag Manager -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5VCPMB8');</script>
<!-- End Google Tag Manager -->
<!-- Global site tag (gtag.js) - Google AdWords: 853029694 -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=AW-853029694\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'AW-853029694');
</script>
<script type=\"text/javascript\" src=\"https://cdn.weglot.com/weglot.min.js\"></script>
<script>Weglot.initialize({api_key: 'wg_4c0d86c8c2c1606dc70bd8a5a102dda63'});</script>
";
        }
        // line 79
        if ( !($context["is_local"] ?? null)) {
            // line 80
            echo "  <script id=\"ze-snippet\" src=\"https://static.zdassets.com/ekr/snippet.js?key=856db752-68b8-479e-994a-625fe0a69c89\"></script>
";
        }
        // line 82
        echo "  </head>
  <body";
        // line 83
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => ("site" . $this->sandbox->ensureToStringAllowed(($context["node_class"] ?? null)))], "method")), "html", null, true);
        echo ">
    ";
        // line 84
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_top"] ?? null)), "html", null, true);
        echo "
    ";
        // line 85
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page"] ?? null)), "html", null, true);
        echo "
    ";
        // line 86
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["page_bottom"] ?? null)), "html", null, true);
        echo "
    <js-bottom-placeholder token=\"";
        // line 87
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["placeholder_token"] ?? null)), "html", null, true);
        echo "\">
";
        // line 88
        if (( !($context["is_local"] ?? null) &&  !($context["is_live"] ?? null))) {
            // line 89
            echo "<script>
  (function (d, t, g) {
  var ph    = d.createElement(t), s = d.getElementsByTagName(t)[0];
  ph.type   = 'text/javascript';
  ph.async   = true;
  ph.charset = 'UTF-8';
  ph.src     = g + '&v=' + (new Date()).getTime();
  s.parentNode.insertBefore(ph, s);
  })(document, 'script', '//www.delt.work/?p=21&ph_apikey=d476eb1f27f0daf0cad966c544618cc4');
</script>
";
        }
        // line 100
        if (($context["is_live"] ?? null)) {
            // line 101
            echo "<!-- Google Tag Manager (noscript) -->
<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id=GTM-KJWDXL3\"
height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-2656423-17\"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-2656423-17');
</script>
";
            // line 113
            if (($context["enable_brandcdn_script"] ?? null)) {
                // line 114
                echo "<script src=\"//tag.brandcdn.com/autoscript/southeastiowaregionalairport_vfhwrk13pt0=/onmediadigital2016.js\"></script>
";
            }
        }
        // line 117
        echo "  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "themes/custom/airchoiceone/templates/layout/html.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  196 => 117,  191 => 114,  189 => 113,  175 => 101,  173 => 100,  160 => 89,  158 => 88,  154 => 87,  150 => 86,  146 => 85,  142 => 84,  138 => 83,  135 => 82,  131 => 80,  129 => 79,  92 => 44,  90 => 43,  86 => 42,  82 => 41,  69 => 31,  65 => 30,  60 => 28,  57 => 27,  55 => 26,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/airchoiceone/templates/layout/html.html.twig", "/home/customer/www/airchoiceone.com/public_html/themes/custom/airchoiceone/templates/layout/html.html.twig");
    }
}
