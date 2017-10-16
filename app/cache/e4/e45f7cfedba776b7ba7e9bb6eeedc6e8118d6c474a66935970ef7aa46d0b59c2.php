<?php

/* error.html */
class __TwigTemplate_a837e52145d3bfefe2210b556f6c7403eb36afa9fd43c70da54112cdb54b67db extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "error.html", 1);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layout.html";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
        echo "System Error";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "    <h1>System Error</h1>
    <div id=\"error_content\">
    <p id=\"status\">Status - ";
        // line 7
        echo twig_escape_filter($this->env, ($context["error"] ?? null), "html", null, true);
        echo "</p>
    ";
        // line 8
        if (($context["error_message"] ?? null)) {
            // line 9
            echo "    <p id=\"message\">Message - ";
            echo twig_escape_filter($this->env, ($context["error_message"] ?? null), "html", null, true);
            echo "</p>
    ";
        }
        // line 11
        echo "    ";
        if (($context["error_detail"] ?? null)) {
            // line 12
            echo "    <p id=\"detail\">";
            echo twig_escape_filter($this->env, ($context["error_detail"] ?? null), "html", null, true);
            echo "</p>
    ";
        }
        // line 14
        echo "    ";
        if (($context["oclcnumber"] ?? null)) {
            // line 15
            echo "    <p id=\"oclcnumber\">OCLC Number - ";
            echo twig_escape_filter($this->env, ($context["oclcnumber"] ?? null), "html", null, true);
            echo "</p>
    ";
        }
        // line 17
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "error.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 17,  66 => 15,  63 => 14,  57 => 12,  54 => 11,  48 => 9,  46 => 8,  42 => 7,  38 => 5,  35 => 4,  29 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "error.html", "/Users/swayh/OneDrive - Online Computer Library Center, Inc/wms_users_2017_part_2/app/views/error.html");
    }
}
