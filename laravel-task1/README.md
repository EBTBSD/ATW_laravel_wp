# Projekt telepítés és feladat

## Követelmények

A program futtatásához az alábbi környezet szükséges:

- **PHP:** 8.4  
- **Node.js:** v24.13.0  
- **Composer:** 2.9.4  

---

## Telepítés

1. Függőségek telepítése:

composer install  
npm install  

2. Alkalmazás kulcs generálása:

php artisan key:generate  

3. Adatbázis migrációk futtatása seedeléssel:

php artisan migrate:refresh --seed  

---

## Feladat

1. A `Log` modellben hozz létre egy új mezőt:

- update_count (integer)

2. Készíts egy API végpontot, amely:

- domain alapján megkeresi a megfelelő Log rekordot  
- frissíti annak update_count értékét (például +1)

3. A update_count mező értékét jelenítsd meg a kezdőoldalon.
