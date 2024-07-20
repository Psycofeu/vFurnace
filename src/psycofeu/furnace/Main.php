<?php

namespace psycofeu\furnace;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use psycofeu\furnace\commande\furnace;

class Main extends PluginBase
{
    use SingletonTrait;
    protected function onLoad(): void
    {
        self::setInstance($this);
    }
    protected function onEnable(): void
    {
        $this->getServer()->getCommandMap()->register("", new furnace());
        $this->saveDefaultConfig();
    }
}