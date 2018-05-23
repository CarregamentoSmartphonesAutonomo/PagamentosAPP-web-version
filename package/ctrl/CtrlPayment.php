<?php
    require("../util/pagarme-php/Pagarme.php");



    Pagarme::setApiKey("ak_test_b07TskPkITgpLchCWhuzXWicKTuKJR");
    $transaction = new PagarMe_Transaction(array(
        'amount' => ($_POST['value'] * 100),
        'card_hash' => $_POST['token']
    ));
    $transaction->charge();
    $status = $transaction->status;

    if( strcasecmp($status, 'refused') == 0 ){
        echo '"Pagamento recusado. Tente outro cartão."';
    }
    else{
        echo '"Pagamento aprovado. Em breve o produto estará em suas mãos."';
    }
