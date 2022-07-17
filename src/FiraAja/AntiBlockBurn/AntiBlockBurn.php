<?php

namespace FiraAja\AntiBlockBurn;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\block\BlockBurnEvent;
use pocketmine\utils\Config;

class AntiBlockBurn extends PluginBase implements Listener {
	
	/** @var Config */
	private Config $getConfig;
	
	public function onEnable(): void {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	}
	
	public function onBurn(BlockBurnEvent $event){
		$player = $event->getPlayer();
		if(empty($this->getConfig()->get("antiburn-worlds", []))){
			$event->cancel();
		}else{
			foreach($this->getConfig()->getAll() as $key){
				$from = $player->getWorld()->getFolderName();
				if($key == $from){
					$event->cancel();
				}
			}
		}
	}
}