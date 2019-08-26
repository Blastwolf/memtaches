<div id="calendar-component" class="d-flex flex-wrap justify-content-around mt-5">
    <div class="calendar-container col-lg-5"></div>

    <div class="tasks-container col-lg-5 mt-10">
        <form id="periodForm" class="periodForm border p-4" method="post" target="_blank" action="Calendar/searchPeriod">
            <div class="form-group">
                <p>Exporter une periode :</p>
                <div class="form-row align-items-center">
                    <div class="col-auto">
                        <input type="date" name="datedebut" id="datedebut" class="form-control">
                    </div>
                    <div class="col-auto">
                        <input type="date" name="datefin" id="datefin" class="form-control">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="addBtn btn btn-primary">Rechercher</button>
                    </div>
                </div>
            </div>

        </form>


        <form id="form" class="addForm border p-4" method="post">
            <div class="form-row mb-2">
                <div class="col-3">
                    <input name="date" id="date" type="date" disabled class="addFormInput form-control" value="" required>
                </div>
            </div>
            <div class="form-row align-item-center">
                <div class="col-10">
                    <input type="text" name="task" id="task" class="addFormInput form-control" required>
                </div>
                <div class="col-2">
                    <button type="submit" class="addBtn btn btn-primary" id="submit">Ajouter</button>
                </div>
            </div>
        </form>

        <div class="tasks-list-wrapper border p-4">
            <h6 class="current-day-task">Tache du jour actuel :</h6>
            <ul class="tasks-list"></ul>
        </div>

        <div class="tasks-list-before-wrapper border p-4">
            <h6 class="day-tasks-before">Tache du jour précédant :</h6>
            <ul class="tasks-list-before"></ul>
        </div>
    </div>
</div>