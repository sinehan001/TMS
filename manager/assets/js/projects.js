// Get the elements
const modulesContainer = document.getElementById('card-body');
const addModuleBtn = document.getElementById('add-module-btn');
let count_module = 1;
let count_activity = [];
// Add event listener to the add module button
addModuleBtn.addEventListener('click', () => {

    count_activity[count_module-1] = 1;

    const spacer = document.createElement('hr');
    spacer.style.borderWidth = "4px";
    spacer.style.borderRadius = "25px";

    const h3 = document.createElement('h3');
    h3.className = "px-3";
    h3.textContent = "Module "+(count_module++);

    // Create a new module element
    const module = document.createElement('div');
    module.className = 'module form-group my-4';
    module.appendChild(spacer);
    module.appendChild(h3);

    // Create a new input element for the module name
    const moduleNameInput = document.createElement('input');
    moduleNameInput.type = 'text';
    moduleNameInput.className = "form-control form-control-solid";
    moduleNameInput.name = 'module[]';
    moduleNameInput.placeholder = 'Enter Module Name';
    module.appendChild(moduleNameInput);

    // Create a new button to add activities
    const addActivityBtn = document.createElement('a');
    addActivityBtn.className = 'btn btn-primary my-5';
    addActivityBtn.textContent = 'Add Activity';
    addActivityBtn.id = "add-module-btn";
    // addActivityBtn.href = "#";
    addActivityBtn.addEventListener('click', () => {
        // Create a new activity element
        const activity = document.createElement('div');
        activity.className = 'activity form-group my-2';

        const activity_h5 = document.createElement('h5');
        activity_h5.className = 'px-3';
        activity_h5.textContent = "Activity "+(count_activity[count_module-2]++);
        activity.appendChild(activity_h5);

        // Create a new input element for the activity name
        const activityNameInput = document.createElement('input');
        activityNameInput.type = 'text';
        activityNameInput.className = "form-control form-control-solid";
        activityNameInput.name = 'activity[]';
        activityNameInput.placeholder = 'Enter Activity Name';
        activity.appendChild(activityNameInput);

        // Append the activity element to the activities container
        activitiesContainer.appendChild(activity);
    });
    module.appendChild(addActivityBtn);

    // Create a container for the activities
    const activitiesContainer = document.createElement('div');
    activitiesContainer.className = 'activities-container';
    module.appendChild(activitiesContainer);

    // Append the module element to the modules container
    modulesContainer.appendChild(module);
});
