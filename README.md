# Jídelna: objednávka a rozvoz jídel

## Inštalácia
Na vyvoj aplikácie je vytvorené docker prostredie pre beh databázy MySQL
a PHP na webovom serveri Apache.

Prostredie docker nastavíme zadaním nasledujúceho príkazu v kmeňovom adresári:
```bash
$ docker-compose up 
```

Následne možeme skontrolovať či nám beží daná aplikácia a teda vo webovom prehliadači zadáme adresu
`localhost:8000`.

## Zmena inicializačného súboru databázy

Dockerfile pre kontajner MySQL kopíruje zložku s incializačnými skriptami `db/` do adresára v kontajneri 
`/docker-entrypoint-initdb.d/` a tieto skripty sa spúšťajú vždy ked sa vytvorí nový kontajner.

Pozor!!! Incializácia databáze prebieha vždy len pri vytvorení kontajneru takže treba pri vypnutí compose 
príkazu vymazať aj vypínané kontajneri.
Tieto kontajneri vymažeme nasledujúcím príkazom v kmeňovom adresári: 
```bash
$ docker-compose down --remove-orphans
```

Ak už došlo k zavolaniu príkazu `docker-compose down` vymažeme zostavajúce kontajneri nasledovne:
```bash
$ docker ps -a # vypíše nám všetky kontajneri na danom systéme
$ docker rm nazov_kontajneru_mysql nazov_kontajneru_website
$ docker image ls
$ docker rmi repository:tag 
```
Za repository dosadíme názov vytvoreného obrazu repozitáru a k nemu prisluchajúci tag. Posledný 
príkaz zavoláme pre obrazy mysql aj website prisluchajúcich k našej aplikácií. Nie je nutné mazať 
a repozitáre mysql a php pretože tie sú vzdy rovnaké.
