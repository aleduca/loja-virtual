<?php

namespace App\Classes;

use App\Classes\Frete;
use App\Classes\PagseguroCurl;
use App\Interfaces\InterfacePayment;
use App\Repositories\Site\ProdutosCarrinhoRepository;

class Pagseguro implements InterfacePayment {
	
	private function productsAndFrete(){
		
		$produtosCarrinho = new ProdutosCarrinhoRepository;
        $produtosNoCarrinho = $produtosCarrinho->produtosNoCarrinho();
		
		$frete = new Frete;
        array_push($produtosNoCarrinho, $frete->formatFreteToObject());
        return $produtosNoCarrinho;
	}

	private function config($data){

      $dadosUser = $data[0];

      $pagseguroData = [];
      $pagseguroData['email'] = 'xandecar@hotmail.com';
      $pagseguroData['token'] = 'FF579CC8863549A783664FDC85657678';
      $pagseguroData['reference'] = $data['idReferencia'];
      $pagseguroData['currency'] = 'BRL';
      $pagseguroData['senderName'] = $dadosUser->name.' '.$dadosUser->sobrenome;
      $pagseguroData['senderAreaCode'] = $dadosUser->ddd;
      $pagseguroData['senderPhone'] = $dadosUser->telefone;
      $pagseguroData['senderEmail'] = $dadosUser->email;
      $pagseguroData['shippingType'] = 3;
      $pagseguroData['shippingAddressStreet'] = $dadosUser->endereco;
      $pagseguroData['shippingAddressNumber'] = 64;
      $pagseguroData['shippingAddressComplement'] = 'Complemento';
      $pagseguroData['shippingAddressDistrict'] = $dadosUser->bairro;
      $pagseguroData['shippingAddressPostalCode'] = $dadosUser->cep;
      $pagseguroData['shippingAddressCity'] = $dadosUser->cidade;
      $pagseguroData['shippingAddressState'] = strtoupper($dadosUser->estado);
      $pagseguroData['shippingAddressCountry'] = 'BRA';

      $i = 1;
		foreach($this->productsAndFrete() as $item){
				$pagseguroData['itemId'.$i] = $item['produtos']->id;
				$pagseguroData['itemDescription'.$i] = $item['produtos']->produto_nome;
				$pagseguroData['itemAmount'.$i] = number_format($item['valor'],2,'.','');
				$pagseguroData['itemQuantity'.$i] = $item['qtd'];
                $i++;
		}

        $query = http_build_query($pagseguroData);
        $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/?email=xandecar@hotmail.com&token=FF579CC8863549A783664FDC85657678';

        return (new PagseguroCurl)->get($url,$query);
	}

	public function dataAndPayment(array $data){
		return $this->config($data);
	}

}