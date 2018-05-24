<?php
	echo '"Entrando no método\n"';
    require("../util/pagarme-php/lib/PagarMe.php");


	echo '"Puxou da biblioteca as paradas do pagarme."'+'\n';


	$pagarMe = new \PagarMe\Sdk\PagarMe("ak_test_b07TskPkITgpLchCWhuzXWicKTuKJR");
	
	$card = $pagarMe->card()->createFromHash($_POST['token']);

	$customer = $pagarMe->customer()->create(
		'John Dove',
		'john@site.com',
		'09130141095',
		/** @var $address \PagarMe\Sdk\Customer\Address */
		new Address(),
		/** @var $phone \PagarMe\Sdk\Customer\Phone */
		new Phone(),
		'15021994',
		'M'
	);

	$transaction = $pagarMe->transaction()->creditCardTransaction(
	    $_POST['value'],
        $card,
		$customer
    );

    $status = $transaction->postbackUrl;

    if( strcasecmp($status, 'refused') == 0 ){
        echo '"Pagamento recusado. Tente outro cartão."';
    }
    else{
        echo '"Pagamento aprovado. Em breve o produto estará em suas mãos."';
    }
