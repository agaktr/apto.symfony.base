<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements GlobalsInterface
{
    public function getFilters(): array
    {
        return [
            // the logic of this filter is now implemented in a different class
            new TwigFilter('extractEntityNameByPath', [AppRuntime::class, 'extractEntityNameByPath']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pagination', [AppRuntime::class, 'pagination'],[
                'is_safe' => ['html'],
            ]),
            new TwigFunction('compress', [AppRuntime::class, 'compress']),
        ];
    }

    public function getGlobals(): array
    {
        return [
//            'GLOBAL_NAME' => 'new AppService()',
        ];
    }
}