<?php

namespace HighLow;

abstract class Player
{
    /**
     * コンストラクタ
     *
     * @param string $name 名前
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * 名前を取得する
     *
     * @return string 名前
     */
    public function getName(): string
    {
        return $this->name;
    }
}
