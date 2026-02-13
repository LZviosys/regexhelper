# RegexHelper

Ein PHP-Paket zum Testen von Daten mit Regex. 
Es können Strings, Emails, Dateinamen, URLs auf Gueltigkeit geprüft werden.
IBAN´s und Telefonnummern können maskiert werden.
Passwörter können auf Sicherheit geprueft werden.


# Installation
- Installieren sie das Paket mit: 

```bash
composer require lzwanziger/regexhelper
````

# Funktionen
use Lz\Regexhelper\RegexHelper;

- E-Mail prüfen (gibt true oder false zurück)
  - RegexHelper::validateEmail($email);

- Passwort-Sicherheit (Gibt true zurück, wenn alle Kriterien erfüllt sind)

  - RegexHelper::passwordSecurityCheck($password);

- Dateinamen prüfen (erlaubt a-z, 0-9, Bindestrich und Punkt)
  - RegexHelper::validateFilename($filename);

- URL prüfen
  - RegexHelper::validateUrl($url);

- Prüfen ob wieso ein Passwort nicht sicher ist
  - $errors = RegexHelper::getPasswordsErrors($password);
  - echo $errors; // Ausgabe koennte etwa: "Passwort muss mindestens 8 Zeichen lang sein."

- String bereinigen
  - RegexHelper::sanitizeString($string); 

- Telefonnummer maskieren
  - RegexHelper::maskPhoneNumber($phoneNumber);

- IBAN maskieren
  - RegexHelper::maskIban($iban);



# Unit Tests
- Unit Tests ausführen mit:

````bash
./vendor/bin/phpunit tests
````

