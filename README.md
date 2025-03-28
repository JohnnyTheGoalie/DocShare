# DocShare


# Sistem pregleda dokumenata na plenumima
Jednostavan, open-source, besplatan sistem napravljen na ETFu. Svi studenti mogu da pristupe kodu. Dizajniran za korišćenje na svim fakultetima.

## Tehničko izvođenje
+ Jednostavno postavljanje sistema
+ Mogućnost korišćenja na bilo kom fakultetu
+ Jednostavno logovanje svih studenata (dovoljno je skenirati QR i čitati)
+ Mogućnost self-hostinga na Apache-u, pa otvaranja porta 80 ili tunellovanja (jednostavnije rešenje, i bezbedno je)
+ Zaštita adminskih stranica
+ Mogućnost uploadovanja .docx, .pdf, ili plaintext

## Izgled za studente
Kada se skenira QR kod otvara se stranica, gde studenti mogu čitati tekst.

![image](https://github.com/user-attachments/assets/6409e330-7c60-41e3-853b-e55f9fb7fb75)

## Izgled za administratore

Ovde se uploaduju dokumenti

![image](https://github.com/user-attachments/assets/2636f3c1-dcee-406e-a58f-3ceb6a64c03b)

## Proces instalacije (jebiga iscimajte se 5min ima 4 koraka)
Pri izboru hostinga imate više opcija, da platite hosting, da se otvori port na ruteru, ili da se tunneluje preko nekog od online servisa. Ovde ćemo koristiti https://localhost.run/ , ali možete koristiti šta god hoćete.

1. Preuzeti i instalirati XAMPP (https://www.apachefriends.org/download.html)

![image](https://github.com/user-attachments/assets/8f1946e3-b1c0-4b8f-a039-00cbd70d7431)

2. Upakovati ovih 5 .php fajlova u folder gde je instaliran XAMPP (po defaultu C:\xampp\htdocs)

![image](https://github.com/user-attachments/assets/6483e419-4aaa-4754-8086-73680181cba4)

3. Upaliti Apache i MYSQL

![image](https://github.com/user-attachments/assets/fdcd3fb3-0ab6-4739-a51b-655d9ee77277)

4. Zatim treba napraviti da server bude javan. Otvoriti PowerShell, i ukucati komandu:

ssh -R 80:localhost:80 nokey@localhost.run

(Server se gasi sa ctrl+c)

TO JE TO

## Security
Promeniti username i password u fajlu admin.php

![image](https://github.com/user-attachments/assets/d2b319a6-dae7-4b05-ba05-7735f91a914b)
