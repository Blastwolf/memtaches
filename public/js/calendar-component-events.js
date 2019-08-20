class CalendarComponentEvents{
    constructor(calendar){
             this.calendar = calendar;

             this.calendarContainerEvents();
             this.tasksContainerEvents();
    }

    tasksContainerEvents(){
        let tasksContainer = $('.tasks-container');

        tasksContainer.on('click',(e)=>{
            if(e.target.classList.contains('task') || e.target.classList.contains('task-date') || e.target.classList.contains('task-text')){
                let task = e.target.classList.contains('task') ? $(e.target) : $(e.target).parent();
                console.log(e.target.classList.contains('task'));
                let period = task.attr('data-period').split('/');
                let cell = $('.day');
                if (!$(task).hasClass('checked')) {
                    $('.checked').toggleClass('checked');
                    $('.period').toggleClass('period');

                    $(task).toggleClass('checked');
                    $.each(cell,(i,e)=>{
                        let date = $(e).attr('data-date');
                        if(date >= period[0] && date <= period[1]){
                            $(e).addClass('period');
                        }
                    })
                }else{
                    $(task).toggleClass('checked');
                    $('.period').toggleClass('period');
                }
            }
        });
    }
    calendarContainerEvents(){
        let calendarContainer = $('.calendar-container');
        calendarContainer.on('click', (e) => {
            if (e.target.className.includes('prev-month')) {
                this.calendar.prevMonth();
            }
            if (e.target.className.includes('next-month')) {
                this.calendar.nextMonth();
            }
            if (e.target.tagName.includes('TD') || e.target.tagName.includes('SPAN')) {
                let td = e.target.tagName.includes('TD') ? $(e.target) : $(e.target).parent();
                if (!$(td).hasClass('active')) {
                    $('.active').toggleClass('active');
                    $(td).toggleClass('active');
                    this.calendar.showTasksForDay();
                    this.calendar.showTasksForDayBefore();
                    //if there is a period active , remove it
                    $('.period').toggleClass('period');

                } else {
                    $(td).toggleClass('active')
                }

                let date = $(e.target).attr('data-date') || $(e.target).parent().attr('data-date');
                let inputDate = $('#form input[name="date"]');
                let inputDateJs = $('#form input[name="datejs"]');
                inputDate.attr('value', date);
                inputDateJs.attr('value', date);
            }
        });
    }
}