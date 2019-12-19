<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"><img src="public/images/logo-tsd.png"></p>

<h1>Urenregistratie TDS</h1>

**Over dit project.**
<p>dit is een project dat geschreven is in opdracht van een klant. de klant heeft gevraagt om een urenregistratie te maken voor intern gebruik.</p>

**<p>Progressie van de webapplicatie</p>**
<p>70%</p>

**Inhoud**
<ul>
    <li>Installatie</li>
    <li>Gebruik maken van de WebApplicatie.</li>
    <li>To do's</li>
    <li>bug fixes</li>
</ul>

<h2>installatie</h2>

<p>Voor de installatie van de webapplicatie zijn een paar Software onderdelen nodig.</p>

<h3>Benodigtheden</h3>
<ul>
    <li><a href="https://www.php.net/">PHP 7.3 of hoger</a></li>
    <li><a href="https://getcomposer.org/">Composer LTS</a></li>
    <li><a href="https://nodejs.org/en/">Node JS LTS</a></li>
    <li><a href="https://www.laravel.com/">Laravel 6.2</a></li>
    <li><a href="https://www.mysql.com/">Een database met voorkeur van mysql LTS.</a></li>
</ul>
<p>Installatie</p>
<p>Voor het installeren van de webapplicatie clone je eerst de applicatie naar een locale plaats op de server.</p>
<p>Ga naar de map waar de het project wilt plaatsen in de terminal of commandprompt.</p>
<p>voer daar het volgende commando uit.</p>

    git clone git@git.newdeveloper.nl:mtamming3212/urenregistratie.git
<p>Als alle bestanden op de gewenste bestemming staan voer dan het volgende commando's uit.</p> 
    
    composer install
    
    npm install
    
 <p>Als de commando's uitgevoerd zijn pas dan de ".env" aan die in de root van de project map staat. bestaat dit bestand niet maak dan de duplicaat van ".env.example" en hernoem dat bestand ".env"</p>
 <p>pas daar de volgende regels aan naar de inlog gegevens van de database.</p>
    
    DB_CONNECTION=mysql
    DB_HOST="database ip"
    DB_PORT="database port"
    DB_DATABASE=urenregistratie
    DB_USERNAME="username"
    DB_PASSWORD="password"
 
 <p>voor daarna dit commando uit.</p>
 
    php artisan migrate
    
 <p>voer daarna het volgende commando uit</p>
 
    php artisan serv
    
 
<h3>Gebruik</h3>

<p>
het gebruiken van de applicatie is simpel. 
en normale gebruiker kan alleen via de /home pagina verlof aanvragen en kijken wat zijn of haar taak is voor vandaag. 
De gebruiker kan ook zien in welk team de gebruiker zit. Alleen administratie kan aanpassingen doen aan de gebruiker en kan uren inplannen van de gebruiker.
</p>

<p>De werknemers en de administratie zijn van elkaar gescheiden. De administratie kan uren inplannen voor de werknemers.</p>

<h3>To Do's</h3>

<p>Administratie systeem scheiden van het normale systeem.</p>
<p>User Manager.</p>
<p>Uren bijhouden.</p>

<h3>Bug fixes</h3>

<p>Taak Systeem</p>
<p>Grafiek data ophalen</p>
