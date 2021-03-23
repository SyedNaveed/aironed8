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

/* modules/contrib/swiftmailer/templates/swiftmailer.html.twig */
class __TwigTemplate_ce5090d54f9b2af7444935fa06782bf7393803ee14ec8873e0b89a23cf880a40 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 35];
        $filters = ["escape" => 51];
        $functions = [];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
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
        // line 35
        if (($context["is_html"] ?? null)) {
            // line 36
            echo "<html>
<head>
<style type=\"text/css\">
table tr td {
  font-family: Arial;
  font-size: 12px;
}
</style>
</head>
<body>
<div>
  <table width=\"800px\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td>
        <div style=\"padding: 0px 0px 0px 0px;\">
          ";
            // line 51
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["body"] ?? null)), "html", null, true);
            echo "
        </div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
";
        } else {
            // line 60
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["body"] ?? null)), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "modules/contrib/swiftmailer/templates/swiftmailer.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  86 => 60,  74 => 51,  57 => 36,  55 => 35,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{#
/**
 * @file
 * The default template file for e-mails.
 *
 * Available variables:
 * - subject: The subject.
 * - body: The message content.
 * - is_html: True if generating HTML output, false for plain text.
 * - message: The \$message array created and used in the mail building
 *   procedure. Its content varies between cases, but typically contains at
 *   least the following elements:
 *   - id: The message identifier.
 *   - module: The module that handles the building of the message.
 *   - key: The key of the message.
 *   - to: The recipient email address.
 *   - from: The email address of the sender.
 *   - langcode: The langcode to use to compose the e-mail.
 *   - params: The message parameters.
 * - base_url: The site base url including scheme, without trailing slash.
 *
 * This template may be overriden by module and/or mail key, using any of the
 * following template names:
 * - swiftmailer.html.twig: global, used by default.
 * - swiftmailer--mymodule.html.twig: only emails sent by the module \"mymodule\".
 * - swiftmailer--mymodule--test.html.twig: only emails by the module
 *   \"mymodule\" with key \"test\".
 *
 * @see template_preprocess()
 * @see template_preprocess_swiftmailer()
 *
 * @ingroup themeable
 */
#}
{% if is_html %}
<html>
<head>
<style type=\"text/css\">
table tr td {
  font-family: Arial;
  font-size: 12px;
}
</style>
</head>
<body>
<div>
  <table width=\"800px\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td>
        <div style=\"padding: 0px 0px 0px 0px;\">
          {{ body }}
        </div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
{% else %}
{{ body }}
{% endif %}
", "modules/contrib/swiftmailer/templates/swiftmailer.html.twig", "/var/www/aironem/public_html/modules/contrib/swiftmailer/templates/swiftmailer.html.twig");
    }
}
