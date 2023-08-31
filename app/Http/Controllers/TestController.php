<?php

namespace App\Http\Controllers;
use Web3\Contract;
use Web3\Web3;

use Illuminate\Http\Request;
use Web3\Utils;

class TestController extends Controller
{
   public function testing()
   {
    $web3 = new Web3("https://data-seed-prebsc-1-s1.binance.org:8545/");

// Load the contract
$contractAddress = '0x2C9aC3a5355A833f1F5c5ebb1fC2E6661C95F38e';
$contractABI = json_decode('[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"user","type":"address"},{"indexed":false,"internalType":"uint256","name":"tariff","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"amount","type":"uint256"}],"name":"DepositAt","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"tokenChangedAddress","type":"address"}],"name":"TokenAddressChaged","type":"event"},{"inputs":[],"name":"MIN_DEPOSIT_BUSD","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"busdAmount","type":"uint256"}],"name":"buyTokenWithBUSD","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"busdAmount","type":"uint256"}],"name":"buyTokenWithsitto","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"contractAddr","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"","type":"address"}],"name":"investors","outputs":[{"internalType":"bool","name":"registered","type":"bool"},{"internalType":"uint256","name":"invested","type":"uint256"},{"internalType":"uint256","name":"paidAt","type":"uint256"},{"internalType":"uint256","name":"withdrawn","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"pause","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"priceOfBNB","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"resume","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_busdAmt","type":"uint256"}],"name":"setMinBusd","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"tariffs","outputs":[{"internalType":"uint256","name":"time","type":"uint256"},{"internalType":"uint256","name":"percent","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"tokenInBNB","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"tokenInBUSD","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"tokenPrice","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"tokenPriceDecimal","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalInvested","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"_to","type":"address"}],"name":"transferOwnership","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"_tokenPrice","type":"uint256"},{"internalType":"uint256","name":"_tokenPriceDecimal","type":"uint256"}],"name":"updateTokenPrice","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address payable","name":"_to","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"withdrawalBnb","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address payable","name":"_to","type":"address"},{"internalType":"address","name":"_token","type":"address"},{"internalType":"uint256","name":"_amount","type":"uint256"}],"name":"withdrawalToAddress","outputs":[],"stateMutability":"nonpayable","type":"function"}]',true); // ABI array representing the contract's methods and events
$contract = new Contract($web3->provider, $contractABI);
$contract->at($contractAddress);

$privateKey = '1f556c094a7cab6e09ef8b443d815d5b925acf66747dca5a5526909b6d6794d6';
$recipientAddress = '0xf6103f5Bcb7A8913D77498616f98d3940cF9f700';
$amount = 2000000000;


// $transferMethod = $contract->newMethod('transfer');
// $transferMethod->addParameter($recipientAddress, 'address');
// $transferMethod->addParameter($amount, 'uint256');

// $transactionData = $transferMethod->encodeABI();

// $gasLimit = $web3->eth->estimateGas([
//     'to' => $contractAddress,
//     'data' => $transactionData,
// ]);

// $transactionData = $contract->encodeABI('transfer', [
//     $recipientAddress,
//     $amount,
// ]);

// $transactionData .= $contract->encodeABI('withdrawalToAddress',[
//     $recipientAddress,
//     '0x55a7f2DE1e9FE58bA6493132160b8fF1F1388741',
//     $amount,
// ]);

// $gasLimit = $contract->estimateGas('transfer', [
//     $recipientAddress,
//     $amount,
// ]);
// $gasLimit += $contract->estimateGas('withdrawalToAddress');

// $signedTransaction = $web3->eth->accounts->signTransaction([
//     'to' => $contractAddress,
//     'gas' => Utils::toHex($gasLimit),
//     'data' => $transactionData,
//     'value' => '0x0',
//     'nonce' => Utils::toHex($web3->eth->getTransactionCount($recipientAddress)),
// ], $privateKey);

// $transactionHash = $web3->eth->sendRawTransaction($signedTransaction->getRaw());

// echo "Transaction Hash: $transactionHash\n";

// Estimate gas fees
$accountAddress = '0xf6103f5Bcb7A8913D77498616f98d3940cF9f700';
$withdrawalAmount = $web3->utils->toWei('2', 'ether'); // Convert amount to wei if needed

$gasLimit = 300000; // Maximum gas units that can be used for the transaction
$gasPrice = '20000000000'; // Gas price in wei

$estimatedGas = $contract->estimateGas('withdrawalToAddress',[$accountAddress,'0x55a7f2DE1e9FE58bA6493132160b8fF1F1388741',$withdrawalAmount], [
    'from' => $accountAddress,
    'gas' => $gasLimit,
    'gasPrice' => $gasPrice,
],function($res){
    dd($res);
});

// Send the transaction with estimated gas fees
$contract->at($contractAddress)
    ->send('withdrawalToAddress', [$withdrawalAmount], [
        'from' => $accountAddress,
        'gas' => $estimatedGas,
        'gasPrice' => $gasPrice,
    ]);
}
}
