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

/* home/view.twig */
class __TwigTemplate_999e95d1c7ccc50008ab1a47aa26acedf318659101a433bd8120ab3861d73204 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'main' => [$this, 'block_main'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "views/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("views/base.twig", "home/view.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 2
    public function block_main($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 3
        echo "\t";
        echo twig_get_attribute($this->env, $this->source, ($context["macros"] ?? null), "read_more_link", [0 => "123"], "method", false, false, false, 3);
        echo "

";
    }

    public function getTemplateName()
    {
        return "home/view.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 3,  46 => 2,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends \"views/base.twig\" %}
{% block main %}
\t{{ macros.read_more_link('123') }}

{% endblock %}
", "home/view.twig", "/Users/kolja/Sites/attentus-wp/web/app/themes/attentus/pages/home/view.twig");
    }
}
