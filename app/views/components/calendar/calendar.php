<div id="calendar-component">

    <div class="calendar-container">

    </div>

    <div class="tasks-container">

        <form id="periodForm" class="periodForm" method="post" action="Calendar/searchPeriod">
            <input type="date" name="datedebut" id="datedebut">
            <input type="date" name="datefin" id="datefin">

            <button type="submit" class="addBtn">Rechercher</button>
        </form>

        <form id="form" class="addForm" method="post">
            <input name="date" id="date" type="hidden" class="addFormInput">
            <input name="datejs" id="datejs" type="date" disabled class="addFormInput">

<!--            <label for="task">Ajouter une tache :</label>-->

            <input type="text" name="task" id="task" class="addFormInput">
            <button type="submit" class="addBtn" id="submit">Ajouter</button>
        </form>
        <div class="tasks-list-wrapper">
            <h3>Tache du jour actuel</h3>
            <ul class="tasks-list">

            </ul>
        </div>

        <div class="tasks-list-before-wrapper">
            <h3>Tache du jour précédant</h3>
            <ul class="tasks-list-before">

            </ul>
        </div>


    </div>

    <div class="modal-container">
        <form class="modal" id="form" method="POST" action="/Api/">
            <input name="date" id="date" type="hidden">
            <input name="datejs" id="datejs" type="date" disabled>
            <label for="task">Entrez votre tache :</label>
            <textarea name="task" id="task" cols="30" rows="10"></textarea>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</div>