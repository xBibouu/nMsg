<?php

namespace xBibouMsg;

use pocketmine\plugin\PluginBase;
use xBibouMsg\Command\MsgCommand;

class Main extends PluginBase
{
    protected function onEnable(): void
    {
        $this->getServer()->getCommandMap()->unregister($this->getServer()->getCommandMap()->getCommand("msg"));
        $this->getServer()->getCommandMap()->register("",new MsgCommand());
    }
}
