<?php

namespace xBibouMsg\Command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\Server;

class MsgCommand extends Command
{
    public function __construct()
    {
        parent::__construct("msg","Envoyer un message privé à un joueur","msg");
        $this->setPermission(DefaultPermissions::ROOT_USER);
    }
    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if($sender instanceof Player){
            if(isset($args[0])){
                $target = $this->getPlayerAuto($args[0]);
                $message = implode(" ", array_slice($args, 1));
                if($target instanceof Player){
                    $target->sendMessage("§6[{$sender->getName()} -> Vous] §e: §6$message");
                    $sender->sendMessage("§6[Vous -> {$target->getName()}] §e: §6$message");
                    foreach(Server::getInstance()->getOnlinePlayers() as $admin){
                        if($admin->hasPermission("nephelia.admin")) {
                            $admin->sendMessage("§6Message envoyé de §e{$sender->getName()}§6 pour §e{$target->getName()}§e :§6 $message");
                        }
                    }
                }else{
                    $sender->sendMessage("§cJoueur non trouvé");
                }

            }
        }
    }public function getPlayerAuto(string $name) : ?Player{
    $found = null;
    $name = strtolower($name);
    $delta = PHP_INT_MAX;
    foreach(Server::getInstance()->getOnlinePlayers() as $player){
        if(stripos($player->getName(), $name) === 0){
            $curDelta = strlen($player->getName()) - strlen($name);
            if($curDelta < $delta){
                $found = $player;
                $delta = $curDelta;
            }
            if($curDelta === 0){
                break;
            }
        }
    }

    return $found;
}
}