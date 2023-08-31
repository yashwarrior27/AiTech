var express=require('express');
var bodyParser = require('body-parser');
var app=express();
app.use(bodyParser.urlencoded({extended: true}));
app.use(bodyParser.json());
const {Web3} = require('web3');

const contractJson = require('./contract.json');
const { log } = require('console');
const contractAddress='0x09acDc19F6544F2fF3af799A60A0BE13868B8071';
const adminPrivKey = '0x'+'privatekey';

const checkUrl = "https://bsc-dataseed.binance.org/";

const web3= new Web3(checkUrl);
const [{address:admin}] = web3.eth.accounts.wallet.add(adminPrivKey);

    console.log(admin);
    const contractObj  = new web3.eth.Contract(
        contractJson,
        contractAddress
    );

app.get('/trx-details',async(req,res)=>{
try{
  let{trans_id}=req.query;
  console.log(trans_id);

    var txEthResp = await web3.eth.getTransactionReceipt(trans_id);
    console.log(txEthResp);
   if(txEthResp.status){
    var data={
    'status':true,
    'from':txEthResp.from,
    'to':txEthResp.to,
    'log':txEthResp.logs.map((log)=>{return{'address':log.address,'data':log.data}})};
    console.log(data);
    return res.json(data);
   }
   else
   {return res.json({status:false})}
  }
  catch(err)
  {
    return res.json({status:false,message:err.message});
  }
});

app.post('/withdrawal',async(req,res)=>{

  try
  {
    let {token,amount,to_address}=req.body;

    amount = amount*10**8;

    var tx = contractObj.methods.withdrawalToAddress(to_address,token,amount);
    const [gasPrice, gasCost] = await Promise.all([
            web3.eth.getGasPrice(),
            tx.estimateGas({from: admin}),
          ]);
    const data = tx.encodeABI();
          const txData = {
            from: admin,
            to: contractObj.options.address,
            data,
            gas: gasCost,
            gasPrice
          };
       return web3.eth.sendTransaction(txData)
            .on('transactionHash', function(hash){
                return res.send({success:true,message:'Data Updated.',data:hash});
            })
            .on('error', function(error){
                return res.json({success:false,message:"Something Went Wrong",data:error});
            });
          }
          catch(err)
          {
            return res.json({success:false,message:"Something Went Wrong",data:err.message});
          }
});


app.listen(3300,function(){
	console.log("server started at port 3300");
});
