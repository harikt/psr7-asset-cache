<?php
namespace Hkt\Psr7AssetCache;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'console' => [
                'commands' => [
                    CacheCommand::class
                ],
            ]
        ];
    }

    public function getDependencies()
    {
        return [
            'factories' => [
                CacheCommand::class => CacheCommandFactory::class,
            ],
        ];
    }
}
