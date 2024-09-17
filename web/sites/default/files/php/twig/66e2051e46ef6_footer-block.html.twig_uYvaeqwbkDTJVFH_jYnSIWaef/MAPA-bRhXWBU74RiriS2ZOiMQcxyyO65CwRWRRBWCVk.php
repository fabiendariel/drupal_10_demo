<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/custom_blocks/templates/footer-block.html.twig */
class __TwigTemplate_cc1532f49ccae17846868362cb4c1bc4 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension(SandboxExtension::class);
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        yield "<!-- Footer-->
<div class=\"row align-items-center\">
    <div class=\"col-lg-4 text-lg-start\">
        Copyright © Your Website 2023
    </div>
    <div class=\"col-lg-4 my-3 my-lg-0\">
        <a class=\"btn btn-light btn-social mx-2\" href=\"#!\" aria-label=\"Twitter\"><i class=\"fa-brands fa-twitter\">&nbsp;</i></a>&nbsp;<a class=\"btn btn-light btn-social mx-2\" href=\"#!\" aria-label=\"Facebook\"><i class=\"fa-brands fa-facebook-f\">&nbsp;</i></a>&nbsp;<a class=\"btn btn-light btn-social mx-2\" href=\"#!\" aria-label=\"LinkedIn\"><i class=\"fa-brands fa-linkedin-in\">&nbsp;</i></a>
    </div>
    <div class=\"col-lg-4 text-lg-end\">
        <a class=\"text-decoration-none me-3\" href=\"#!\">Privacy Policy</a> <a class=\"text-decoration-none\" href=\"#!\">Terms of Use</a>
    </div>
</div>";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/custom/custom_blocks/templates/footer-block.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array ();
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/custom_blocks/templates/footer-block.html.twig", "/var/www/html/web/modules/custom/custom_blocks/templates/footer-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                [],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

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
}
