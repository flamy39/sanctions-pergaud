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
use Twig\TemplateWrapper;

/* errors/500.html.twig */
class __TwigTemplate_7cfa980a5368d00f7849d1a950a6d329 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("base.html.twig", "errors/500.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_title(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        yield "Erreur 500 - Erreur Interne du Serveur";
        yield from [];
    }

    // line 5
    /**
     * @return iterable<null|scalar|\Stringable>
     */
    public function block_body(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 6
        yield "<div class=\"container mx-auto px-4 py-8\">
    <div class=\"bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4\">
        <h1 class=\"text-3xl font-bold mb-6 text-red-600\">Erreur 500 - Erreur Interne du Serveur</h1>
        
        <p class=\"mb-4 text-gray-700\">Nous sommes désolés, mais une erreur inattendue s'est produite sur notre serveur.</p>
        
        <p class=\"mb-4 text-gray-700\">Notre équipe technique a été informée et travaille à résoudre le problème.</p>
        
        ";
        // line 14
        if ((array_key_exists("error", $context) && CoreExtension::getAttribute($this->env, $this->source, ($context["app"] ?? null), "debug", [], "any", false, false, false, 14))) {
            // line 15
            yield "            <div class=\"mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded\">
                <h2 class=\"text-xl font-bold mb-2\">Détails de l'erreur (visible uniquement en mode debug) :</h2>
                <pre class=\"whitespace-pre-wrap\">";
            // line 17
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["error"] ?? null), "html", null, true);
            yield "</pre>
            </div>
        ";
        }
        // line 20
        yield "        
        <div class=\"mt-6\">
            <a href=\"/\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\">
                Retour à la page d'accueil
            </a>
        </div>
    </div>
</div>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "errors/500.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  92 => 20,  86 => 17,  82 => 15,  80 => 14,  70 => 6,  63 => 5,  52 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Erreur 500 - Erreur Interne du Serveur{% endblock %}

{% block body %}
<div class=\"container mx-auto px-4 py-8\">
    <div class=\"bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4\">
        <h1 class=\"text-3xl font-bold mb-6 text-red-600\">Erreur 500 - Erreur Interne du Serveur</h1>
        
        <p class=\"mb-4 text-gray-700\">Nous sommes désolés, mais une erreur inattendue s'est produite sur notre serveur.</p>
        
        <p class=\"mb-4 text-gray-700\">Notre équipe technique a été informée et travaille à résoudre le problème.</p>
        
        {% if error is defined and app.debug %}
            <div class=\"mt-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded\">
                <h2 class=\"text-xl font-bold mb-2\">Détails de l'erreur (visible uniquement en mode debug) :</h2>
                <pre class=\"whitespace-pre-wrap\">{{ error }}</pre>
            </div>
        {% endif %}
        
        <div class=\"mt-6\">
            <a href=\"/\" class=\"bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline\">
                Retour à la page d'accueil
            </a>
        </div>
    </div>
</div>
{% endblock %}", "errors/500.html.twig", "C:\\Developpement\\Pergaud\\Projets 2024\\Cursor\\suivi-sanctions-pergaud\\templates\\errors\\500.html.twig");
    }
}
