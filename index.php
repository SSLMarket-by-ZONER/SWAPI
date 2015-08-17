<?php
// register class autoloading http://php.net/manual/en/function.spl-autoload-register.php
spl_autoload_register(function ($class) {
    include 'lib/' . $class . '.class.php';
});

// let's define some "screen" vars used in html part for print
$default_params = null;
$localization = null;
$success = null;
$error_name = null;
$error_list = array();
$debug_data = array();


// get config
if (file_exists("config.php")) {
    $default_params = include "config.php";
} else {
    $default_params = include "config.dist.php";
}

// load localization
$file = 'localization/' . $default_params['gui_language'] . '.php';

if (file_exists($file)) {
    $localization = include $file;
} else {
    $localization = include "localization/en.php";
}

// check submit action
if (!empty($_POST['data'])) {

    // merge data from forms with data which are not displayed in gui
    $data = $_POST['data'];
    $data['customer_id'] = $default_params['customer_id'];
    $data['password'] = $default_params['password'];

    if ($default_params['test'] === true) {
        $data['test'] = true;
        $data['note'] = '[SWAPI demo app test] ' . $data['note'];
    }

    $swapi = new Swapi($data);

    try {

        $success = $swapi->sendOrder();
    } catch (SwapiException $swe) {
        $error_name = $swe->getMessage();
        $error_list = $swe->getErrorList();
    } catch (Exception $e) {
        $error_name = $e->getMessage();
    }

    if ($default_params['test'] === true) {
        $debug_data = $swapi->getDebugData();
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>SSLMarket - SWAPI demo</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="js/jquery-ui/jquery-ui.min.css" />
        <link rel="stylesheet" href="css/screen.css" />

        <script type="text/javascript" src="js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/sslform.js"></script>

    </head>
    <body>
        <div class="wrapper">

            <?php if ($default_params['test'] === true) { ?>
                <div class="info debug">
                    <?= $localization['debug_mode']; ?>              
                </div>
            <?php } ?>

            <?php if ($success) { ?>
                <div class="info">
                    <?= $localization['success']; ?>              
                </div>
            <?php } ?>

            <?php if (!empty($error_name)) { ?>
                <div class="info error">
                    <h2><?= $localization['error'] . ": " . (!empty($localization[$error_name]) ? $localization[$error_name] : $error_name); ?></h2>
                    <?php
                    if (!empty($error_list)) {
                        echo "<ul>";
                        foreach ($error_list as $e) {
                            echo "<li>" . (!empty($localization[$e]) ? $localization[$e] : $e) . "</li>";
                        }
                        echo "</ul>";
                    }
                    ?>
                </div>
            <?php } ?>

            <div id="tabs">
                <form method="post" action="index.php" >
                    <ul>
                        <li><a href="#order">1. <?= $localization['certificate_selection']; ?></a></li>
                        <li><a href="#org">2. <?= $localization['owner']; ?></a></li>
                        <li><a href="#admin">3. <?= $localization['admin_c']; ?></a></li>
                        <li><a href="#tech">4. <?= $localization['tech_c']; ?></a></li>
                        <li><a href="#bill">5. <?= $localization['bill_c']; ?></a></li>
                    </ul>
                    <div id="order">
                        <table>
                            <tr>
                                <td><?= $localization['domain']; ?></td><td><input type="text" name="data[domain]" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['order_type']; ?></td>
                                <td>
                                    <input type="radio" name="data[method]" value="new" checked="checked" /><?= $localization['new_order']; ?>
                                    <input type="radio" name="data[method]" value="renew" /><?= $localization['renew']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['certificate']; ?></td>
                                <td><select name="data[certificate]">
                                        <option value="THAWTE_SSL_123">THAWTE_SSL_123</option>
                                        <option value="THAWTE_WEB_SERVER">THAWTE_WEB_SERVER</option>
                                        <option value="THAWTE_WEB_SERVER_EV">THAWTE_WEB_SERVER_EV</option>
                                        <option value="THAWTE_WEB_SERVER_WILDCARD">THAWTE_WEB_SERVER_WILDCARD</option>
                                        <option value="THAWTE_SGC_SUPERCERTS">THAWTE_SGC_SUPERCERTS</option>
                                        <option value="THAWTE_CODE_SIGNING">THAWTE_CODE_SIGNING</option>
                                        <option value="SYMANTEC_SECURE_SITE">SYMANTEC_SECURE_SITE</option>
                                        <option value="SYMANTEC_SECURE_SITE_PRO">SYMANTEC_SECURE_SITE_PRO</option>
                                        <option value="SYMANTEC_SECURE_SITE_EV">SYMANTEC_SECURE_SITE_EV</option>
                                        <option value="SYMANTEC_SECURE_SITE_PRO_EV">SYMANTEC_SECURE_SITE_PRO_EV</option>
                                        <option value="SYMANTEC_CODE_SIGNING">SYMANTEC_CODE_SIGNING</option>
                                        <option value="GEOTRUST_QUICKSSL_PREMIUM">GEOTRUST_QUICKSSL_PREMIUM</option>
                                        <option value="GEOTRUST_TRUE_BUSINESSID">GEOTRUST_TRUE_BUSINESSID</option>
                                        <option value="GEOTRUST_TRUE_BUSINESSID_EV">GEOTRUST_TRUE_BUSINESSID_EV</option>
                                        <option value="GEOTRUST_TRUE_BUSINESSID_WILDCARD">GEOTRUST_TRUE_BUSINESSID_WILDCARD</option>
                                        <option value="RAPIDSSL_RAPIDSSL">RAPIDSSL_RAPIDSSL</option>
                                        <option value="RAPIDSSL_RAPIDSSL_WILDCARD">RAPIDSSL_RAPIDSSL_WILDCARD</option>
                                        <option value="SYMANTEC_SECURE_SITE_WILDCARD">SYMANTEC_SECURE_SITE_WILDCARD</option>
                                        <option value="RAPIDSSL_FREESSL">RAPIDSSL_FREESSL</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['order_period']; ?></td>
                                <td>
                                    <select name="data[years]">
                                        <option value="1">1 <?= $localization['year']; ?></option>
                                        <option value="2">2 <?= $localization['years']; ?></option>
                                        <option value="3">3 <?= $localization['years']; ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['san_count']; ?></td><td><input type="text" name="data[sans_count]" /></td>
                            </tr>
                            <tr>
                                <td><?= $localization['san_domains']; ?></td><td><input type="text" name="data[sans]" /></td>
                            </tr>
                            <tr>
                                <td><?= $localization['hash_algorithm']; ?></td>
                                <td>
                                    <select name="data[hash_algorithm]">
                                        <option value="SHA2-256">SHA2-256</option>
                                        <option value="SHA-1">SHA-1</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['hosted_by_zoner']; ?></td>
                                <td>
                                    <input type="radio" name="data[use_zoner_server]" value="1" /><?= $localization['yes']; ?>
                                    <input type="radio" name="data[use_zoner_server]" value="0" checked="checked" /><?= $localization['no']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['auth_method']; ?></td>
                                <td>
                                    <select name="data[dv_auth_method]">
                                        <option value="Email"><?= $localization['email']; ?></option>
                                        <option value="DNS"><?= $localization['dns_record']; ?></option>
                                        <option value="FILE"><?= $localization['file']; ?></option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['verification_email']; ?></td>
                                <td>
                                    <select name="data[verify_mailbox]">
                                        <option value="WHOIS"><?= $localization['from_whois']; ?></option>
                                        <option value="admin@">admin@</option>
                                        <option value="administrator@">administrator@</option>
                                        <option value="hostmaster@">hostmaster@</option>
                                        <option value="webmaster@">webmaster@</option>
                                        <option value="postmaster@">postmaster@</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>CSR</td>
                                <td>
                                    <textarea name="data[csr]" class="csr"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['order_note']; ?></td>
                                <td>
                                    <textarea name="data[note]" class="note"><?= $default_params['note'] ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td><?= $localization['voucher']; ?></td><td><input type="text" name="data[voucher]" value="<?= $default_params['voucher'] ?>"/></td>
                            </tr>
                        </table>
                    </div>
                    <div id="org">
                        <table
                            <tr>
                                <td><?= $localization['org_name']; ?></td><td><input type="text" name="data[owner_name]" value="<?= $default_params['owner_name'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['street']; ?></td><td><input type="text" name="data[owner_street]" value="<?= $default_params['owner_street'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['city']; ?></td><td><input type="text" name="data[owner_city]" value="<?= $default_params['owner_city'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['zip']; ?></td><td><input type="text" name="data[owner_zip]" value="<?= $default_params['owner_zip'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['country']; ?> (<a href="http://<?= $lang; ?>.wikipedia.org/wiki/ISO_3166-1" target="_blank">ISO&nbsp;3166-1&nbsp;alpha-2</a>)</td><td><input type="text" name="data[owner_country]" value="<?= $default_params['owner_country'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['phone']; ?>&nbsp;(+420.123456789)</td><td><input type="text" name="data[owner_tel]"  value="<?= $default_params['owner_tel'] ?>" required="required"/>*</td>
                            </tr>
                        </table>
                    </div>
                    <div id="admin">
                        <table>
                            <tr>
                                <td><?= $localization['name']; ?></td><td><input type="text" name="data[auth_firstname]"  value="<?= $default_params['auth_firstname'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['surname']; ?></td><td><input type="text" name="data[auth_lastname]" value="<?= $default_params['auth_lastname'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['phone']; ?>&nbsp;(+420.123456789)</td><td><input type="text" name="data[auth_tel]" value="<?= $default_params['auth_tel'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['email']; ?></td><td><input type="text" name="data[auth_email]" value="<?= $default_params['auth_email'] ?>" required="required"/>*</td>
                            </tr>
                        </table>
                    </div>
                    <div id="tech">
                        <table>
                            <tr>
                                <td><?= $localization['name']; ?></td><td><input type="text" name="data[tech_firstname]" value="<?= $default_params['tech_firstname'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['surname']; ?></td><td><input type="text" name="data[tech_lastname]" value="<?= $default_params['tech_lastname'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['phone']; ?></td><td><input type="text" name="data[tech_tel]" value="<?= $default_params['tech_tel'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['email']; ?></td><td><input type="text" name="data[tech_email]" value="<?= $default_params['tech_email'] ?>" required="required"/>*</td>
                            </tr>
                        </table>
                    </div>
                    <div id="bill">
                        <table>
                            <tr>
                                <td><?= $localization['org_name']; ?></td><td><input type="text" name="data[invoice_name]" value="<?= $default_params['invoice_name'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['street']; ?></td><td><input type="text" name="data[invoice_street]" value="<?= $default_params['invoice_street'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['city']; ?></td><td><input type="text" name="data[invoice_city]" value="<?= $default_params['invoice_city'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['zip']; ?></td><td><input type="text" name="data[invoice_zip]" value="<?= $default_params['invoice_zip'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['country']; ?>&nbsp;(<a href="http://<?= $lang; ?>.wikipedia.org/wiki/ISO_3166-1" target="_blank">ISO&nbsp;3166-1&nbsp;alpha-2</a>)</td><td><input type="text" name="data[invoice_country]" value="<?= $default_params['invoice_country'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['email']; ?></td><td><input type="text" name="data[invoice_email]" value="<?= $default_params['invoice_email'] ?>" required="required"/>*</td>
                            </tr>
                            <tr>
                                <td><?= $localization['business_id']; ?></td><td><input type="text" name="data[invoice_business_id]" value="<?= $default_params['invoice_business_id'] ?>" /></td>
                            </tr>
                            <tr>
                                <td><?= $localization['vat_id']; ?></td><td><input type="text" name="data[invoice_vat_id]" value="<?= $default_params['invoice_vat_id'] ?>" /></td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <button id="prev" ><?= $localization['previous']; ?></button>
                        <button id="next" ><?= $localization['next']; ?></button>
                        <button id="submit" title="<?= $localization['required_input_empty']; ?>" disabled="disabled"><?= $localization['submit_order']; ?></button>
                    </div>
                </form>
            </div>
            <?php
            // if debug mode is on & debug data is not empty, print them
            if ($default_params['test'] === true && !empty($debug_data)) {
                echo "<pre>";

                foreach ($debug_data as $key => $value) {
                    echo "\n" . $key . "\n";
                    var_dump($value);
                }

                echo "</pre>";
            }
            ?>
        </div>
    </body>
</html>

