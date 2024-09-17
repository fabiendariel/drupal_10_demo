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

/* themes/contrib/bootstrap_barrio/templates/navigation/menu--account.html.twig */
class __TwigTemplate_b15b11c584bba72356b43bb7b256c602 extends Template
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
        // line 21
        $macros["menus"] = $this->macros["menus"] = $this;
        // line 22
        yield "
";
        // line 27
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["menus"], "macro_menu_links", [($context["items"] ?? null), ($context["attributes"] ?? null), 0], 27, $context, $this->getSourceContext()));
        yield "
";
        // line 66
        yield " 

";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["_self", "items", "attributes", "menu_level"]);        return; yield '';
    }

    // line 28
    public function macro_menu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $macros = $this->macros;
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        return ('' === $tmp = \Twig\Extension\CoreExtension::captureOutput((function () use (&$context, $macros, $blocks) {
            // line 29
            yield "  ";
            $macros["menus"] = $this;
            // line 30
            yield "  ";
            if (($context["items"] ?? null)) {
                // line 31
                yield "    ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 32
                    yield "      <ul";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["nav navbar-nav"], "method", false, false, true, 32), 32, $this->source), "id"), "html", null, true);
                    yield ">
    ";
                } else {
                    // line 34
                    yield "      <ul class=\"dropdown-menu\">
    ";
                }
                // line 36
                yield "    ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 37
                    yield "      ";
                    // line 38
                    $context["classes"] = [((                    // line 39
($context["menu_level"] ?? null)) ? ("dropdown-item") : ("nav-item")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 40
$context["item"], "is_expanded", [], "any", false, false, true, 40)) ? ("menu-item--expanded") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 41
$context["item"], "is_collapsed", [], "any", false, false, true, 41)) ? ("menu-item--collapsed") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 42
$context["item"], "in_active_trail", [], "any", false, false, true, 42)) ? ("active") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 43
$context["item"], "below", [], "any", false, false, true, 43)) ? ("dropdown") : (""))];
                    // line 46
                    yield "      <li";
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "attributes", [], "any", false, false, true, 46), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 46), 46, $this->source), "html", null, true);
                    yield ">
        ";
                    // line 48
                    $context["link_classes"] = [(( !                    // line 49
($context["menu_level"] ?? null)) ? ("nav-link") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 50
$context["item"], "in_active_trail", [], "any", false, false, true, 50)) ? ("active") : ("")), ((CoreExtension::getAttribute($this->env, $this->source,                     // line 51
$context["item"], "below", [], "any", false, false, true, 51)) ? ("dropdown-toggle") : ("")), ((CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                     // line 52
$context["item"], "url", [], "any", false, false, true, 52), "getOption", ["attributes"], "method", false, false, true, 52), "class", [], "any", false, false, true, 52)) ? (Twig\Extension\CoreExtension::join($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 52), "getOption", ["attributes"], "method", false, false, true, 52), "class", [], "any", false, false, true, 52), 52, $this->source), " ")) : ("")), ("nav-link-" . \Drupal\Component\Utility\Html::getClass($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,                     // line 53
$context["item"], "url", [], "any", false, false, true, 53), "toString", [], "method", false, false, true, 53), 53, $this->source)))];
                    // line 56
                    yield "        ";
                    if (CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 56)) {
                        // line 57
                        yield "          ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 57), 57, $this->source), $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 57), 57, $this->source), ["class" => ($context["link_classes"] ?? null), "data-bs-toggle" => "dropdown", "aria-expanded" => "false", "aria-haspopup" => "true"]), "html", null, true);
                        yield "
          ";
                        // line 58
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::callMacro($macros["menus"], "macro_menu_links", [CoreExtension::getAttribute($this->env, $this->source, $context["item"], "below", [], "any", false, false, true, 58), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)], 58, $context, $this->getSourceContext()));
                        yield "
        ";
                    } else {
                        // line 60
                        yield "          ";
                        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->getLink($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 60), 60, $this->source), $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, true, 60), 60, $this->source), ["class" => ($context["link_classes"] ?? null)]), "html", null, true);
                        yield "
        ";
                    }
                    // line 62
                    yield "      </li>
    ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 64
                yield "    </ul>
  ";
            }
            return; yield '';
        })())) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/contrib/bootstrap_barrio/templates/navigation/menu--account.html.twig";
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
        return array (  142 => 64,  135 => 62,  129 => 60,  124 => 58,  119 => 57,  116 => 56,  114 => 53,  113 => 52,  112 => 51,  111 => 50,  110 => 49,  109 => 48,  104 => 46,  102 => 43,  101 => 42,  100 => 41,  99 => 40,  98 => 39,  97 => 38,  95 => 37,  90 => 36,  86 => 34,  80 => 32,  77 => 31,  74 => 30,  71 => 29,  57 => 28,  49 => 66,  45 => 27,  42 => 22,  40 => 21,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/contrib/bootstrap_barrio/templates/navigation/menu--account.html.twig", "/var/www/html/web/themes/contrib/bootstrap_barrio/templates/navigation/menu--account.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("import" => 21, "macro" => 28, "if" => 30, "for" => 36, "set" => 38);
        static $filters = array("escape" => 32, "without" => 32, "join" => 52, "clean_class" => 53);
        static $functions = array("link" => 57);

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'without', 'join', 'clean_class'],
                ['link'],
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
