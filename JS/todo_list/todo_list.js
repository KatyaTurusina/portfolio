(() => {
    let todoList = document.querySelector('.todo-list');
    let addButton = todoList.querySelector('.task-list__add-button');
    
    let taskList = todoList.querySelector('.task-list');
    let taskForm = todoList.querySelector('.task-form');
    let form = todoList.querySelector('form');
    let closeButton = taskForm.querySelector('.task-form__close');
    
    let formAction = '';
    let formItem;

    let editAction = e => {
        let btn = e.target;
        let item = btn.closest('.task-list__item');
        let prio = item.querySelector('.task-list__prio');
        let desc = item.querySelector('.task-list__description');
        form.reset();
        form.description.value = desc.textContent;
        form.prio.checked = (prio.textContent !== '');
        taskForm.classList.add('shown');
        formAction = 'edit';
        formItem = item;
    }

    form.addEventListener('submit', e => {
        e.preventDefault();
        switch (formAction) {
            case 'create':

                let item = taskList.firstElementChild.cloneNode(true);
                item.querySelector('.task-list__done').checked = false;
                item.querySelector('.task-list__description').textContent = form.description.value;
                item.querySelector('.task-list__prio').textContent = form.prio.checked ? '⚡' : '';
                taskList.append(item);
                item.addEventListener('click', editAction);
                form.reset();
                break;

            case 'edit':
                formItem.querySelector('.task-list__description').textContent = form.description.value;
                formItem.querySelector('.task-list__prio').textContent = form.prio.checked ? '⚡' : '';
                break;
        }
    });

    addButton.addEventListener('click', e => {
        taskForm.classList.toggle('shown');
        formAction = 'create'
        form.reset();
        formItem = null;
    });

    closeButton.addEventListener('click', e => {
        taskForm.classList.remove('shown');
    });

    let editButtons = todoList.querySelectorAll('.task-list__edit-button');

    editButtons.forEach(btn => {
        btn.addEventListener('click', editAction);
    });

    document.querySelector('.task-list').addEventListener('click', function (event) {
        if (event.target.className === 'task-list__delete-button'){
            let numOfLi = document.querySelectorAll('.task-list__item').length
            if (numOfLi >= 2){
                event.target.closest('li').remove()
            }   
        }

      })

    
    

})();
