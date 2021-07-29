<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* views/base.twig */
class __TwigTemplate_102473cea033f4d694b60dddadb18b674c525c41e50b946e838456eb4feac1c3 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'head' => [$this, 'block_head'],
            'header' => [$this, 'block_header'],
            'main' => [$this, 'block_main'],
            'footer' => [$this, 'block_footer'],
            'foot' => [$this, 'block_foot'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!doctype html>
<html class=\"no-js\" lang=\"";
        // line 2
        echo twig_get_attribute($this->env, $this->source, ($context["site"] ?? null), "language", [], "any", false, false, false, 2);
        echo "\">
\t<head>
\t\t<meta charset=\"";
        // line 4
        echo twig_get_attribute($this->env, $this->source, ($context["site"] ?? null), "charset", [], "any", false, false, false, 4);
        echo "\">
\t\t<title>";
        // line 5
        echo ($context["wp_title"] ?? null);
        echo "</title>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<link rel=\"manifest\" href=\"site.webmanifest\">
\t\t<link rel=\"apple-touch-icon\" href=\"icon.png\">
\t\t<meta name=\"theme-color\" content=\"#fafafa\">
\t\t";
        // line 10
        echo call_user_func_array($this->env->getFunction('fn')->getCallable(), ["wp_head"]);
        echo "
\t\t";
        // line 11
        $this->displayBlock('head', $context, $blocks);
        // line 13
        echo "\t</head>
\t<body class=\"";
        // line 14
        echo ($context["body_class"] ?? null);
        echo "\">
\t\t<nav></nav>
\t\t<header>
\t\t\t";
        // line 17
        $this->displayBlock('header', $context, $blocks);
        // line 19
        echo "\t\t</header>
\t\t<main>
\t\t\t";
        // line 21
        $this->displayBlock('main', $context, $blocks);
        // line 23
        echo "\t\t</main>
\t\t<footer>
\t\t\t";
        // line 25
        $this->displayBlock('footer', $context, $blocks);
        // line 27
        echo "\t\t</footer>
\t\t";
        // line 28
        $this->displayBlock('foot', $context, $blocks);
        // line 30
        echo "\t\t";
        echo call_user_func_array($this->env->getFunction('fn')->getCallable(), ["wp_footer"]);
        echo "
\t</body>
</html>
";
    }

    // line 11
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 12
        echo "\t\t";
    }

    // line 17
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 18
        echo "\t\t\t";
    }

    // line 21
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 22
        echo "\t\t\t";
    }

    // line 25
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        echo "\t\t\t";
    }

    // line 28
    public function block_foot($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 29
        echo "\t\t";
    }

    public function getTemplateName()
    {
        return "views/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 29,  137 => 28,  133 => 26,  129 => 25,  125 => 22,  121 => 21,  117 => 18,  113 => 17,  109 => 12,  105 => 11,  96 => 30,  94 => 28,  91 => 27,  89 => 25,  85 => 23,  83 => 21,  79 => 19,  77 => 17,  71 => 14,  68 => 13,  66 => 11,  62 => 10,  54 => 5,  50 => 4,  45 => 2,  42 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html class=\"no-js\" lang=\"{{ site.language }}\">
\t<head>
\t\t<meta charset=\"{{ site.charset }}\">
\t\t<title>{{ wp_title }}</title>
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<link rel=\"manifest\" href=\"site.webmanifest\">
\t\t<link rel=\"apple-touch-icon\" href=\"icon.png\">
\t\t<meta name=\"theme-color\" content=\"#fafafa\">
\t\t{{ fn(\"wp_head\") }}
\t\t{% block head %}
\t\t{% endblock %}
\t</head>
\t<body class=\"{{ body_class }}\">
\t\t<nav></nav>
\t\t<header>
\t\t\t{% block header %}
\t\t\t{% endblock %}
\t\t</header>
\t\t<main>
\t\t\t{% block main %}
\t\t\t{% endblock %}
\t\t</main>
\t\t<footer>
\t\t\t{% block footer %}
\t\t\t{% endblock %}
\t\t</footer>
\t\t{% block foot %}
\t\t{% endblock %}
\t\t{{ fn(\"wp_footer\") }}
\t</body>
</html>
", "views/base.twig", "/Users/kolja/Sites/attentus/attentus-wp/web/app/themes/attentus/views/base.twig");
    }
}
