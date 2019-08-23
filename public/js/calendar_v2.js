class Calendar_v2 {

    constructor(date) {
        this.init(date);
    }

    init(date) {
        this.calendarContainer = $('.calendar-container');
        this.now = date ? moment(date) : moment();
        this.now.locale('fr', {week: {dow: 1}});
        this.year = this.now.format('YYYY');
        this.month = this.now.format('MMMM');
        this.firstDayOfMonth = this.now.clone().startOf('month');
        this.lastDayOfMonth = this.now.clone().endOf('month');
        this.numberOfDaysInMonth = this.now.daysInMonth();

        this.calendarContainer.html('');
        this.generateCalendarArr();
        this.outputCalendarHTML();

        $.post(`${document.baseURI}Api/taskInMonth`,{date:this.now.format('YYYY-MM-DD')},(res)=> {
            this.tasks = res;
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

        let calendarTable = this.calendarContainer.html(`
            <table class="calendar-table table table-bordered">
                <thead>
                <tr>
                    <th colspan="1" class="month-selector"><span class="prev-month"></span></th>
                    <th colspan="5" class="month">${this.month.toUpperCase()} ${this.year}</th>
                    <th colspan="1" class="month-selector"><span class="next-month"></span></th>
                </tr>
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
        calendarTable.appendTo(this.calendarContainer);


        let tableBody = $(`.calendar-table-body-${this.month}-${this.year}`);
        let row = $('<tr>');
        $.each(this.calendar, (i, e) => {
            let cell = $(`<td class="day" data-date="${e.format('YYYY-MM-DD')}">`);
            let cellContent = $('<span class="day-number">').text(`${e.format('DD')}`);

            //Si le premier jours du mois ne commence pas un lundi , on ajoute la class prev
            //pour representer les jours de la fin du mois precedent
            if ((i) < this.firstDayOfMonth.weekday()) {
                cell.addClass('prev');
            }
            //---> Pour les jours du mois suivant
            if (e > this.lastDayOfMonth) {
                cell.addClass('next');
            }

            cellContent.appendTo(cell);
            cell.appendTo(row);
            //On insert la row tous les 7 jours ou a la fin du mois
            if ((i + 1) % 7 === 0 && i !== 0 || i === this.calendar.length - 1) {
                row.appendTo(tableBody);
                row = $('<tr>');
            }

        });
    }
    //Ajoute une couleur au cellule qui corresponde a une tache enregistré
    scanToAddTaskToCell(tasks,task) {
        let td = $('td');
        $.each(td, (i, e) => {
            let elem = $(e);
            let elemDate = $(e).attr('data-date');
            $.each(tasks, (i, e) => {
                if (elemDate >= e.datedebut && elemDate <= e.datefin) {
                    if (!elem.attr('data-task')) {
                        elem.attr('data-task', true);
                    }
                }
            });
        });
    }

    //Peuple la liste de tache du jour actuel
    showTasksForDay() {
        let day = $('.active').attr('data-date');
        let taskList=$('.tasks-list');
        taskList.html('');
        $.each(this.tasks,(i,e)=>{
            if(day >= e.datedebut && day <= e.datefin){
                taskList.append(`
                <li data-id="${e.id}" data-period="${e.datedebut}/${e.datefin}" class="task">
                    <p class="task-text">${e.task}</p> 
                    <i class="far fa-edit edit"></i>
                    <i class="fas fa-times close"></i>
                </li>`)
            }
        });

     // this.removeDayTaskMarker(day);
    }
    //Peuple la liste des tache du jour précédant
    showTasksForDayBefore(){
        let day = $('.active').attr('data-date');
        let dayBefore = moment(day).subtract(1,'d').format('YYYY-MM-DD');
        let taskList=$('.tasks-list-before');
        taskList.html('');

        $.each(this.tasks,(i,e)=>{
            if(dayBefore >= e.datedebut && dayBefore === e.datefin){
                taskList.append(`
                <li data-id="${e.id}" data-period="${e.datedebut}/${e.datefin}" class="task-before">
                    <p class="task-text">${e.task}</p>
                    <i class="fas fa-level-up-alt extand-period"></i>
                </li>`)
            }
        });
    }
    //Enleve la marque montrant la presence d'une tache lorsque l'on supprime tout les tache d'un jour.
    removeDayTaskMarker(day){
        let list = $('.tasks-list li');
        let markedDay =  $(`.day[data-date=${day}]`);
        if(!list.length){
            markedDay.removeAttr('data-task');
            $('.period').toggleClass('period');
            //Si il y a une periode en highlight , ont la retire
        }
    }

    //Method pour enlever les marques data-task=true sur les cellules qui n'on plus de tache apres suppression d'une tache
    //avec une periode.
    removePeriodAndTaskMarker(task){
        let taskElem = task;
        if (taskElem) {
            let taskDays = $('.day[data-task=true]');
            let taskDebut = taskElem.datedebut;
            let taskFin = taskElem.datefin;
            let periodDays = [];
            //On genere un tableau representant la periode de la tache et les cellules concerné
            $.each(taskDays, (i, e) => {
                if ($(e).attr('data-date') >= taskDebut && $(e).attr('data-date') <= taskFin) {
                    periodDays.push(e);
                }
            });
            //on verifie si les cellules de la periode on d'autre taches que celle supprimé.
            let emptyDay = periodDays.filter((e) => {
                let date = $(e).attr('data-date');
                let taskPerDay =0;
                $.each(this.tasks, (i, e) => {
                    let dateDebut = e.datedebut;
                    let dateFin = e.datefin;
                    if (date <= dateDebut && date >= dateFin) {
                        taskPerDay++
                    }

                });
                //si aucune date de tache ne correspond a la date de la cellules on la met dans un tableau
                //representant une cellule vide
                if(!taskPerDay)return true;
            });
            //on retire l'attribut;
            $.each(emptyDay,(i,e)=>{
                if($(e).attr('data-task')){
                    $(e).removeAttr('data-task');
                }
            });
        }
    }

    //Actualise la liste des tache pour colorer les cellules
    // updateHTML(){
    //     AjaxRequests.getTaskInMonth(this.now.format('YYYY-MM-DD')).then((res) => {
    //         this.tasks = res;
    //         this.scanToAddTaskToCell(res);
    //         this.showTasksForDay();
    //     });
    // }

    nextMonth() {
        this.init(this.now.add(1, 'month'));
    }

    prevMonth() {
        this.init(this.now.subtract(1, 'month'));
    }

}