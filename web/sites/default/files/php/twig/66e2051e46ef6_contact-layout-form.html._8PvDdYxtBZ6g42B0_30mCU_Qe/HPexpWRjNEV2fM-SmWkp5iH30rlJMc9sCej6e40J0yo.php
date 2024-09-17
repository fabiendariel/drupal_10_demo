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

/* modules/custom/contact_layout/templates/contact-layout-form.html.twig */
class __TwigTemplate_6966902961974bf81910d191bb1f5c49 extends Template
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
        // line 1
        yield "<!-- Contact-->
<section class=\"page-section\" id=\"contact\">
  <div class=\"container\">
    <div class=\"text-center w-75 align-center\">
      <h2 class=\"section-heading text-uppercase\">
        Request a quote
      </h2>
      <h3 class=\"section-subheading text-muted\">
        We'd be delighted to chat about a potential project with you. Just fill out this quick form so we can get a bit of information, and we'll get back to you shortly.
      </h3>
    </div>
      
    <form";
        // line 13
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["attributes"] ?? null), 13, $this->source), "html", null, true);
        yield ">
      ";
        // line 14
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "form_build_id", [], "any", false, false, true, 14), 14, $this->source), "html", null, true);
        yield "
      ";
        // line 15
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "form_token", [], "any", false, false, true, 15), 15, $this->source), "html", null, true);
        yield "
      ";
        // line 16
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "form_id", [], "any", false, false, true, 16), 16, $this->source), "html", null, true);
        yield "
      ";
        // line 17
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "nid", [], "any", false, false, true, 17), 17, $this->source), "html", null, true);
        yield "
      <div class=\"row align-items-stretch mb-5\">
        <div class=\"col-md-6\">
          <div class=\"form-group\">
            ";
        // line 21
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "name", [], "any", false, false, true, 21), 21, $this->source), "html", null, true);
        yield "
          </div>
          <div class=\"form-group\">
            ";
        // line 24
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "email", [], "any", false, false, true, 24), 24, $this->source), "html", null, true);
        yield "
          </div>
          <div class=\"form-group\">
            ";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "phone", [], "any", false, false, true, 27), 27, $this->source), "html", null, true);
        yield "
          </div>
        </div>
        <div class=\"col-md-6\">
          <div class=\"form-group\">
            ";
        // line 32
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "message", [], "any", false, false, true, 32), 32, $this->source), "html", null, true);
        yield "
          </div>
        </div>
      </div>
      <!-- Submit Button -->
      <div class=\"text-center\">
          ";
        // line 38
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["form"] ?? null), "submit", [], "any", false, false, true, 38), 38, $this->source), "html", null, true);
        yield "
      </div>
    </form>
  </div>
</section>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "form"]);        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "modules/custom/contact_layout/templates/contact-layout-form.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  106 => 38,  97 => 32,  89 => 27,  83 => 24,  77 => 21,  70 => 17,  66 => 16,  62 => 15,  58 => 14,  54 => 13,  40 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/contact_layout/templates/contact-layout-form.html.twig", "/var/www/html/web/modules/custom/contact_layout/templates/contact-layout-form.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array();
        static $filters = array("escape" => 13);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                [],
                ['escape'],
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
