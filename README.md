# SmsSendingBundle

SmsSendingBundle is a Symfony 3.4 bundle for tunisiesms Api .

## config.yml

Use this line in config.yml file.

```yml
sms_sending:
    sms_key: '%sms_Key%'
    sneder: '%sender%"
    mobile: '%mobile%'
```

## parameters.yml

```yml
sms_key: [YOUR_SMSKEY]
sender: [YOUR_SENDER_NAME]
```
## composer.json
```
"autoload": {
        "psr-4": {
            "DotIt\\SmsSendingBundle\\": "[bundle source]",
            ......
        },
```
## AppKernel.php
```
$bundles = [
           .. ,
           .. ,
           new DotIt\SmsSendingBundle\SmsSendingBundle(),
        ];
```
## Command
```
in terminal execute these command

$ composer dump-autoload

**** For update database table and add bundle new table *****  
$ ./bin/console doctrine:schema:update --force


``` 
## Usage
```
//**** Sending Multiples SMS *******

SmsSendingManager::sendMultipleSms($phoneNumbers,$message,$date);

//$phoneNumber array of phoneNumber example: ["21622xxxxxx","21698xxxxxx"]
//$date default null take date of today 

//*** Resend faild sms in Campaign ******
SmsSendingManager::resendCampaign($id)

// $id: id if faild campaign 

```

## License
[DOTIT](http://www.dotit-corp.com/)