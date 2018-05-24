<?php
	echo '"Entrando no método\n"';
    require("../util/vendor/autoload.php");


	echo '"Puxou da biblioteca as paradas do pagarme."'+'\n';


	$pagarMe = new \PagarMe\Sdk\PagarMe("ak_test_b07TskPkITgpLchCWhuzXWicKTuKJR");

	$card = $pagarMe->card()->createFromHash($_POST['token']);

	$address = new \PagarMe\Sdk\Customer\Address([
		'street' => 'xxx',
		'streetNumber' => 'xx',
		'neighborhood' => 'Cruzeiro Novo',
		'zipcode' => '70658-498',
		'complementary' => 'jlkj',
		'city' => 'Brasília',
		'state' => 'Distrito Federal',
		'country' => 'Brasil',
	]);

	$phone = new \PagarMe\Sdk\Customer\Phone(['ddd' => '47', 'number' => '99999999', 'ddi' => '55']);

	$customer = $pagarMe->customer()->create(
		'John Dove',
		'john@site.com',
		'11337226521',
		$address,
		$phone,
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
