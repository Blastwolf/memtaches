class AjaxRequests {

    constructor(calendar, calendarComponent) {
        this.root = document.baseURI;
        this.calendar = calendar;
        this.calendarComponent = calendarComponent;
        this.form = calendarComponent.find('#form');
        this.taskList = $('.tasks-list');
        this.taskListBefore=$('.tasks-list-before');

        this.createInsertSubmitEvent();
        this.createUpdateDatePerdiodEvent();
        this.createDeleteTaskEvent();
        this.createEditTaskEvent();
        this.createReducPeriodEvent();

    }

    createInsertSubmitEvent() {
        this.form.submit((e) => {
            e.preventDefault();
            let date = this.form.find('#date').val();
            let task = this.form.find('#task').val();
            $.post(`${this.root}Api/insertTask`, {date, task}, (res) => {
                // this.calendar.updateHTML(res.date);
                this.updateHTML(res);
                this.form.find('#task').val('');
            })
        })
    }
    updateHTML(tasks){
        this.calendar.tasks = tasks;
        this.calendar.scanToAddTaskToCell(tasks);
        this.calendar.showTasksForDay();
    }


    createUpdateDatePerdiodEvent() {
       this.taskListBefore.on('click', (e) => {
            if (e.target.className.includes('extand-period')) {
                let date = $('.active').attr('data-date');
                let id = $(e.target).parent().attr('data-id');

                $.post(`${this.root}Api/extandDatePeriod`, {id, date}, (res) => {
                    if (res) {
                        // console.log(this.calendar.tasks.indexOf(id),this.calendar.tasks);
                        this.calendar.tasks.find((elem, i, arr) => {
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

    createReducPeriodEvent(){
            this.taskList.on('click','.reduc-period',(e)=>{
                let date = $('.active').attr('data-date');
                let reducDate = moment(date).subtract(1,'days').format('YYYY-MM-DD');
                let id = $(e.target).parent().attr('data-id');
                $.post(`${this.root}Api/reducTaskPeriod`, {id, reducDate}, (res,err) => {
                    if (res) {
                        // console.log(this.calendar.tasks.indexOf(id),this.calendar.tasks);
                        let task={};
                        this.calendar.tasks.find((elem, i, arr) => {
                            //update the calendar tasks array
                            if (elem.id === id) {
                                if(this.calendar.tasks[i].datefin > this.calendar.tasks[i].datedebut){
                                    task = JSON.parse(JSON.stringify(this.calendar.tasks[i]));
                                    this.calendar.tasks[i].datefin = reducDate;
                                }
                            }
                            //update the html
                            this.calendar.showTasksForDay();
                            this.calendar.showTasksForDayBefore();
                            this.calendar.removePeriodAndTaskMarker(task);

                        })
                    }
                })
            })
    }

    createDeleteTaskEvent() {
        this.taskList.on('click', (e) => {
            if (e.target.classList.contains('close')) {
                if (confirm('Voulez vous vraiment supprimer cette tache ?!')) {
                    let id = $(e.target).parent().attr('data-id');
                    let task = this.calendar.tasks.find(task => task.id === id);
                    $.post(`${this.root}Api/deleteTask`, {id}, (res) => {
                        if (res) {

                            this.calendar.tasks.forEach((elem, i, arr) => {
                                //update the calendar tasks array
                                if (elem.id === id) {
                                    arr.splice(i, 1);
                                }
                            });
                            this.calendar.showTasksForDay();
                            this.calendar.showTasksForDayBefore();
                            this.calendar.removePeriodAndTaskMarker(task);
                        }
                    })
                }
            }
        });
    }
        createEditTaskEvent(){
            this.taskList.on('click', 'i.edit', (e) => {


                let li = $(e.target).parent();
                let p = $(li).find('p.task-text');

                p.toggleClass('task-text');
                $(p).attr('contenteditable', true);
                let id = $(e.target).parent().attr('data-id');

                $(li).find('.edit').attr('hidden', true);
                $(li).find('.close').attr('hidden', true);

                let range = document.createRange();//Create a range (a range is a like the selection but invisible)
                range.selectNodeContents(p[0]);
                range.collapse(false);
                let cursor = window.getSelection();
                cursor.removeAllRanges();
                cursor.addRange(range);

                this.taskList.on('keypress', (e) => {
                    if (e.which == 13 && $(p).attr('contenteditable')) {
                        let task = $(p).text();

                        $.post(`${this.root}Api/editTask`, {id, task}, (err, res) => {
                            if (res) {
                                p.toggleClass('task-text');
                                $(p).removeAttr('contenteditable');
                                $(li).find('.edit').removeAttr('hidden');
                                $(li).find('.close').removeAttr('hidden');

                                this.calendar.tasks.forEach((elem, i, arr) => {
                                    //update the calendar tasks array
                                    if (elem.id === id) {
                                        elem.task = task;
                                    }
                                });
                                this.calendar.showTasksForDay();
                                this.calendar.showTasksForDayBefore();
                            }

                            if (err) {
                                console.log(err);
                            }
                        })
                    }
                })
            })
        }
    }