<?php

    //ISBN13��10�̕ϊ�

    echo ISBNTran(9784534047120) . "<br />";

    //ISBN10��13�̕ϊ�

    echo ISBNTran("477414259X");

    function ISBNTran ($ISBN) {

        if (strlen($ISBN) == 10) {

            //ISBN10����ISBN13�ւ̕ϊ�

            $ISBNtmp = "978" . $ISBN;

            $sum = 0;

            for ($i = 0; $i < 12; $i++) {

                $weight = ($i % 2 == 0 ? 1 : 3);

                $sum += (int)substr($ISBNtmp, $i, 1) * (int)$weight;

            }

            //�`�F�b�N�f�B�W�b�g�̌v�Z

            $checkDgt = (10 - $sum % 10) == 10 ? 0 : (10 - $sum % 10);

            return "978" . substr($ISBN, 0, 9) . $checkDgt;

        } elseif (strlen($ISBN) == 13) {

            //ISBN13����ISBN10�ւ̕ϊ�

            $ISBNtmp = substr($ISBN, 3, 9);

            $weight = 10;

            $sum = 0;

            for ($i = 0; $i < 9; $i++) {

                $sum += (int)substr($ISBNtmp, $i, 1) * $weight;

                $weight--;

            }

            //�`�F�b�N�f�B�W�b�g�̌v�Z

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
