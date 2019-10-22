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

// Save on database
function saveTaskOnDatabase(data) {
    $.ajax({
            type: 'POST',
            url: '/project/task/add',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        }).fail(err => { console.log(err) });
}

// Mark the project as favorite
function markAsFavorite(e) {
    let icon = e.target.querySelector('.fa-star');
    let project_id = e.originalTarget.getAttribute('data-id');

    if(icon.classList.contains('favorite-active')) {
        
        icon.classList.remove('favorite-active');
        icon.classList.add('favorite-noactive');
        saveAsFavorite({ favorite: 0, project_id: project_id });

    } else {

        icon.classList.remove('favorite-noactive');
        icon.classList.add('favorite-active');
        saveAsFavorite({ favorite: 1, project_id: project_id });
    }
}

// Update project mark or unmark as favorite
function saveAsFavorite(data) {
    $.ajax({
            type: 'PUT',
            url: '/project/favorite',
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

// Button to mark the project as favorite
const favorite = document.querySelector('button#favorite');

favorite.addEventListener('click',  markAsFavorite);