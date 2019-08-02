<div id="calendrier-component">
    <div class="calendrier-naviguation siema">
    </div>
    <button id="newYear">chekit</button>

    <a onclick="penis.goTo(6-1)">mars 2019</a>
    <a ">mars 2019</a>
</div>
<!--<script src="public/js/moment.js"></script>-->
<script src="public/js/moment-with-locales.js"></script>
<script src="public/js/calendar.js"></script>
<script src="public/js/siema.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        // Handler when the DOM is fully loaded
        console.log($());
        let calendar=new Calendar(<?= $calendar ?>);
        let newYear = document.getElementById('newYear');
        let penis=new Siema();

        newYear.addEventListener('click',function(e){
            console.log('penis');
            var xhr = new XMLHttpRequest();
            xhr.open('GET',`/MemTaches?year=2020`, true);

            xhr.onload = function () {
                console.log(this.response);
                let newYear = new Calendar(JSON.parse(this.response),"yes");
            };

            xhr.send(null);
// xhr.send('string');
// xhr.send(new Blob());
// xhr.send(new Int8Array());
// xhr.send(document);
        });
        let cellDay= document.querySelector('.siema');

        cellDay.addEventListener('dblclick',function(e){
            if(e.target.nodeName === "TD"){
                console.log(e.target.dataset.date);
            }
        })

        function daysInMonth(iMonth, iYear)
        {
            return 32 - new Date(iYear, iMonth, 32).getDate();
        }
        let firstDay = new Date(2019, 7,14,);
        let options = {weekday:"long",day:"2-digit",month:"long",year:"numeric",timeZoneName:"short"};

        console.log(new Intl.DateTimeFormat('fr-FR',options).format(firstDay));
        let fDate= new Intl.DateTimeFormat('fr-FR',options).format(new Date());
        console.log(fDate);
        console.log(daysInMonth(7,2019));
        console.log(moment("03-12-2019","DD-MM-YYYY"));
    });


</script>