<?php

    //ISBN13⇒10の変換

    echo ISBNTran(9784534047120) . "<br />";

    //ISBN10⇒13の変換

    echo ISBNTran("477414259X");

    function ISBNTran ($ISBN) {

        if (strlen($ISBN) == 10) {

            //ISBN10からISBN13への変換

            $ISBNtmp = "978" . $ISBN;

            $sum = 0;

            for ($i = 0; $i < 12; $i++) {

                $weight = ($i % 2 == 0 ? 1 : 3);

                $sum += (int)substr($ISBNtmp, $i, 1) * (int)$weight;

            }

            //チェックディジットの計算

            $checkDgt = (10 - $sum % 10) == 10 ? 0 : (10 - $sum % 10);

            return "978" . substr($ISBN, 0, 9) . $checkDgt;

        } elseif (strlen($ISBN) == 13) {

            //ISBN13からISBN10への変換

            $ISBNtmp = substr($ISBN, 3, 9);

            $weight = 10;

            $sum = 0;

            for ($i = 0; $i < 9; $i++) {

                $sum += (int)substr($ISBNtmp, $i, 1) * $weight;

                $weight--;

            }

            //チェックディジットの計算

            if ((11 - $sum % 11) == 11) {

                $checkDgt = 0;

            } elseif ((11 - $sum % 11) == 10) {

                $checkDgt = "X";

            } else {

                $checkDgt = (11 - $sum % 11);

            }

            return substr($ISBN, 3, 9) . $checkDgt;

        }

    }

?>
