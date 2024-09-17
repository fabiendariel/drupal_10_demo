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

/* themes/custom/custom_theme/templates/layout/page.html.twig */
class __TwigTemplate_0061d46f8d7e650985ac496eb08a352f extends Template
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
            'featured' => [$this, 'block_featured'],
            'content' => [$this, 'block_content'],
            'footer' => [$this, 'block_footer'],
        ];
        $this->sandbox = $this->env->getExtension(SandboxExtension::class);
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 71
        $context["sidebar_first_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 71), 71, $this->source)), "<img><video><audio><drupal-render-placeholder>")));
        // line 72
        $context["sidebar_second_exists"] =  !Twig\Extension\CoreExtension::testEmpty(Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 72), 72, $this->source)), "<img><video><audio><drupal-render-placeholder>")));
        // line 73
        yield "
<div id=\"page-wrapper\">
  <div id=\"page\">
    
    ";
        // line 77
        yield from $this->unwrap()->yieldBlock('head', $context, $blocks);
        // line 118
        yield "     
    ";
        // line 119
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 119)) {
            // line 120
            yield "      <div class=\"highlighted\">
        <aside class=\"";
            // line 121
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 121, $this->source), "html", null, true);
            yield " section clearfix\" role=\"complementary\">
          ";
            // line 122
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "highlighted", [], "any", false, false, true, 122), 122, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 126
        yield "    ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 126)) {
            // line 127
            yield "      ";
            yield from $this->unwrap()->yieldBlock('featured', $context, $blocks);
            // line 134
            yield "    ";
        }
        // line 135
        yield "    <div id=\"main-wrapper\" class=\"layout-main-wrapper clearfix\">
      ";
        // line 136
        yield from $this->unwrap()->yieldBlock('content', $context, $blocks);
        // line 163
        yield "    </div>
    ";
        // line 164
        if (((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 164) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 164)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 164))) {
            // line 165
            yield "      <div class=\"featured-bottom\">
        <aside class=\"";
            // line 166
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 166, $this->source), "html", null, true);
            yield " clearfix\" role=\"complementary\">
          ";
            // line 167
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_first", [], "any", false, false, true, 167), 167, $this->source), "html", null, true);
            yield "
          ";
            // line 168
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_second", [], "any", false, false, true, 168), 168, $this->source), "html", null, true);
            yield "
          ";
            // line 169
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_bottom_third", [], "any", false, false, true, 169), 169, $this->source), "html", null, true);
            yield "
        </aside>
      </div>
    ";
        }
        // line 173
        yield "    <footer class=\"site-footer pt-1\">
      ";
        // line 174
        yield from $this->unwrap()->yieldBlock('footer', $context, $blocks);
        // line 191
        yield "    </footer>
  </div>
