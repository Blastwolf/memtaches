<div id="calendar-component" class="d-flex flex-wrap justify-content-around mt-5">
    <div class="calendar-container col-lg-5"></div>

    <div class="tasks-container col-lg-5 mt-10">
        <form id="periodForm" class="periodForm border p-4" method="post" target="_blank"
              action="Calendar/searchPeriod">
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
            <div class="form-row align-item-center">
                <div class="col-3 my-2">
                    <input name="date" id="date" type="date" disabled class="addFormInput form-control" value=""
                           required>
                </div>
                <select class="col-3 form-control m-2" name="app" id="app" required>
                    <?= generateAppSelectInput('app') ?>
                </select>
                <select class="col-3 form-control m-2" name="type" id="type" required>
                    <?= generateTypeSelectInput('type') ?>
                </select>

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
    <div class="modal fade" id="edit-task" tabindex="-1" role="dialog" aria-labelledby="edit-task" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit-form" class="edit-form border p-4">
                    <div class="modal-body">
                        <div class="form-row align-item-center">
                            <select class="col-5 form-control my-2" name="edit-app" id="edit-app" required>
                                <?= generateAppSelectInput() ?>
                            </select>
                            <select class="col-5 form-control my-2 ml-2" name="edit-type" id="edit-type" required>
                                <?= generateTypeSelectInput() ?>
                            </select>
                        </div>
                        <div class="form-row align-item-center">
                            <input type="text" name="edit-task" id="edit-task" class="edit-task-input form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>