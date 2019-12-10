// Tasks
function createTask(e) {
    const tasks = e.originalTarget.parentElement.querySelector('.stage-card-tasks');
    const input = document.createElement('input');
    const li = document.createElement('li');

    // input
    input.setAttribute('class', 'input-control');
    tasks.appendChild(input);
    input.focus();
    
    // li
    li.setAttribute('class', 'stage-card-task');

    // Add li and remove input
    input.addEventListener('focusout', function(e) {

        if(!input.value) { input.remove(); return; }

        li.appendChild(document.createTextNode(input.value));
        tasks.appendChild(li);
        saveTaskOnDatabase({
            title: input.value,
            stage_id: tasks.parentElement.parentElement.getAttribute('data-id')
        });
        input.remove();
    });
}

// Save task on database
function saveTaskOnDatabase(data) {
    $.ajax({
            type: 'POST',
            url: '/project/task/add',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).fail(err => { console.log(err) });
}

// Remove project on favorite list
function unmarkFavorite(project) {

    if(!project.favorite.classList.contains('fas'))
        return false;

    project.favorite.classList.remove('fas');
    project.favorite.classList.add('far');

    return { project_id: project.id, favorite: 0 };
}

// Add project on favorite list
function markFavorite(project) {

    if(project.favorite.classList.contains('fas'))
        return false;

    project.favorite.classList.remove('far');
    project.favorite.classList.add('fas');

    return { project_id: project.id, favorite: 1 };
}

// Favorite project
function favoriteProject(e) {
    const project = {
        id: e.originalTarget.getAttribute('data-id'),
        favorite: e.target.querySelector('.fa-star'),
    }

    updateFavoriteList(unmarkFavorite(project) || markFavorite(project));
}

// Update favorite list
function updateFavoriteList(data) {
    $.ajax({
            type: 'PUT',
            url: '/favorite/update',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).done(response => { console.log(response) })
        .fail(err => { console.log(err) });
}

const stageCardBtn = Array.from(document.querySelectorAll('.stage-card-body button'));

// add click event on tasks
stageCardBtn.forEach(function(btn) { 
    btn.addEventListener('click', createTask);
});

// Favorite project
const favorite = document.querySelector('button#favorite');

favorite.addEventListener('click',  favoriteProject);