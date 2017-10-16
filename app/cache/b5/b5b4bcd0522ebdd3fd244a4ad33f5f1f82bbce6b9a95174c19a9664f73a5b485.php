<?php

/* search_form.html */
class __TwigTemplate_f55b9cc4bc9f9b4aaab7526d0967e2f7f4ce84abf20e083ce4790fc22bbca0ea extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("layout.html", "search_form.html", 1);
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
        echo "Find OCLC Number";
    }

    // line 4
    public function block_content($context, array $blocks = array())
    {
        // line 5
        echo "<h1>Search by OCLC Number</h1>
<form name=\"search\" action=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Slim\Views\TwigExtension')->pathFor("display_bib"), "html", null, true);
        echo "\" method=\"GET\">
<input type=\"text\" name=\"oclcnumber\" />
<input type=\"submit\" name=\"search\" value=\"Search\"/>
</form>
";
    }

    public function getTemplateName()
    {
        return "search_form.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 6,  38 => 5,  35 => 4,  29 => 3,  11 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "search_form.html", "/Users/swayh/OneDrive - Online Computer Library Center, Inc/wms_users_2017_part_2/app/views/search_form.html");
    }
}
