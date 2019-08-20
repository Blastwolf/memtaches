class Calendar_v2 {

    constructor(date) {
        this.init(date);
    }

    init(date) {
        $('.calendar-container').html('');

        this.now = date ? moment(date) : moment();
        this.now.locale('fr', {week: {dow: 1}});
        this.year = this.now.format('YYYY');
        this.month = this.now.format('MMMM');
        this.firstDayOfMonth = this.now.clone().startOf('month');
        this.lastDayOfMonth = this.now.clone().endOf('month');
        this.numberOfDaysInMonth = this.now.daysInMonth();
        this.generateCalendarArr();
        this.outputCalendarHTML();
        AjaxRequests.getTaskInMonth(this.now.format('YYYY-MM-DD')).then((res) => {
            this.tasks = res;
            console.log('heloo',res);
            this.scanToAddTaskToCell(res);
        });
    }


    generateCalendarArr() {
        this.calendar = [];
        //Si le mois ne commence pas un lundi(weekday0) on genere les jours precedents avec weekday()
        if (this.firstDayOfMonth.weekday() !== 0) {
            for (let i = 0; i < this.firstDayOfMonth.weekday(); i++) {
                this.calendar.push(this.firstDayOfMonth.clone().weekday(i));
            }
        }
        //On ajoute les jours du mois
        for (let i = 1; i <= this.numberOfDaysInMonth; i++) {
            let day = this.firstDayOfMonth.clone().date(i);
            this.calendar.push(day);
        }
        //On genere les jours du mois suivant afin d'obtenir 42 case
        let actualDayInMonth = 42 - this.calendar.length;
        for (let i = 1; i <= actualDayInMonth; i++) {
            let nextMonthDay = this.lastDayOfMonth.clone().add(i, 'day');
            this.calendar.push(nextMonthDay);
        }
    }

    outputCalendarHTML() {
        let calendarContainer = $('.calendar-container');
        let calendarTable = calendarContainer.html(`
            <div class="title-wrapper">
           <div class="prev-month"></div> <h1 class="month">${this.month.toUpperCase()} ${this.year}</h1><div class="next-month"></div>
            </div>
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
                <tbody class="calendar-table-body-${this.month}-${this.year}">

                </tbody>
            </table>
        </div>`);
        calendarTable.appendTo(calendarContainer);


        let tableBody = $(`.calendar-table-body-${this.month}-${this.year}`);
        let row = $('<tr>');
        $.each(this.calendar, (i, e) => {
            let cell = $(`<td class="day" data-date="${e.format('YYYY-MM-DD')}">`);
            let cellContent = $('<span class="day-number">').text(`${e.format('DD')}`);


            if ((i) < this.firstDayOfMonth.weekday()) {
                cell.addClass('prev');
            }
            if (e > this.lastDayOfMonth) {
                cell.addClass('next');
            }

            cellContent.appendTo(cell);
            cell.appendTo(row);

            if ((i + 1) % 7 === 0 && i !== 0 || i === this.calendar.length - 1) {
                row.appendTo(tableBody);
                row = $('<tr>');
            }

        });
    }
    //Ajoute une couleur au cellule qui corresponde a une tache enregistré
    scanToAddTaskToCell(tasks) {
        let td = $('td');
        $.each(td, (i, e) => {
            let elem = $(e);
            let elemDate = $(e).attr('data-date');
            $.each(tasks, (i, e) => {
                if (elemDate >= e.datedebut && elemDate <= e.datefin) {
                    if (elem.attr('data-task') === undefined) {
                        elem.attr('data-task', true);
                    }
                }
            });
        })
    }


    //Peuple la liste de tache du jour actuel
    showTasksForDay() {
        let day = $('.active').attr('data-date');
        let taskList=$('.tasks-list');
        taskList.html('');
        $.each(this.tasks,(i,e)=>{
            if(day >= e.datedebut && day <= e.datefin){
                taskList.append(`<li data-id="${e.id}"
                data-period="${e.datedebut}/${e.datefin}" class="task"><p class="task-text">${e.task}</p>
                <span class="edit"></span>
                <span class="close">&#xd7;</span>`)
            }
        });
     this.removeDayTaskMarker(day);
    }
    //Peuple la liste des tache du jour précédant
    showTasksForDayBefore(){
        let day = $('.active').attr('data-date');
        let dayBefore = moment(day).subtract(1,'d').format('YYYY-MM-DD');
        let taskList=$('.tasks-list-before');
        taskList.html('');

        $.each(this.tasks,(i,e)=>{
            if(dayBefore >= e.datedebut && dayBefore === e.datefin){
                taskList.append(`<li data-id="${e.id}">${e.task}<span class="extand-period"></span></li>`)
            }
        })
    }
    //Enleve la marque montrant la presence d'une tache lorsque l'on supprime tout les tache d'un jour.
    removeDayTaskMarker(day){
        let list = $('.tasks-list li');
        let markedDay =  $(`.day[data-date=${day}]`);
        if(!list.length){
            console.log('empty shit');
            markedDay.removeAttr('data-task');
        }
    }

    //Actualise la liste des tache pour colorer les cellules
    updateHTML(){
        AjaxRequests.getTaskInMonth(this.now.format('YYYY-MM-DD')).then((res) => {
            this.tasks = res;
            this.scanToAddTaskToCell(res);
            this.showTasksForDay();
        });
    }

    nextMonth() {
        this.init(this.now.add(1, 'month'));
    }

    prevMonth() {
        this.init(this.now.subtract(1, 'month'));
    }

}