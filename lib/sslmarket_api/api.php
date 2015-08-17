<?php

/**
 * ORDER PARAMETERS:
 *
 * customer_id (mandatory) = your SSLmarket account number
 *
 *
 * password (mandatory) = your password to SSLmarket account
 *
 *
 * method (mandatory) = method used for ordering
 *      new = make a new SSL certificate order
 *      renew = make an order to renew an expiring certificate
 *
 *
 * domain (mandatory) = domain name you want to secure
 *
 *
 * years (mandatory) = certificate validity (in years)
 *
 *      1-3 for certificate THAWTE_SSL_123
 *      1-3 for certificate THAWTE_WEB_SERVER
 *      1-2 for certificate THAWTE_WEB_SERVER_EV
 *      1-2 for certificate THAWTE_WEB_SERVER_WILDCARD
 *      1-3 for certificate THAWTE_SGC_SUPERCERTS
 *      1-2 for certificate THAWTE_CODE_SIGNING
 *      1-3 for certificate SYMANTEC_SECURE_SITE
 *      1-3 for certificate SYMANTEC_SECURE_SITE_PRO
 *      1-2 for certificate SYMANTEC_SECURE_SITE_EV
 *      1-2 for certificate SYMANTEC_SECURE_SITE_PRO_EV
 *      1-3 for certificate SYMANTEC_SECURE_SITE_WILDCARD
 *      1-3 for certificate SYMANTEC_CODE_SIGNING
 *      1-3 for certificate GEOTRUST_QUICKSSL_PREMIUM
 *      1-3 for certificate GEOTRUST_TRUE_BUSINESSID
 *      1-2 for certificate GEOTRUST_TRUE_BUSINESSID_EV
 *      1-3 for certificate GEOTRUST_TRUE_BUSINESSID_WILDCARD
 *      1-3 for certificate RAPIDSSL_RAPIDSSL
 *      1-3 for certificate RAPIDSSL_RAPIDSSL_WILDCARD
 *      1 for certificate RAPIDSSL_FREESSL
 *
 *
 * certificate (mandatory) = certificate product code
 *
 *      THAWTE_SSL_123
 *      THAWTE_WEB_SERVER
 *      THAWTE_WEB_SERVER_EV
 *      THAWTE_WEB_SERVER_WILDCARD
 *      THAWTE_SGC_SUPERCERTS
 *      THAWTE_CODE_SIGNING
 *      SYMANTEC_SECURE_SITE
 *      SYMANTEC_SECURE_SITE_PRO
 *      SYMANTEC_SECURE_SITE_EV
 *      SYMANTEC_SECURE_SITE_PRO_EV
 *      SYMANTEC_CODE_SIGNING
 *      GEOTRUST_QUICKSSL_PREMIUM
 *      GEOTRUST_TRUE_BUSINESSID
 *      GEOTRUST_TRUE_BUSINESSID_EV
 *      GEOTRUST_TRUE_BUSINESSID_WILDCARD
 *      RAPIDSSL_RAPIDSSL
 *      RAPIDSSL_RAPIDSSL_WILDCARD
 *      SYMANTEC_SECURE_SITE_WILDCARD
 *      RAPIDSSL_FREESSL
 *
 *
 * sans_count (mandatory for SAN certificates only)
 *      = number of SANs
 *
 *      0-24 for certificate THAWTE_WEB_SERVER
 *      0-24 for certificate THAWTE_WEB_SERVER_EV
 *      0-24 for certificate THAWTE_SGC_SUPERCERTS
 *      0-24 for certificate SYMANTEC_SECURE_SITE
 *      0-24 for certificate SYMANTEC_SECURE_SITE_PR
 *      0-24 for certificate SYMANTEC_SECURE_SITE_EV
 *      0-24 for certificate SYMANTEC_SECURE_SITE_PRO_EV
 *      0, 4 for certificate GEOTRUST_QUICKSSL_PREMIUM
 *      0, 4-100 for certificate GEOTRUST_TRUE_BUSINESSID
 *      0, 4-100 for certificate GEOTRUST_TRUE_BUSINESSID_EV
 *
 *
 * sans (mandatory for SAN certificates only)
 *      = list of SANs divided by commas
 *
 *
 * hash_algorithm (not mandatory) = hash algorithm in CA's signature
 *      SHA2-256    (default)
 *      SHA-1       (currently deprecated)
 *
 *
 * use_zoner_server (not mandatory) = is your server hosted by ZONER (CZECHIA.COM, Zonercloud.com)?
 *      0 (default, server is not hosted by ZONER)
 *      1 (server is hosted by ZONER)
 *
 *
 * csr (not mandatory) = CSR (Certificate Signing Request) in Base64 encoding
 *
 *
 * dv_auth_method (mandatory for DV certificates only)
 *      = verification of rights to manipulate the domain and to apply for an SSL certificate
 *      Email   (verification via e-mail sent to mailbox determined by parameter "verify_mailbox")
 *      DNS     (verification via unique text string in DNS zone)
 *      FILE    (verification via unique file uploaded to server via FTP)
 *
 *      Alternative vetting is supported by following certificates:
 *      THAWTE_SSL_123
 *      RAPIDSSL_RAPIDSSL
 *      RAPIDSSL_RAPIDSSL_WILDCARD
 *      RAPIDSSL_FREESSL
 *      GEOTRUST_QUICKSSL_PREMIUM
 *
 *
 * verify_mailbox (not mandatory) = choose the mailbox where the approver e-mail is sent
 *      WHOIS           (default, SSLmarket will try to obtain domain owner's e-mail from WHOIS)
 *      admin@          (approver e-mail will be: admin@my-domain.com)
 *      administrator@  (approver e-mail will be: administrator@my-domain.com)
 *      hostmaster@     (approver e-mail will be: hostmaster@my-domain.com)
 *      webmaster@      (approver e-mail will be: webmaster@my-domain.com)
 *      postmaster@     (approver e-mail will be: postmaster@my-domain.com)
 *
 *
 * voucher (not mandatory) = discount voucher code
 *
 *
 * note (not mandatory) = order notes
 *      If notes are sent with the order, then the order will be on hold for manual processing.
 *
 *
 * test (not mandatory) = start of debug mode TODO:(any value)
 *      Order will not be saved in SSLmarket, but API will check the order and return a result.
 *      You will see if your order (and its price) is correct or not.
 *
 *      Example of returned parameters:
 *          amount - price of the order without VAT
 *          vat = VAT in the order /100
 *              1 = without DPH
 *              1.1 = 10 %
 *              1.21 = 21 %
 *
 *
 * owner_name (mandatory) = name of the certificate owner
 *
 *
 * owner_street (mandatory) = street of the certificate owner
 *
 *
 * owner_city (mandatory) = city of the certificate owner
 *
 *
 * owner_zip (mandatory) = ZIP code of the certificate owner address
 *
 *
 * owner_country (mandatory) = two-letter country code (for example DE, CZ, RU)
 *      (ISO 3166-1 alpha-2)
 *
 *
 * auth_firstname (mandatory) = first name of the person requesting the certificate
 *
 *
 * auth_lastname (mandatory) = last name of the person requesting the certificate
 *
 *
 * auth_tel (mandatory) = telephone number of the person requesting the certificate
 *
 *
 * auth_email (mandatory) = e-mail address of the person requesting the certificate
 *
 *
 * tech_firstname (mandatory) = first name of the tech-c (tech-c will receive the certificate)
 *
 *
 * tech_lastname (mandatory) = last name of the tech-c
 *
 *
 * tech_tel (mandatory) = telephone number of the tech-c
 *
 *
 * tech_email (mandatory) = e-mail address of the tech-c
 *
 *
 * invoice_name (mandatory) = invoice name of company buying the certificate
 *
 *
 * invoice_street (mandatory) = address of company buying the certificate
 *
 *
 * invoice_city (mandatory) = city of company buying the certificate
 *
 *
 * invoice_zip (mandatory) = ZIP code of company buying the certificate
 *
 *
 * invoice_country (mandatory) = two letter country code of company buying the certificate
 *      (ISO 3166-1 alpha-2)
 *
 *
 * invoice_business_id (not mandatory) = business registration number of company buying the certificate
 *
 *
 * invoice_vat_id (not mandatory) = VAT number of company buying the certificate
 *
 *
 * RETURN VALUES
 *
 * API reply is in JSON format.
 *
 * Parameters:
 *
 * ack = the result of a query
 *      Success (query was accepted)
 *      Error   (query was not correct, see "errors")
 *
 * errors = array with errors, returned if "ack" is equal to "Error"
 * data = array of data, returned only if parameter "test" is set to true
 *
 */
