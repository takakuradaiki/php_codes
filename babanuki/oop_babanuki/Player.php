<?php

namespace BabaNuki;

require_once('BabaNukiHand.php');


abstract class Player
{
    private BabaNukiHand $hand;
    private int $targetPlayerCnt;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new BabaNukiHand();
        $this->targetPlayerCnt = 0;
    }

    /**
     * 相手からカードを引く処理
     * (抽象メソッド)
     *
     * @param
     * @return
     */
    // abstract public function 相手からカードを引く処理
    abstract public function takeHand(array $allPlayer);

    public function getTargetPlayerCnt()
    {
        return $this->targetPlayerCnt;
    }
    public function setTargetPlayerCnt($value)
    {
        $this->targetPlayerCnt = $value;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getHand(): array
    {
        return $this->hand->getHand();
    }
    public function addHand(BabaNukiCard $card)
    {
        $this->hand->addHand($card);
    }
    public function unsetHand($key)
    {
        $this->hand->unsetHand($key);
    }
    public function putCard($tookCard)
    {
        $this->hand->putCard($tookCard);
    }
    public function arrangeHand()
    {
        $this->hand->arrangeHand();
    }
    public function takeCard($answer)
    {
        return $this->hand->takeCard($answer);
    }
    public function handRemoveDuplicate(Player $player)
    {
        for ($i = 0; $i < count($player->getHand()); $i++) {
            $oneCard = $player->getHand()[$i];
            if ($oneCard->getNumber() === '削除') {
                continue;
            }
            for ($j = $i + 1; $j < count($player->getHand()); $j++) {
                $targetCard = $player->getHand()[$j];
                if ($oneCard->getNumber() === $targetCard->getNumber()) {
                    $oneCard->setNumber('削除');
                    $targetCard->setNumber('削除');
                    break;
                }
            }
        }

        $val = '削除';
        foreach ($player->getHand() as $key => $value) {
            if ($value->getNumber() === $val) {
                $player->unsetHand($key);
            }
        }
        $player->arrangeHand();
    }
}
