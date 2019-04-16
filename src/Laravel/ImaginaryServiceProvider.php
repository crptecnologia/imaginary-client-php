<?php

namespace CrpTecnologia\ImaginaryClient\Laravel;

use CrpTecnologia\ImaginaryClient\DefaultConfiguration;
use CrpTecnologia\ImaginaryClient\FileSystemInterface;
use CrpTecnologia\ImaginaryClient\Imaginary;
use CrpTecnologia\ImaginaryClient\Pipeline\PipelineFactory;
use CrpTecnologia\ImaginaryClient\Pipeline\PipelineFactoryInterface;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequest;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequestInterface;
use CrpTecnologia\ImaginaryClient\Pipeline\Request\PipelineRequestStrategyFactory;
use CrpTecnologia\ImaginaryClient\SourceFactory;
use CrpTecnologia\ImaginaryClient\SourceFactoryInterface;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Psr\Log\LoggerInterface;

class ImaginaryServiceProvider extends ServiceProvider
{
    public const CONFIG = __DIR__ . '/imaginary.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG => config_path('imaginary.php'),
        ], 'config');

    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG,
            'imaginary'
        );

        $this->app->singleton(
            FileSystemInterface::class,
            LaravelFileSystem::class
        );

        $this->app->singleton(
            SourceFactoryInterface::class,
            SourceFactory::class
        );

        $this->app->singleton(DefaultConfiguration::class, function () {
            return new DefaultConfiguration(
                config('imaginary.strip_meta'),
                config('imaginary.type'),
                config('imaginary.extend')
            );
        });

        $this->app->singleton(PipelineRequestInterface::class, function () {
            return new PipelineRequest(
                new Client(['base_uri' => config('imaginary.host')]),
                app(LoggerInterface::class),
                app(PipelineRequestStrategyFactory::class)
            );
        });

        $this->app->singleton(
            PipelineFactoryInterface::class,
            PipelineFactory::class
        );

        $this->app->singleton(
            Imaginary::class,
            Imaginary::class
        );
    }
}
