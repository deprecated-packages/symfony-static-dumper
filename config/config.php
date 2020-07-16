<?php declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symplify\PackageBuilder\Console\Style\SymfonyStyleFactory;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure()
        ->public();

    $services->load('Symplify\SymfonyStaticDumper\\', __DIR__ . '/../src')
        ->exclude([
            __DIR__ . '/../src/Exception/*',
        ]);

    $services->set(FinderSanitizer::class);

    $services->set(SymfonyStyleFactory::class);

    $services->set(SymfonyStyle::class)
        ->factory([ref(SymfonyStyleFactory::class), 'create']);
};
