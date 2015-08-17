SWAPI - demo aplikace pro API rozhraní SSLMarket
================================================

Dostává se vám do rukou webový nástroj pro využití API SSLmarketu. Je určen pro 
zákazníky, kteří potřebují rychle zadat objednávku (v jednom kroku) a zadávají ji
často s opakovanými údaji. Tito zákazníci budou moci využít výhod API, aniž by
museli složitě programovat vlastní napojení na API SSLmarketu.

SWAPI nemá suplovat objednávkový formulář SSLmarketu a není pro to určeno. 
Hlavním rozdílem je absence kontroly vstupních dat, která probíhá u objednávky 
na SSLmarket.cz. SWAPI je určeno pro pokročilé uživatele, kteří znají parametry 
produktů a principy ověřování jednotlivých typů certifikátů (DV/OV/EV).

Prekvizity běhu SWAPI
---------------------
Pro použití webového nástroje je potřeba splnit tyto požadavky:
- PHP verze 5.2 a vyšší
- modul cURL, povolená funce 'curl_exec'
- aktivní JavaScript v aktuální verzi internetového prohlížeče (Firefox, Chrome, Internet Explorer)

Konfigurace prostředí
---------------------
Konfigurace se provádí v souboru 'config.php'. Jako šablonu můžete použít soubor 
'config.php.dist', který přejmenujte na 'config.php' a následně editujte. 
Do souboru vložte přihlašovací údaje k účtu SSL Market (user id a heslo). API dle 
uživatelského ID rozpozná, o kterou národní pobočku SSLMarketu se jedná. Dále vyplňte 
požadované výchozí údaje. Výchozí údaje mohou být ty, které nejčastěji zadáváte. 
API dle uživatelského ID rozpozná, o kterou národní pobočku SSLMarketu se jedná.
Urychlení tato možnost přináší zejména u DV certifikátů, u kterých nezáleží na tom,
jaké informace jsou zde uvedeny (informace nejsou součástí certifikátu).

Testování a ladění
------------------
Pro vaše testování je dostupný mód tzv. Debug mód. Tento aktivujete nastavení parametru 
'test' v konfiguračním souboru na hodnotu 'true'.
V prohlížeči uvidíte výsledek skriptu a odpověď našeho serveru, zdali je objednávka v pořádku. 
Při zapnutém 'debug' módu uvidíte data, která SWAPI odesílá. Do SSLmarketu se při 
aktivním Debug režimu objednávka NEUKLÁDÁ.

Pokud si nejste správností objednávky jisti, nebo ji chcete před zpracováním zkontrolovat, 
můžete v objednávce posílat textovou poznámku (parametr konfigurace 'note').
Objednávka zůstane v SSLmarketu v pozastaveném stavu a nebude automaticky pokračovat. 
Pro případné smazání takové objednávky stačí kontaktovat podporu SSLmarketu.

Bezpečnost použití
------------------
SWAPI používá pro identifikaci pouze uživatelské id a heslo zákaznického účtu SSLmarket. 
Uvědomte si, že v souboru s konfigurací jsou uloženy přihlašovací údaje k vašemu SSLMarket účtu. 
Spojení na SSLmarket je šifrováno, ale bezpečnost uložení přihlašovacích údajů je na vás.

Aplikace SWAPI urychluje proces objednávky, neřeší zabezpečení vašich přihlašovacích údajů. 
Pokud přihlašovací údaje uložíte do konfiguračního souboru, kdokoliv s možností spuštění 
aplikace má možnost provést objednávku, kdokoliv s přístupem k souboru má možnost údaje 
zobrazit a zneužít.

Přístup k webové aplikaci (ve smyslu jejího načtení přes HTTP protokol v prohlížeči) 
můžete omezit pomocí souboru .htaccess - viz příklady v souboru uvedené.

V případě potřeby se neváhejte obrátit na zákaznickou podporu SSLmarketu na adrese info@sslmarket.cz