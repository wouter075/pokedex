
📚 Lesplan Week 3 – PHP & Database Integratie (± 1 uur)
🎯 Leerdoelen

Studenten begrijpen hoe ze met PHP verbinding maken met een MySQL-database.
Ze kunnen data ophalen met SQL en deze dynamisch weergeven in HTML.
Ze oefenen met het bouwen van een eenvoudige zoekfunctie.

🕒 Lesindeling
0 – 10 min: Introductie

Korte herhaling: wat staat er al in de database?
Wat gaan we doen vandaag:Verbinden met de database via PHP
Data ophalen en tonen
Een zoekfunctie bouwen


🧠 Waarom gebruiken we PDO?

PDO staat voor PHP Data Objects en is een veilige en flexibele manier om met databases te werken in PHP. Hier zijn de belangrijkste redenen waarom we PDO gebruiken:
✅ 1. Veiligheid (tegen SQL-injecties)

    PDO maakt gebruik van prepared statements, wat betekent dat gebruikersinvoer automatisch wordt "geescaped".
    Dit voorkomt SQL-injectie-aanvallen, waarbij kwaadwillenden proberen je database te manipuleren via formulieren of URL's.

✅ 2. Flexibiliteit

    PDO ondersteunt meerdere databasesystemen zoals MySQL, PostgreSQL, SQLite, enz.
    Je hoeft alleen de DSN (data source name) aan te passen als je ooit overstapt naar een ander systeem.

✅ 3. Betere foutafhandeling

    PDO kan zo ingesteld worden dat het exceptions gooit bij fouten, wat het makkelijker maakt om bugs op te sporen en af te handelen.

✅ 4. Nettere en leesbare code

    De syntax van PDO is overzichtelijk en modern, wat het makkelijker maakt om mee te werken en te onderhouden.


Zeker! Hier is een overzichtelijke vergelijkingstabel tussen **PDO** en **MySQLi** in PHP, zodat je studenten het verschil goed kunnen zien:

| **Aspect**                     | **PDO**                                                                 | **MySQLi**                                                           |
|-------------------------------|-------------------------------------------------------------------------|----------------------------------------------------------------------|
| **Volledige naam**            | PHP Data Objects                                                       | MySQL Improved                                                      |
| **Ondersteunde databases**    | ✅ Meerdere (MySQL, PostgreSQL, SQLite, etc.)                           | ❌ Alleen MySQL/MariaDB                                             |
| **Prepared statements**       | ✅ Ja, met `prepare()` en `execute()`                                   | ✅ Ja, maar iets andere syntax                                      |
| **Foutafhandeling**           | ✅ Exceptions via `PDO::ERRMODE_EXCEPTION`                              | ❌ Standaard foutmeldingen, tenzij handmatig afgevangen             |
| **Objectgeoriënteerd**        | ✅ Volledig objectgeoriënteerd                                          | ✅ Zowel objectgeoriënteerd als procedureel                         |
| **Syntax voorbeeld (query)**  | `$stmt = $pdo->query("SELECT * FROM pokemon");`                        | `$result = $mysqli->query("SELECT * FROM pokemon");`               |
| **Syntax voorbeeld (prepared)** | `$stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name = ?");`<br>`$stmt->execute([$name]);` | `$stmt = $mysqli->prepare("SELECT * FROM pokemon WHERE name = ?");`<br>`$stmt->bind_param("s", $name);`<br>`$stmt->execute();` |
| **Gebruiksgemak**             | ✅ Kortere, leesbare syntax                                              | ⚠️ Meer regels nodig voor bind_param etc.                          |
| **Aanbevolen voor nieuw werk**| ✅ Ja, veiliger en flexibeler                                           | ⚠️ Alleen als je zeker weet dat je alleen MySQL gebruikt            |

---

Wil je dat ik deze vergelijking ook als een visueel overzicht (bijv. een PDF of afbeelding) voor je maak om te delen met studenten?


10 – 25 min: Verbinden met de database
Uitleg + live coding:

Maak een bestand db.php:

```php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = 'localhost';
$db   = 'pokedex';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
```


Oefening 1:

Laat studenten dit bestand zelf aanmaken en testen met een echo "Verbinding gelukt";.

25 – 40 min: Data ophalen en tonen
Uitleg + voorbeeld:

Maak een bestand index.php dat de Pokémon toont:
```php
  <?php include 'db.php'; ?>
  <ul>
  <?php
  $stmt = $pdo->query("SELECT * FROM pokemon ORDER BY name");
  while ($row = $stmt->fetch()) {
      echo "<li>{$row['name']} ({$row['type']})</li>";
  }
  ?>
  </ul>
```
Oefening 2:

Laat studenten de lijst uitbreiden met HP, aanval en snelheid.

40 – 55 min: Zoekfunctie bouwen
Uitleg + voorbeeld:

Voeg een zoekformulier toe:
```html
  <form method="post">
      <input type="text" name="pokemon" placeholder="Zoek op naam">
      <button type="submit">Zoeken</button>
  </form>
```


Verwerk de zoekopdracht:
```php
  if (!empty($_POST['pokemon'])) {
      $name = $_POST['pokemon'];
      $stmt = $pdo->prepare("SELECT * FROM pokemon WHERE name LIKE ?");
      $stmt->execute(["%$name%"]);
  } else {
      $stmt = $pdo->query("SELECT * FROM pokemon");
  }
```

Oefening 3:

Laat studenten zoeken op naam en de resultaten tonen in een nette lijst.

55 – 60 min: Afronding

Bespreek kort wat ze geleerd hebben.
Laat ze hun code committen en pushen naar GitHub.
Huiswerk meegeven:Voeg een filter toe op type (zoals eerder besproken).
Toon de resultaten in een Bootstrap-kaartlayout.
