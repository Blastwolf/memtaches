
class AjaxRequests {

    constructor(calendar, calendarComponent) {
        this.root = document.baseURI;
        this.calendar = calendar;
        this.calendarComponent = calendarComponent;
        this.form = calendarComponent.find('#form');
        // this.extandButton = calendarComponent.find('.extand-period');
        // this.modal = calendarComponent.find('.modal-container');
        console.log(this.calendarComponent);
        console.log(this.form);

        this.createInsertSubmitEvent();
        this.createUpdateDatePerdiodEvent();
        this.createDeleteTaskEvent();


    }

    createInsertSubmitEvent() {
        this.form.submit((e) => {
            e.preventDefault();
            let date = this.form.find('#date').val();
            let task = this.form.find('#task').val();
            $.post(`${this.root}Api/insertTask`, {date, task}, (res) => {
                this.calendar.updateHTML(res.date);
                // this.modal.removeClass('show');
                let taskInput = this.form.find('#task');
                taskInput.val('');
            })
        })
    }

    static getTaskInMonth(date) {
        this.root = document.baseURI;

        return new Promise((resolve, reject) => {
            $.post(`${this.root}Api/taskInMonth`, {date}, (res) => {
                console.log(res);
                resolve(res);
            })
        })
    }

    createUpdateDatePerdiodEvent() {
        $('.tasks-list-before').on('click', (e) => {
            if (e.target.className.includes('extand-period')) {
                let date = $('.active').attr('data-date');
                let id = $(e.target).parent().attr('data-id');

                $.post(`${this.root}Api/extandDatePeriod`, {id, date}, (res) => {
                    if (res) {
                        // console.log(this.calendar.tasks.indexOf(id),this.calendar.tasks);
                        this.calendar.tasks.forEach((elem, i, arr) => {
                            console.log(elem, elem.id, id);
                            //update the calendar tasks array
                            if (elem.id === id) {
                                this.calendar.tasks[i].datefin = date;
                            }
                            //update the html
                            this.calendar.showTasksForDay();
                            this.calendar.showTasksForDayBefore();
                            this.calendar.scanToAddTaskToCell(this.calendar.tasks);
                        })
                    }
                })
            }
        });
    }

    createDeleteTaskEvent() {
        $('.tasks-list').on('click', (e) => {
            if (e.target.classList.contains('close')) {

                let id = $(e.target).parent().attr('data-id');
                console.log($(e.target).parent().attr('data-id'), "penis hahahaha")
                $.post(`${this.root}Api/deleteTask`, {id}, (res) => {
                    if (res) {
                        console.log('bien supprimer');
                        this.calendar.tasks.forEach((elem, i,arr) => {
                            //update the calendar tasks array
                            if (elem.id === id) {
                            arr.splice(i,1);
                            }
                        });
                        this.calendar.showTasksForDay();
                        this.calendar.showTasksForDayBefore();
                    }
                })
            }
        })
    }
}