## Sirma ICS API SDK

*Requires  PHP 7.0+*
* * *
**Set up:**

> Run composer install to include the required components.

> Create or update your .env file to include the following key variables:
> > > >     SIRMAICS_API_URL - which should point to the Sirma ICS API('https://ics-api.ics365.com')
> > > >     SIRMAICS_API_USERNAME - the username used to authenticate for Sirma ICS API
> > > >     SIRMAICS_API_PASSWORD - the password used to authenticate for Sirma ICS API
> > > >     SIRMAICS_API_CERT_PATH - path to the SSL certificate file provided for authorization to the API
> > > >     SIRMAICS_API_KEY_PATH - - path to the SSL key file provided for authorization to the API

* * *
**Usage:**
    Initiate the class you need to use for your purpose as listed:
+ class **NomenclaturesRequests** will return the API nomenclatures, required parameters for every request are specified in the documentation:
   - for locations: [here](https://ics-api.ics365.com/help#locations)
   - for object properties: [here](https://ics-api.ics365.com/help#objects)
   - for other types: [here](https://ics-api.ics365.com/help#owner)
- class **ShortRequests** is used for calculation or issuing using less parameters(used for already registered vehicles), required parameters for every request are specified in the documentation:
    - the required parameters for calculation using endpoint shortCalc: [here](https://ics-api.ics365.com/help#liability_calc_short)
     - the required parameters for issuing a policy using endpoint shortIssue (listed in the part for  /liability/policy-short): [here](https://ics-api.ics365.com/help#liability_issue_short)
     - the required parameters for issuing a policy and payment for first installment using endpoint shortIssueWithPayment: [here](https://ics-api.ics365.com/help#liability_issue_equal_short)

+ class **LongRequests** is used for calculation or issuing using full information, required parameters for every request are specified in the documentation:
    -  the required parameters for calculation using endpoint longCalc: [here](https://ics-api.ics365.com/help#liability_calc)
    - the required parameters for issuing a policy using endpoint longIssue (listed in the part for  /liability/policy-short): [here](https://ics-api.ics365.com/help#liability_issue)
    - the required parameters for issuing a policy and payment for first installment using endpoint longIssueWithPayment: [here](https://ics-api.ics365.com/help#liability_issue_equal)


+ class **PolicyRequests** requests for already registered policies, required parameters for every request are specified the documentation:
    - endpoint policyNote issues a payment for a policy with specified installment number, the required parameters are listed: [here](https://ics-api.ics365.com/help#note)
    - endpoint policyFullInfo give full information about a policy, the required parameters are listed: [here](https://ics-api.ics365.com/help#note-get)
    - endpoint policyPrint returns a pdf format for an issued policy and it's additional prints by given hash, the required parameters are listed: [here](https://ics-api.ics365.com/help#print)

Use the package by requiring it:
```composer require sirma-ics/ics-api-sdk```

Sample usage of the package would be:
```php 
$api         = new NomenclaturesRequest();
$countries   = $api->getCountries();
```

For more information and access to the API, please write to support@sirmaics.com