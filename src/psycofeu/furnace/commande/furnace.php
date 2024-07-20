<?php

namespace psycofeu\furnace\commande;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\crafting\FurnaceType;
use pocketmine\player\Player;
use pocketmine\Server;
use psycofeu\furnace\Main;

class furnace extends Command
{
    public function __construct()
    {
        parent::__construct("furnace", Main::getInstance()->getConfig()->get("furnace_description"), "/furnace");
        $this->setPermission("furnace.use");
        $this->setPermissionMessage(Main::getInstance()->getConfig()->get("furnace_no_perm"));
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) return;
        $item = $sender->getInventory()->getItemInHand();
        $smelt = Server::getInstance()->getCraftingManager()->getFurnaceRecipeManager(FurnaceType::FURNACE)->match($item);
        if ($smelt !== null) {
            $result = $smelt->getResult();
            $sender->getInventory()->setItemInHand($result->setCount($item->getCount()));
            $sender->sendMessage(str_replace(array("{count}", "{items}"), array($item->getCount(), $result->getName()),Main::getInstance()->getConfig()->get("furnace_message")));
        }else{
            $sender->sendMessage(Main::getInstance()->getConfig()->get("no_furnace_message"));
        }
    }
}