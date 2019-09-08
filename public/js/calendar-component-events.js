class CalendarComponentEvents {
    constructor(calendar) {
        this.calendar = calendar;

        this.calendarContainerEvents();
        this.tasksContainerEvents();
    }

    tasksContainerEvents() {
        let tasksContainer = $('.tasks-container');

        tasksContainer.on('click', (e) => {
            this.showPeriodRange(e);
        });
    }

    calendarContainerEvents() {
        let calendarContainer = $('.calendar-container');
        calendarContainer.on('click', (e) => {
            this.changeMonth(e);
            this.addActiveToCell(e);
        });
    }

    //Highlight les cellules representant les jours present la periode de la tache
    showPeriodRange(e) {
        let targetClass = e.target.classList;
        if (targetClass.contains('task') || targetClass.contains('task-text') || targetClass.contains('task-before')) {
            let task = targetClass.contains('task') || targetClass.contains('task-before') ? $(e.target) : $(e.target).parent();
            let period = task.attr('data-period').split('/');
            let cell = $('.day');
            if (!$(task).hasClass('checked')) {
                $('.checked').toggleClass('checked');
                $('.period').toggleClass('period');

                $(task).toggleClass('checked');
                $.each(cell, (i, e) => {
                    let date = $(e).attr('data-date');
                    if (date >= period[0] && date <= period[1]) {
                        $(e).addClass('period');
                    }
                })

            } else {
                $(task).toggleClass('checked');
                $('.period').toggleClass('period');
            }
        }
    }

    addActiveToCell(e) {
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
                $(td).toggleClass('active');
                $('.tasks-list').html('');
                $('.tasks-list-before').html('');
                $('.period').toggleClass('period');
            }

            let date = $(e.target).attr('data-date') || $(e.target).parent().attr('data-date');
            let inputDate = $('#form input[name="date"]');
            inputDate.attr('value', date);
        }
    }

    changeMonth(e) {
        if (e.target.className.includes('prev-month')) {
            this.calendar.prevMonth();
        }
        if (e.target.className.includes('next-month')) {
            this.calendar.nextMonth();
        }
    }

    outputModelHtml(e) {
        if(e.target.classList.contains('edit')){

            let modal = $(`<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">`).append(`
                 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>`);
            $(modal).appendTo('.content-wrapper');
            $(modal).modal('show');
        }

    }
}