<?php

namespace App\Twig;

use Symfony\Bundle\TwigBundle\DependencyInjection\TwigExtension;
use Twig\Environment;
use Twig\Extension\RuntimeExtensionInterface;

class AppRuntime implements RuntimeExtensionInterface
{

    private Environment $twig;
    private string $environment;

    public function __construct(Environment $twig,string $environment)
    {
        $this->twig = $twig;
        $this->environment = $environment;
    }

    public function extractEntityNameByPath(string $name): string
    {

        return explode('/', $name)[0];
    }

    public function pagination($collection): string
    {

        return $this->twig->render('theme/pagination/pagination.html.twig', [
            'collection' => $collection,
        ]);
    }

    public function compress($content): string
    {

        return 'test';
    }
}