</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "container", "navbar_attributes", "container_navbar", "navbar_collapse_btn_data", "navbar_collapse_class", "navbar_offcanvas", "sidebar_collapse", "content_attributes", "sidebar_first_attributes", "sidebar_second_attributes"]);        return; yield '';
    }

    // line 77
    public function block_head($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 78
        yield "      ";
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 78) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 78)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 78)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 78))) {
            // line 79
            yield "        <nav";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_attributes"] ?? null), 79, $this->source), "html", null, true);
            yield ">
          ";
            // line 80
            if (($context["container_navbar"] ?? null)) {
                // line 81
                yield "          <div class=\"container\">
          ";
            }
            // line 83
            yield "            ";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header", [], "any", false, false, true, 83), 83, $this->source), "html", null, true);
            yield "
            ";
            // line 84
            if ((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 84) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 84))) {
                // line 85
                yield "              <button class=\"navbar-toggler collapsed\" type=\"button\" data-bs-toggle=\"";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_btn_data"] ?? null), 85, $this->source), "html", null, true);
                yield "\" data-bs-target=\"#CollapsingNavbar\" aria-controls=\"CollapsingNavbar\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
                Menu
                <i class=\"fas fa-bars ms-1\"></i>
              </button>
              <div class=\"";
                // line 89
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["navbar_collapse_class"] ?? null), 89, $this->source), "html", null, true);
                yield "\" id=\"CollapsingNavbar\">
                ";
                // line 90
                if (($context["navbar_offcanvas"] ?? null)) {
                    // line 91
                    yield "                  <div class=\"offcanvas-header\">
                    <button type=\"button\" class=\"btn-close text-reset\" data-bs-dismiss=\"offcanvas\" aria-label=\"Close\"></button>
                  </div>
                  <div class=\"offcanvas-body\">
                ";
                }
                // line 96
                yield "                ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 96), 96, $this->source), "html", null, true);
                yield "
                ";
                // line 97
                if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 97)) {
                    // line 98
                    yield "                  <div class=\"form-inline navbar-form justify-content-end ms-3 mt-3\">
                    ";
                    // line 99
                    yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "header_form", [], "any", false, false, true, 99), 99, $this->source), "html", null, true);
                    yield "
                  </div>
                ";
                }
                // line 102
                yield "                ";
                yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "secondary_menu", [], "any", false, false, true, 102), 102, $this->source), "html", null, true);
                yield "
                ";
                // line 103
                if (($context["navbar_offcanvas"] ?? null)) {
                    // line 104
                    yield "                  </div>
                ";
                }
                // line 106
                yield "              </div>
            ";
            }
            // line 108
            yield "            ";
            if (($context["sidebar_collapse"] ?? null)) {
                // line 109
                yield "              <button class=\"navbar-toggler navbar-toggler-left collapsed\" type=\"button\" data-bs-toggle=\"collapse\" data-bs-target=\"#CollapsingLeft\" aria-controls=\"CollapsingLeft\" aria-expanded=\"false\" aria-label=\"Toggle navigation\"></button>
            ";
            }
            // line 111
            yield "          ";
            if (($context["container_navbar"] ?? null)) {
                // line 112
                yield "          </div>
          ";
            }
            // line 114
            yield "        </nav>
      ";
        }
        // line 116
        yield "      
    ";
        return; yield '';
    }

    // line 127
    public function block_featured($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 128
        yield "        <div class=\"featured-top\">
          <aside class=\"featured-top__inner section ";
        // line 129
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 129, $this->source), "html", null, true);
        yield " clearfix\" role=\"complementary\">
            ";
        // line 130
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "featured_top", [], "any", false, false, true, 130), 130, $this->source), "html", null, true);
        yield "
          </aside>
        </div>
      ";
        return; yield '';
    }

    // line 136
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 137
        yield "        ";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumb", [], "any", false, false, true, 137), 137, $this->source), "html", null, true);
        yield "
        <div id=\"main\" class=\"";
        // line 138
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 138, $this->source), "html", null, true);
        yield "\">          
          <div class=\"row row-offcanvas row-offcanvas-left clearfix\">
              <main";
        // line 140
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content_attributes"] ?? null), 140, $this->source), "html", null, true);
        yield ">
                <section class=\"section\">
                  <a href=\"#main-content\" id=\"main-content\" tabindex=\"-1\"></a>
                  ";
        // line 143
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 143), 143, $this->source), "html", null, true);
        yield "
                </section>
              </main>
            ";
        // line 146
        if (($context["sidebar_first_exists"] ?? null)) {
            // line 147
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_first_attributes"] ?? null), 147, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 149
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_first", [], "any", false, false, true, 149), 149, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 153
        yield "            ";
        if (($context["sidebar_second_exists"] ?? null)) {
            // line 154
            yield "              <div";
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["sidebar_second_attributes"] ?? null), 154, $this->source), "html", null, true);
            yield ">
                <aside class=\"section\" role=\"complementary\">
                  ";
            // line 156
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "sidebar_second", [], "any", false, false, true, 156), 156, $this->source), "html", null, true);
            yield "
                </aside>
              </div>
            ";
        }
        // line 160
        yield "          </div>
        </div>
      ";
        return; yield '';
    }

    // line 174
    public function block_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 175
        yield "        <div class=\"";
        yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["container"] ?? null), 175, $this->source), "html", null, true);
        yield "\">
          ";
        // line 176
        if ((((CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 176) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 176)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 176)) || CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fourth", [], "any", false, false, true, 176))) {
            // line 177
            yield "            <div class=\"site-footer__top clearfix\">
              ";
            // line 178
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_first", [], "any", false, false, true, 178), 178, $this->source), "html", null, true);
            yield "
              ";
            // line 179
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_second", [], "any", false, false, true, 179), 179, $this->source), "html", null, true);
            yield "
              ";
            // line 180
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_third", [], "any", false, false, true, 180), 180, $this->source), "html", null, true);
            yield "
              ";
            // line 181
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fourth", [], "any", false, false, true, 181), 181, $this->source), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 184
        yield "          ";
        if (CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fifth", [], "any", false, false, true, 184)) {
            // line 185
            yield "            <div class=\"site-footer__bottom\">
              ";
            // line 186
            yield $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer_fifth", [], "any", false, false, true, 186), 186, $this->source), "html", null, true);
            yield "
            </div>
          ";
        }
        // line 189
        yield "        </div>
      ";
        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "themes/custom/custom_theme/templates/layout/page.html.twig";
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
        return array (  359 => 189,  353 => 186,  350 => 185,  347 => 184,  341 => 181,  337 => 180,  333 => 179,  329 => 178,  326 => 177,  324 => 176,  319 => 175,  315 => 174,  308 => 160,  301 => 156,  295 => 154,  292 => 153,  285 => 149,  279 => 147,  277 => 146,  271 => 143,  265 => 140,  260 => 138,  255 => 137,  251 => 136,  242 => 130,  238 => 129,  235 => 128,  231 => 127,  225 => 116,  221 => 114,  217 => 112,  214 => 111,  210 => 109,  207 => 108,  203 => 106,  199 => 104,  197 => 103,  192 => 102,  186 => 99,  183 => 98,  181 => 97,  176 => 96,  169 => 91,  167 => 90,  163 => 89,  155 => 85,  153 => 84,  148 => 83,  144 => 81,  142 => 80,  137 => 79,  134 => 78,  130 => 77,  121 => 191,  119 => 174,  116 => 173,  109 => 169,  105 => 168,  101 => 167,  97 => 166,  94 => 165,  92 => 164,  89 => 163,  87 => 136,  84 => 135,  81 => 134,  78 => 127,  75 => 126,  68 => 122,  64 => 121,  61 => 120,  59 => 119,  56 => 118,  54 => 77,  48 => 73,  46 => 72,  44 => 71,);
    }

    public function getSourceContext()
    {
        return new Source("", "themes/custom/custom_theme/templates/layout/page.html.twig", "/var/www/html/web/themes/custom/custom_theme/templates/layout/page.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 71, "block" => 77, "if" => 119);
        static $filters = array("trim" => 71, "striptags" => 71, "render" => 71, "escape" => 121);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'block', 'if'],
                ['trim', 'striptags', 'render', 'escape'],
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
