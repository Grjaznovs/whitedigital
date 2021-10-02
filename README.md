<h1>Usage</h1>
<br/>
Tiek lietots root GET (kas ir aprakstīts routes/web.php), kur mainigo number un lang ievadīšana ir obligāts nosacījums. <br/>
Ja jebkurš no mainigiem netiks ievadīts, nostrādās iekšejais laravel nosacījums, kas atbilst REST API protokolam "404 NOT FOUND". <br/>
Gadījumā, ja tiks ievadīts neatbilstošs numurs vai valoda (numuram ir jābūt no 0 līdz 9999, valodai ir jabūt lat vai eng), nostrādās REST API protokols "400 Bad Request", <br/>
kas ir aprakstīts app/Http/Controller/WhitedigitalController.php

<br/><br/>
http://localhost/475/lat<br/>
http://localhost/234/eng