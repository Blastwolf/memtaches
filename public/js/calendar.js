
class Calendar{


    constructor(calendar,addYear){
        let calendrierCarousel = document.querySelector('.calendrier-naviguation');
        console.log(calendar);
        this.calendar = calendar;
        this.weekNumber=1;
        this.weekNumberDiff=-1;

        for(let month in this.calendar){
            let year = this.calendar[month][0].split('-')[2];

            console.log(month);
            let calendrierMois = document.createElement('div');
            calendrierMois.classList.add(`calendrier-${month}-${year}`);
            calendrierMois.setAttribute('href',`#${month}-${year}`);
            calendrierMois.innerHTML = `<h1 class="month">${month}-${year}</h1>
            <table class="calendar-table">
                <thead>
                <tr>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Dimanche</th>
                </tr>
                </thead>
                <tbody class="calendar-table-body-${month}-${year}">

                </tbody>
            </table>
        </div>`;

            if(addYear =="yes"){
                penis.append(calendrierMois);
            }else{
                calendrierCarousel.appendChild(calendrierMois);
            }
            let weekDays = ["lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"];
            let tbody= document.querySelector(`.calendar-table-body-${month}-${year}`);

            let firstDay= this.calendar[month][0].split('-')[0];
            let weekDayIndex = 0;
            let tr = document.createElement("tr");

            this.calendar[month].forEach((e,i)=> {
                this.weekNumberDiff++;
                let day = e.split('-')[0];
                let number = e.split('-')[1];


                while (firstDay !== weekDays[weekDayIndex]) {

                        let td = document.createElement("td");
                        td.textContent = '';
                        tr.appendChild(td);
                        weekDayIndex++;
                }

                let td = document.createElement("td");
                td.dataset.date = `${day}-${number}-${month}-${year}`;

                console.log('ma bite',"i =",i+1,"week diff = ",this.weekNumberDiff);

                td.innerHTML = `<span class="day-number">${number}</span>`;
                if(this.weekNumber === 1 || this.weekNumberDiff%7===0){
                    console.log('efzzef', this.weekNumberDiff);
                    td.innerHTML +=`<span class="week-number">W-${this.weekNumber}</span>`;
                    this.weekNumber++;
                }
                tr.appendChild(td);

                if (day === weekDays[6]) {

                    tbody.appendChild(tr);

                    tr = document.createElement("tr");

                } else if (i === this.calendar[month].length -1) {
                    tbody.appendChild(tr);

                }
            });

    }

        function appenNewYear(){

        }

}
}
