<?php
    /*
        * Config for PayPal specific values
    */

    //Whether Sandbox environment is being used, Keep it true for testing
    define("SANDBOX_FLAG", true);

    //PayPal REST API endpoints
    define("SANDBOX_ENDPOINT", "https://api.sandbox.paypal.com");
    define("LIVE_ENDPOINT", "https://api.paypal.com");

    //Merchant ID
    define("MERCHANT_ID","V49U2LLG448SQ");

    //PayPal REST App SANDBOX Client Id and Client Secret
    define("SANDBOX_CLIENT_ID" , "AcDDG_5LvwQpZbbawiqUdE14bxYcJS2VzHoT4SSjncHhE4ommsypeebVQIOaw7ue4xg88wV9TYU6CJSC");
    define("SANDBOX_CLIENT_SECRET", "EFhe4iTsVoDTCovuehovlcvbBpMmQtwnIMuHKuIURsFND-qGk4Nf_yTTFbup2RnVuiTkU4gccp_JERyz");

    //Environments -Sandbox and Production/Live
    define("SANDBOX_ENV", "sandbox");
    define("LIVE_ENV", "production");

    //PayPal REST App SANDBOX Client Id and Client Secret
    define("LIVE_CLIENT_ID" , "live_Client_Id");
    define("LIVE_CLIENT_SECRET" , "live_Client_Secret");

    //ButtonSource Tracker Code
    define("SBN_CODE","PP-DemoPortal-EC-IC-php-REST");

?>