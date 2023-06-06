<img src="https://www.dpsg-paderborn.de/wp-content/themes/dpsg_pb_2021/screenshot.png" height="200" style="float: right; margin: 10px;">

# DPSG nxt (dpsg-nxt)
WordPress Theme für die [DPSG im Diözesanverband Paderborn](https://www.dpsg-paderborn.de/) von Björn Stromberg, Lucas G und anderen deren Namen nicht genannt werden wollten.

Dieses Theme, ausgenommen die Fonts, unterliegt der **GPLv3**. Das bedeutet ...
1. Du darfst diese Software kopieren, verändern, forken, ausdrucken, verbreiten, nutzen ...
2. Die "license.txt" muss immer Bestandteil des Paketes bleiben, auch wenn du du dinge änderst
3. Ein privater und auch der kommerzielle Einsatz sind uneingeschränkt erlaubt
4. Änderungen und Ergänzungen MÜSSEN ebenfalls unter der GPLv3 zugänglich gemacht werden
5. Diese Software wird vollkommen ohne Gewährleistung bereitgestellt
6. Der Software-Autor bzw. -Lizenzgeber kann nicht für durch die Software verursachte Schäden haftbar gemacht werden

Das war es auch schon. Mach einfach was du möchtest 🙂 und schick uns deine Fehlerbehebungen, Änderungen, Issues, Tippfehler und so weiter.

##Features
- Komplett Responsiv und Touch-Kompatibel (auch mit verschachtelten Menüs)
- WordPress 6.2.2+
    - Unterstützt alle WP Default Blocks (v6.2.2)
    - Unterstützt zudem das Accordeon-Element
- Eingebauter einfacher Slider
    - Featured Beiträge der Kategorie "Slider" mit deren Beitragsbild, Überschrift und Inhaltsvorschau
- Enthält passende Templates für das [Scoutnet-Kalender](https://github.com/weed-/scoutnet-kalender) Plugin
- Enthält Anpasungen für
    - Plugin: Contact Form 7
    - Plugin: Scoutnet Kalender
    - Plugin: NextGEN Gallery
    - Plugin: Sendy Widget Pro
    - Plugin: wpShopGermany
    - Plugin: Accordion-Element
    - Plugin: Draw Attention
- Enthält lokale Fonts, DSGVO-Gerecht selbstgehostet
    - [Myriad Pro Regular free](https://fontsgeek.com/fonts/Myriad-Pro-Regular)
    - [Roboto](https://fonts.google.com/specimen/Roboto)
    - [Arvo](https://fonts.google.com/specimen/Arvo)
- Enthält [DPSG Wegzeichen](https://dpsg.de/de/vorlagen)
- Kann verschachtelte Menüs mit "Überschriften" darstellen

## Dokumentation

**Menüs**
- Insgesamt gibt es zwei oder drei Menüs. Mindestens zwei, nicht mehr als drei
    - Wenn nur zwei genutzt werden sollen, das "Teil 3" Menü einfach leer lassen
- Das "Hauptmenü" ist dabei in die drei Teilmenüs (Teil 1-3) aufgeteilt
- Hinzufügen/Entfernen von Seiten/Beiträgen/Links funktioniert ganz normal unter Dashboard>Design>Menüs
- Damit es gut aussieht müssen alle drei Menüs belegt sein
- Das Menü zeigt Einträge bis zu einer Tiefe von drei an
- Zusätzlich wird bis zu einer Tiefe von 2 das Hauptmenü im Footer angezeigt
- Außerdem finden sich die Einträge im Footer unter „Quicklinks“ wieder.

*Achtung*: Die Teilmenüs dürfen jeweils nur ein oberstes Element besitzen. Das bildet nämlich dann die Überschrift. Alle weiteren Menüpunkte müssen diesem untergeordnet werden. Unter dem obersten Menüelement eines Teilmenüs werden noch zwei weitere Ebenen unterstützt.

Der Footer (footer_menu) unterstützt keine Unterpunkte, sondern nur eine Liste an Einträgen. Es findet sich immer rechts unten auf der Seite. In diesem Menü kann man zum Beispiel die rechtlich relevanten Seiten und der Login verlinkt werden.

**Sidebar Navigation**
Das Navigations-Menü der Sidebar baut sich selbst in Echtzeit aus der Seitenstruktur ("Eltern"). Unterpunkte können einfach durch die Änderung der Eltern hinzugefügt oder verschben werden.

tbd: Die Doku ist noch sehr kurz. Fehlt etwas wesentliches? Her mit dem Pull Request.
