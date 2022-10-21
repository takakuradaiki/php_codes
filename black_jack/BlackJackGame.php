<?php

namespace BlackJack;

require_once('BlackJackDeck.php');
require_once('BlackJackHandEvaluator.php');

class BlackJackGame
{
    /** ディーラーがカードを引くのやめる値 */
    private const DEALER_DRAW_STOP = 17;

    /** 引き分け */
    private const DRAW = 'Draw';
    /** ハンドエバリュエーター */
    private BlackJackHandEvaluator $handEvaluator;
    /** デッキ */
    private BlackJackDeck $deck;
    /** プレイヤー */
    private BlackJackPlayer $player;
    /** ディーラー */
    private array $dealers;


    /**
     * コンストラクタ
     *
     * @param array $dealers ディーラー
     * @param Player $player プレイヤー
     */
    public function __construct(array $dealers, Player $player)
    {
        // 手札判定クラスを生成する
        $this->handEvaluator = new BlackJackHandEvaluator();
        // デッキを生成する
        $this->deck = new BlackJackDeck();
        $this->player = $player;
        $this->dealers = $dealers;
    }

    /**
     * ブラックジャックメインゲーム
     *
     * @return void
     */
    public function start(): void
    {
        echo 'ブラックジャックを開始します。' . PHP_EOL;
        echo '' . PHP_EOL;

        //手札を引く
        $this->init($this->player);
        foreach ($this->dealers as $key => $value) {
            $this->init($value);
        }

        //プレイヤーターン
        $this->playerTurn();
        foreach ($this->dealers as $key => $value) {
            //ディーラーターン
            $this->dealerTurn($value);
        }

        foreach ($this->dealers as $key => $value) {
            //勝者を決めるメソッドを呼び出す
            $this->matchPlayerVsDealer($this->player, $value);
        }

        echo '' . PHP_EOL;
        echo 'ブラックジャックを終了します。' . PHP_EOL;
    }

    /**
     * 手札を２枚引く
     *
     * @param Player $player
     * @return void
     */
    private function init(Player $player): void
    {
        for ($i = 0; $i < 2; $i++) {
            $initDrawCard = $player->drawCard($this->deck);
            echo $initDrawCard;
        }
    }

    /**
     * プレイヤーターンの動作
     *
     * @return void
     */
    private function playerTurn(): void
    {
        $playerName = $this->player->getName();
        while (true) {
            // プレイヤーの得点を表示して、カードを引くかを選択させる
            echo $playerName . 'の現在の得点は' . $this->player->getHandScore() . 'です。カードを引きますか？(Y/N)' . PHP_EOL;
            $answer = trim(fgets(STDIN));
            if ($answer === 'Y') {
                $playerDrawCard = $this->player->drawCard($this->deck);
                echo $playerDrawCard;
                // カードを引いて手札のスコアが22以上になったら処理が終了する
                if ($this->handEvaluator->isBust($this->player->getHandScore())) {
                    break;
                }
            } elseif ($answer === 'N') {
                break;
            } else {
                echo 'Y か N を選択して入力してください。' . PHP_EOL;
            }
        }
    }

    /**
     * ディーラーのターンの動作
     *
     * @param Player $dealer
     * @return void
     */
    private function dealerTurn(Player $dealer): void
    {
        //手札の得点を取得して表示する
        $dealerName = $dealer->getName();
        $dealerBackCard = $dealer->getHand()[1];
        $dealerName . 'の引いたカードは' . $dealerBackCard->getSuit() . 'の' . $dealerBackCard->getNumber() . 'でした。' . PHP_EOL;
        echo $dealerName . 'の現在の得点は' . $dealer->getHandScore() . 'です。' . PHP_EOL;

        while (true) {
            //得点が17より低かったらカードを引く
            if ($dealer->getHandScore() < self::DEALER_DRAW_STOP) {
                $dealerDrawCard = $dealer->drawCard($this->deck);
                echo $dealerDrawCard;
                echo $dealerName . '現在の得点は' . $dealer->getHandScore()
                    . 'です。' . PHP_EOL;
            } else {
                break;
            }
        }
    }

    /**
     * 勝者を取得して表示する
     * プレイヤーとディーラーの名前と得点を表示する
     * getWinnerメソッドを呼び出して勝者を判定する
     * @param $player プレイヤー
     * @param $dealer ディーラー
     */
    /**
     * fix
     * Undocumented function
     *
     * @param Player $player
     * @param Player $dealer
     * @return void
     */
    private function matchPlayerVsDealer(Player $player, Player $dealer): void
    {
        $playerName = $player->getName();
        $dealerName = $dealer->getName();
        echo $playerName . 'の得点は' . $player->getHandScore() . 'です。' . PHP_EOL;
        echo $dealerName . 'の得点は' . $dealer->getHandScore() . 'です。' . PHP_EOL;
        $winner = $this->handEvaluator->getWinner($dealer, $player);
        if ($winner === self::DRAW) {
            echo '引き分けです。' . PHP_EOL;
        } else {
            echo $winner . 'の勝ちです。' . PHP_EOL;
        }
    }
}