/*
  EXAMPLE OF DATA ARRAY:

  $data = array(
      'customer_id' => $your_customer_id,
      'password' => $your_password,
      'method' => 'new',
      'domain' => 'www.my-domain.com',
      'years' => 3,
      'certificate' => 'RAPIDSSL_RAPIDSSL',
      'use_zoner_server' => 0,
      'owner_name' => 'Owner name',
      'owner_street' => 'Street',
      'owner_city' => 'City',
      'owner_zip' => '12345',
      'owner_country' => 'CZ',
      'owner_tel' => '+420.123456789',
      'hash_algorithm' => 'SHA2-256',
      'auth_firstname' => 'Auth name',
      'auth_lastname' => 'Auth surname',
      'auth_tel' => '+420.123456789',
      'auth_email' => 'your-email@my-domain.com',
      'tech_firstname' => 'Tech name',
      'tech_lastname' => 'Tech surname',
      'tech_tel' => '+420.123456789',
      'tech_email' => 'your-email@my-domain.com',
      'invoice_name' => 'Invoice name',
      'invoice_street' => 'Street',
      'invoice_city' => 'City',
      'invoice_zip' => '12345',
      'invoice_country' => 'CZ',
      'invoice_email' => 'your-email@my-domain.com',
      'dv_auth_method' => 'Email',
      'verify_mailbox' => 'admin@',
      'test' => true,
      'note' => 'SSLmarket API - test'
  );
 */

function apiQuery($data)
{
    $post = http_build_query($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://www.sslmarket.cz/api');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . "/ca-bundle.pem");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($curl);
    if (curl_error($curl)) {
        return false;
    }

    return json_decode($result, true);
}