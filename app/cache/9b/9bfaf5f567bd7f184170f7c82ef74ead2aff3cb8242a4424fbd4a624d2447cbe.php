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
class __TwigTemplate_45a47db2ec74870ffce4fba7a58cb6dae569b3f8337952a15a3c8a851650106e extends \Twig\Template
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
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<link rel=\"manifest\" href=\"site.webmanifest\">
\t\t<link rel=\"apple-touch-icon\" href=\"icon.png\">
\t\t<meta name=\"theme-color\" content=\"#ffffff\">
\t\t";
        // line 9
        echo " <!-- TODO -->
\t\t";
        // line 10
        echo " <!-- TODO -->
\t\t<script type=\"text/javascript\">
\t\t  const ajax_url = '";
        // line 12
        echo ($context["ajax_url"] ?? null);
        echo "';
\t\t</script>
\t\t";
        // line 14
        echo call_user_func_array($this->env->getFunction('fn')->getCallable(), ["wp_head"]);
        echo "
\t\t";
        // line 15
        $this->displayBlock('head', $context, $blocks);
        // line 17
        echo "\t</head>
\t<body class=\"";
        // line 18
        echo ($context["body_class"] ?? null);
        echo ($context["extra_body_class"] ?? null);
        echo "\">
\t\t";
        // line 19
        echo call_user_func_array($this->env->getFunction('fn')->getCallable(), ["wp_body_open"]);
        echo "
\t\t<nav></nav>
\t\t<header>
\t\t\t";
        // line 22
        $this->displayBlock('header', $context, $blocks);
        // line 24
        echo "\t\t</header>
\t\t<main>
\t\t\t";
        // line 26
        $this->displayBlock('main', $context, $blocks);
        // line 28
        echo "\t\t</main>
\t\t<footer>
\t\t\t";
        // line 30
        $this->displayBlock('footer', $context, $blocks);
        // line 32
        echo "\t\t</footer>
\t\t";
        // line 33
        echo call_user_func_array($this->env->getFunction('fn')->getCallable(), ["wp_footer"]);
        echo "
\t</body>
</html>
";
    }

    // line 15
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 16
        echo "\t\t";
    }

    // line 22
    public function block_header($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 23
        echo "\t\t\t";
    }

    // line 26
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 27
        echo "\t\t\t";
    }

    // line 30
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 31
        echo "\t\t\t";
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
        return array (  142 => 31,  138 => 30,  134 => 27,  130 => 26,  126 => 23,  122 => 22,  118 => 16,  114 => 15,  106 => 33,  103 => 32,  101 => 30,  97 => 28,  95 => 26,  91 => 24,  89 => 22,  83 => 19,  78 => 18,  75 => 17,  73 => 15,  69 => 14,  64 => 12,  60 => 10,  57 => 9,  49 => 4,  44 => 2,  41 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("<!doctype html>
<html class=\"no-js\" lang=\"{{ site.language }}\">
\t<head>
\t\t<meta charset=\"{{ site.charset }}\">
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
\t\t<link rel=\"manifest\" href=\"site.webmanifest\">
\t\t<link rel=\"apple-touch-icon\" href=\"icon.png\">
\t\t<meta name=\"theme-color\" content=\"#ffffff\">
\t\t{# <link rel=\"manifest\" href=\"site.webmanifest\"> #} <!-- TODO -->
\t\t{# <link rel=\"apple-touch-icon\" href=\"icon.png\"> #} <!-- TODO -->
\t\t<script type=\"text/javascript\">
\t\t  const ajax_url = '{{ ajax_url }}';
\t\t</script>
\t\t{{ fn('wp_head') }}
\t\t{% block head %}
\t\t{% endblock %}
\t</head>
\t<body class=\"{{ body_class }}{{ extra_body_class }}\">
\t\t{{ fn('wp_body_open') }}
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
\t\t{{ fn('wp_footer') }}
\t</body>
</html>
", "views/base.twig", "/Users/kolja/Sites/attentus-wp/web/app/themes/attentus/views/base.twig");
    }
}
